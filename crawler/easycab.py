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


data={};
data['ec']={};
baseurl="http://www.easycabs.com/tariff.php";
soup=BeautifulSoup(curl(baseurl));
data['ec']['city']={};

allcity=soup.findAll(attrs={"class":"magindiv"})[1].findAll("a");
for i in allcity:
	data['ec']['city'][str(i.text)]={"tabid":"div"+i['id']};







if(1):
	count=0;
	for j in data['ola']['city']:
		if(count>0 and 1):
			break;
		count+=1;
		tabid=data['ola']['city'][j]['tabid']
		data['ola']['city'][j]['cartypes']={'sedan'};
		cdata=soup.find(attrs={"id":tabid}).find("table").findAll("tr");
		cdata[0].findAll("th")[1].find("span").text.replace("Midnight","00:00am");

	if(0):
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

