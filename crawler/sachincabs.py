import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup
from decimal import Decimal

# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://www.sachincab.com/cab-rate.html'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)
# print soup.prettify()

data = []

span = soup.find_all('span', attrs = {'class':'text2'})
data.append(span[0].getText())

lis = soup.find_all('td', attrs = {'align':'left', 'class':'text2', 'valign':'top'})

for i in range(len(lis)):
	data.append(lis[i].getText())

company = "sachincabs"
city = "Delhi"

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

initial = -1

extra = Decimal(data[10].split('%',1)[0])/100 + 1
night_start = str(int(data[12].split()[0])+12)+':00'
night_end = data[12].split()[3]+':00'

for j in range(2):

	i = 3
	initial = initial+1
	sheet.write(initial,0,company)
	sheet.write(initial,1,city)

	if(j==0):
		sheet.write(initial,2,'AC Sedan')
	else:
		sheet.write(initial,2,'non-AC Sedan')

	sheet.write(initial,3,night_start)

	i = i+1
	tofill = int(data[0].split()[3]) * extra
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[1].split()[3])
	sheet.write(initial,i,tofill)

	i = i+1
	if(j==0):
		tofill = int(data[4].split('.',2)[2]) * extra
	else:
		tofill = int(data[2].split('.',2)[2]) * extra
	sheet.write(initial,i,tofill)

	i = i+1		#waiting charges
	tofill = (Decimal(data[6].split('.',1)[1].split('(',1)[0]) * extra)/30
	tofill = round(tofill,2)
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[0].split()[3])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[1].split()[3])
	sheet.write(initial,i,tofill)

	i = i+1
	if(j==0):
		tofill = int(data[4].split('.',2)[2])
	else:
		tofill = int(data[2].split('.',2)[2])
	sheet.write(initial,i,tofill)

	i = i+1		#waiting charges
	tofill = Decimal(data[6].split('.',1)[1].split('(',1)[0])/30
	tofill = round(tofill,2)
	sheet.write(initial,i,tofill)

	i = i+1
	sheet.write(initial,i,night_end)

	i = i+2		#14-cancellation
	tofill = int(data[11].split('.',1)[1])
	sheet.write(initial,i,tofill)

workbook.save(company+".xls")