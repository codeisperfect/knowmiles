import os
from BeautifulSoup import BeautifulSoup

def readfd(fd):
	data=fd.read();
	fd.close();
	return data;

def elc(c):
	return readfd(os.popen(c));

def curl(url):
	return elc("curl -s -k --no-progress-bar '"+url+"'");


data={};


data['ola']={};
url="https://www.olacabs.com/fares/delhi";
url="https://www.olacabs.com/fares/agra";

if(0):
	soup=BeautifulSoup(curl(url));
	clist=soup.findAll(attrs={"id":"container"})[0].findAll("table")[0].findAll(recursive=False)[2:]
	for i in clist:
		clms=i.findAll("td");
		cname=clms[0].text;
		(temp1,base_fair,temp2,base_km,temp3) = re.search('^([^\d]+) (\d+) ([^\d]+) (\d+) ([^\d]+)$',clms[1].text).groups()
		(temp1,perkm,temp2)=re.search('^([^\d]+) (\d+) ([^\d]+)$',clms[2].text).groups()
		if(clms[3].text!="N/A"):
			waiting_charge=re.search('(\d+)',clms[3].text).groups()[0]
		else:
			waiting_charge=0;
		print base_fair,base_km,perkm,waiting_charge

