import urllib2, xlwt, xlrd
from bs4 import BeautifulSoup

# urllib2.install_opener(
#     urllib2.build_opener(
#         urllib2.ProxyHandler({'http': '10.10.78.61:3128'})
#     )
# )

url = 'http://www.blueskycabs.com/tariff.html'
html = urllib2.urlopen(url)
doc = html.read()


soup = BeautifulSoup(doc)

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

div = soup.find_all('div', attrs = {'class':'Tax2'})
print len(div)

company = "blueskycabs"

initial = 0

workbook = xlwt.Workbook()
sheet = workbook.add_sheet(company+".xls")

sheet.write(initial,0, "BlueSky Cabs")
sheet.write(initial,1,"Delhi")
sheet.write(initial,2,"Sedan")

i = 3

for j in range(2):

	i = i+1
	tofill = int(data[0][0][1].split('.',1)[1])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[0][0][0].split()[2])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = int(data[0][1][1].split('.')[1].split('/')[0])
	sheet.write(initial,i,tofill)

	i = i+1
	tofill = div[0].getText()
	tofill = int(tofill.split('.')[1].split('/')[0])
	sheet.write(initial,i,tofill)

workbook.save(company+".xls")