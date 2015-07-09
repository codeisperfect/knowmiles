import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup
from decimal import Decimal

# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://yocabs.com/content.php?pid=102-144'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)
# print soup.prettify()

tables = soup.find_all('table')

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

company = "yocabs"
city = "Delhi"
extra = Decimal(data[0][9][1].split('%',1)[0])/100 + 1

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

initial = 0

sheet.write(initial,0,company)
sheet.write(initial,1,city)
sheet.write(initial,2,"Sedan")
night_start = str(int(data[0][9][0].split('p',1)[0])+12) + ':00'
night_end = data[0][9][0].split()[2].split('a')[0] + ':00'
sheet.write(initial,3,night_start)

i=3

for j in range(2):

	if(j==1):
		extra = 1

	i = i+1
	tofill = int(data[0][1][1].split('.',1)[1]) * extra
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = 1 * extra
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[0][2][1].split('.',1)[1]) * extra
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = (Decimal(data[0][7][1].split()[1]) * extra)/60
	tofill = round(tofill,2)
	sheet.write(initial,i,tofill)

i = i+1
sheet.write(initial,i,night_end)

para = soup.find_all('p')

tofill = int(para[0].getText().split('.',1)[1].split('/',1)[0])
i = 14
sheet.write(initial,i,tofill)

workbook.save(company+".xls")