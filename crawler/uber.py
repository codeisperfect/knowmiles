import os,re
from BeautifulSoup import BeautifulSoup

def readfd(fd):
	data=fd.read();
	fd.close();
	return data;

def elc(c):
	return readfd(os.popen(c));

def curl(url):
	return elc("curl -s -k --no-progress-bar '"+url+"'");

def writefd(fd,data):
	fd.write(data);
	fd.close();
baseurl="https://www.uber.com";


if(0):
	data={};
	data['uber']={};
	cityurl="https://www.uber.com/cities";
	soup=BeautifulSoup(curl(cityurl));
	data['uber']['city']={};
	allcity=soup.findAll(attrs={'class':'yui3-g'})[-1].findAll(attrs={'class':'yui3-u-1-3 yui3-u-s-1-2'});
	for i in allcity:
		data['uber']['city'][str(i.text)]={'url':baseurl+str(i.find("a")['href'])};

url='';
soup=BeautifulSoup(curl(url));


if(0):
	count=0;
	for j in data['ola']['city']:
		if(count>5 and 0):
			break;
		count+=1;
		url=data['ola']['city'][j]['url']
		data['ola']['city'][j]['cartypes']={};

		soup=BeautifulSoup(curl(url));
		clist=soup.findAll(attrs={"id":"container"})[0].findAll("table")[0].findAll(recursive=False)[2:]
		print j;
		for i in clist:
			clms=i.findAll("td");
			cname=str(clms[0].text);
			(temp1,base_fair,temp2,base_km,temp3) = re.search('^([^\d]+) (\d+) ([^\d]+) (\d+) ([^\d]+)$',clms[1].text).groups()
			(temp1,perkm,temp2)=re.search('^([^\d]+) (\d+) ([^\d]+)$',clms[2].text).groups()
			if(clms[3].text!="N/A"):
				waiting_charge=re.search('(\d+)',clms[3].text).groups()[0]
			else:
				waiting_charge=0;
			if(clms[4].text!="N/A"):
				ride_charge=re.search('(\d+)',clms[4].text).groups()[0]
			else:
				ride_charge=0;

			data['ola']['city'][j]['cartypes'][cname]={"base_fair":base_fair,"base_km":base_km,"perkm":perkm,"waiting_charge":waiting_charge,"nbase_fair":base_fair,"nbase_km":base_km,"nperkm":perkm,"nwaiting_charge":waiting_charge,"ride_charge":ride_charge,"nride_charge":ride_charge};
			print cname,base_fair,base_km,perkm,waiting_charge,ride_charge

