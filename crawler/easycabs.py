import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup
from decimal import Decimal
'''from xlrd import open_workbook
from xlwt import Workbook
from xlutils.copy import copy'''


# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://www.easycabs.com/tariff.php'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)
# print soup.prettify()

company = "easycabs"

tables = soup.find_all('table' , attrs = {'cellpadding' : '0' , 'width' : '100%' , 'border' : '0' , 'class' : 'collapseTable'}) 
city = []
city.append("Delhi")
city.append("Mumbai")
city.append("Hyderabad")
city.append("Bangalore")

'''table = tables[0]
ths = table.find_all('th')
span = ths[1].find_all('span')[0]
print "Day Time : "  + span.getText()'''

'''rb = open_workbook("data.xls")
wb = copy(rb)

s = wb.get_sheet(0)
s.write(0,0,'A1')
wb.save('data.xls')'''

'''workbook = xlwt.Workbook() 
sheet = workbook.add_sheet("data.xls")
sheet.write(0, 0, 'foobar')
sheet.write(1, 0, 'foobar')
sheet.write(2, 0, 'foobar')'''

# pad = xlrd.open_workbook("data.xlsx")
# worksheet = pad.sheet_by_name('Sheet1')
# b = worksheet.nrows
#workbook.save("data.xls")

a = ""
data = []
for k in range(len(tables)):
	table = []
	trs = tables[k].find_all('tr')
	for j in range(len(trs)):
		row = []
		tds = trs[j].find_all('td')
		for i in range(len(tds)):
			a = a+tds[i].getText()+"\t\t"
			row.append(tds[i].getText())
		a = a+"\n"
		table.append(row)
	data.append(table)

night_start = []
night_end = []

for j in range(4):
	span = tables[j].find_all('span', attrs = {'style':"font-size:11px;font-weight:normal;"})
	b = span[0].getText().split('to',1)[1]
	if(b==" Midnight"):
		start = '00:00'
		night_start.append(start)
	else:
		start = str(int(b.split(':',1)[0])+12) + ':00'
		if(int(b.split(':',1)[0])==12):
			start = '00:00'
		night_start.append(start)
	
	end = span[0].getText().split(':',1)[0] + ':00'
	night_end.append(end)

initial = -1

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

for it in range(4):

	initial = initial + 1
	tofill = company
	sheet.write(initial,0,company)
	sheet.write(initial,1,city[it])
	sheet.write(initial,2,"Sedan")
	sheet.write(initial,3,night_start[it])

	i = 4
	tofill = Decimal(data[it][1][2].split()[1])
	sheet.write(initial,i,tofill)

	i = i+1
	if (it==1):
		tofill = 1
	else:
		tofill = Decimal(data[it][1][0].split()[1])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal((data[it][2][2].split('.',1)[1]).split('/',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	if (it==0):
		tofill = Decimal(data[it][3][2].split()[1])/60
	elif (it==3):
		tofill = Decimal(data[it][3][2].split('.',1)[1].split('/',1)[0])/15
		tofill = round(tofill,2)
	else:
		tofill = Decimal(data[it][3][2].split('.',1)[1].split('/',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal(data[it][1][1].split()[1])
	sheet.write(initial,i,tofill)

	i = i+1
	if (it==1):
		tofill = 1
	else:
		tofill = Decimal(data[it][1][0].split()[1])

	sheet.write(initial,i,tofill)

	i = i+1
	tofill = Decimal((data[it][2][1].split('.',1)[1]).split('/',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	if (it==0):
		tofill = Decimal(data[it][3][1].split()[1])/60
	elif (it==3):
		tofill = Decimal(data[it][3][1].split('.',1)[1].split('/',1)[0])/15
		tofill = round(tofill,2)
	else:
		tofill = Decimal(data[it][3][1].split('.',1)[1].split('/',1)[0])
	sheet.write(initial,i,tofill)

	i = i+1
	sheet.write(initial,i,night_end[it])

workbook.save(company+".xls")

print data[0][4][1]