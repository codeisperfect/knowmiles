import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup
from decimal import Decimal

# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://wowcabsin.cluster2.hostgator.co.in/wowcabs.in'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)
# print soup.prettify()

tables = soup.find_all('table') 

'''table = tables[0]
ths = table.find_all('th')
span = ths[1].find_all('span')[0]
print "Day Time : "  + span.getText()'''

a = ""
data = []
for k in range(len(tables)):
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

print a

company = "wowcabs"
city = "Delhi"

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

initial = 0
sheet.write(initial,0,company)
sheet.write(initial,1,city)
sheet.write(initial,2,"Sedan")
night_start = str(int(data[0][0][0].split('to',1)[1].split('P',1)[0])+12) + ':00'
night_end = data[0][0][0].split('(',1)[1].split('A',1)[0] + ':00'
sheet.write(initial,3,night_start)
print (data[0][0][0].split('to',1)[1].split('P',1)[0])

i=3

for j in range(2):
	i = i+1
	tofill = Decimal(data[0][1][1-j].split('r',1)[0]) * Decimal(data[0][3][1-j].split('k',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal(data[0][3][1-j].split('k',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal(data[0][1][1-j].split('r',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal(data[0][5][1-j].split('.',1)[1].split('r',1)[0])/30
	tofill = round(tofill,2)
	sheet.write(initial,i,tofill)

i = i+1
sheet.write(initial,i,night_end)

workbook.save(company+".xls")