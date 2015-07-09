import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup
from decimal import Decimal

# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://www.hellocabsdelhi.com/tariff.html'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)
# print soup.prettify()

tables = soup.find_all('table', attrs = {'width':'98%', 'cellspacing':'1', 'cellpadding':'2', 'border':'0', 'class':'tar_bor'}) 
print len(tables)

a = ""
data = []
for k in range(len(tables)-1):
	city = []
	trs = tables[k].find_all('tr')
	for j in range(len(trs)):
		row = []
		tds = trs[j].find_all('td')
		for i in range(len(tds)):
			a = a+tds[i].getText()+"\t\t"
			row.append(tds[i].getText())
		a = a+"\n"
		city.append(row)
	data.append(city)

company = "hellocabs"
city = "Delhi"
initial = -1

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

tds = soup.find_all('td', attrs = {'style':"font-weight:bold;", 'align':"center"})
h = tds[0].find_all('h2')
min_nonac = int(h[0].getText().split('Rs.',1)[1].split('+',1)[0])
basekm = min_nonac/int(data[0][0][2].split('Rs.',1)[1].split('/',1)[0])
night_extra = [1,1]
night_start = str(int(data[0][0][2].split('from',1)[1].split(':',1)[0])+12) + ':00'
night_end = data[0][0][2].split('to ',1)[1].split(' AM',1)[0]

for k in range(2):

	initial += 1
	sheet.write(initial,0,company)
	sheet.write(initial,1,city)
	if(k==0):
		sheet.write(initial,2,"non-AC Sedan")
	else:
		sheet.write(initial,2,"AC Sedan")

	i=3
	sheet.write(initial,i,night_start)

	for j in range(2):

		if(j==0):
			night_extra[k] = Decimal(data[0][k][2].split('(',1)[1].split('%',1)[0])/100 + 1
		else:
			night_extra[k] = 1

		i+=1
		rate = int(data[0][k][2].split('Rs.',1)[1].split('/',1)[0])
		sheet.write(initial,i,rate*basekm*night_extra[k])

		i+=1	
		sheet.write(initial,i,basekm)

		i+=1
		rate = int(data[0][k][2].split('Rs.',1)[1].split('/',1)[0])
		sheet.write(initial,i,rate*night_extra[k])

		i+=1
		cost = Decimal(data[0][2][2].split('Rs.',1)[1].split('/',1)[0])
		time = Decimal(data[0][2][2].split('every',1)[1].split('minute',1)[0])
		waiting_charge = round(Decimal(cost/time),2)
		sheet.write(initial,i,waiting_charge)

	i = i+1
	sheet.write(initial,i,night_end)

workbook.save(company+".xls")