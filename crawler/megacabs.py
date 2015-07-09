import urllib2, cookielib, xlrd, xlwt
from bs4 import BeautifulSoup
from decimal import Decimal

# urllib2.install_opener(
# 	urllib2.build_opener(
# 		urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
# 	)
# )

company = 'megacabs'
hdr = {'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11',
		'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Charset': 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
		'Accept-Encoding': 'none',
		'Accept-Language': 'en-US,en;q=0.8',
		'Connection': 'keep-alive'}

site = 'http://www.megacabs.com/'
req = urllib2.Request(site, headers=hdr)

try:
	page = urllib2.urlopen(req)
except urllib2.HTTPError, e:
	print e.fp.read()

doc = page.read()
soup = BeautifulSoup(doc)

div1 = soup.find_all('div', attrs = {'id':"whiteband"})
div2 = div1[0].find_all('div', attrs = {'class':"top-mid"})
div3 = div2[0].find_all('div', attrs = {'id':"new-navbar"})
lis = div3[0].find_all('li')

cities = []
for j in range(len(lis)):
	cities.append(lis[j].getText())
# print cities

links = []
for link in div3[0].find_all('a', href = True):
	links.append(link['href'])

#---------------------------------------------------------------------------
initial = -1
workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

for k in range(len(cities)):
	initial += 1

	req = urllib2.Request(links[k], headers=hdr)

	try:
	    page = urllib2.urlopen(req)
	except urllib2.HTTPError, e:
	    print e.fp.read()

	doc = page.read()
	soup = BeautifulSoup(doc)

	tables = soup.find_all('table', attrs = {'class':'table-bordered'})
	tds = tables[0].find_all('td')

	data = []
	for j in range(len(tds)):
		data.append(tds[j].getText())

	night_extra = Decimal(data[1].split('%',1)[0])/100+1

	i=3
	sheet.write(initial,0,company)
	sheet.write(initial,1,cities[k])
	sheet.write(initial,2,"Sedan")

	night = data[1].split('between ',1)[1]
	starting = str(int(night.split('hr',1)[0][:2])) + ':00'
	end = str(int(night.split('to ',1)[1][:2])) + ':00'
	sheet.write(initial,3,starting)

	for j in range(2):

		if(k==0):

			line = data[0].split(' Rs.',2)
			if(j==1):
				night_extra = 1
			i+=1
			basefare = Decimal(line[1].split()[0]) * night_extra
			sheet.write(initial,i,basefare)
			i+=1
			basekm = Decimal(line[1].split('first',1)[1].split('km',1)[0])
			sheet.write(initial,i,basekm)
			i+=1
			rate = Decimal(line[2].split()[0]) * night_extra
			sheet.write(initial,i,rate)

		elif((k==2)or(k==3)):
			line = data[0].split('Rs.',1)
			if(j==1):
				night_extra = 1
			i+=1
			basefare = Decimal(line[1].split()[0]) * night_extra
			sheet.write(initial,i,basefare)
			i+=1
			basekm = 1
			sheet.write(initial,i,basekm)
			i+=1
			rate = Decimal(line[1].split()[0]) * night_extra
			sheet.write(initial,i,rate)

		else:
			line = data[0].split('Rs.',2)
			if(j==1):
				night_extra = 1
			i+=1
			basefare = Decimal(line[1].split()[0]) * night_extra
			sheet.write(initial,i,basefare)
			i+=1
			basekm = Decimal(line[1].split('first',1)[1].split('km',1)[0])
			sheet.write(initial,i,basekm)
			i+=1
			rate = Decimal(line[2].split()[0]) * night_extra
			sheet.write(initial,i,rate)

		i+=1
		if(k==0):
			waiting = Decimal(data[2].split('Rs.')[1].split('per',1)[0])/60
		elif(k==1):
			waiting = Decimal(data[3].split('per',1)[0])/60
		else:
			waiting = Decimal(data[3].split('Rs.')[1].lower().split('per',1)[0])/60

		waiting = round(waiting,2)
		sheet.write(initial,i,waiting)

		i+=1
		sheet.write(initial,i,end)

workbook.save(company+".xls")