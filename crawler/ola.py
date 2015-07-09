import os,re,csv
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
data['ola']={};
baseurl="https://www.olacabs.com/fares/";
soup=BeautifulSoup(curl(baseurl));
data['ola']['city']={};
allcity=soup.find(attrs={"id":"faresCityList"}).find("select",recursive=False).findAll("option",recursive=False);
for i in allcity:
	data['ola']['city'][str(i.text)]={'url':"https://www.olacabs.com/"+str(i['value'])}

count=0;
for j in data['ola']['city']:
	try:
		if(count>1 and 0 ):
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
				(ride_charge,temp,ride_charge_after)=re.search('(\d+)([^\d]+)(\d+)',clms[4].text+"_0").groups()
			else:
				ride_charge=0;
				ride_charge_after=0;

			data['ola']['city'][j]['cartypes'][cname]={"base_fair":base_fair,"base_km":base_km,"perkm":perkm,"waiting_charge":waiting_charge,"nbase_fair":base_fair,"nbase_km":base_km,"nperkm":perkm,"nwaiting_charge":waiting_charge,"ride_charge":ride_charge,"nride_charge":ride_charge,"ride_charge_after":ride_charge_after,"nride_charge_after":ride_charge_after};
#			print cname,base_fair,base_km,perkm,waiting_charge,ride_charge,ride_charge_after
	except:
		print "Error in this city", j;



if(1):
	ssdata=[];
	for i in data['ola']['city']:
		for j in data['ola']['city'][i]['cartypes']:
			b=data['ola']['city'][i]['cartypes'][j];
			ssdata.append(['ola',i,j,0,b['nbase_fair'],b['nbase_km'],b['nperkm'],b['nwaiting_charge'],b['base_fair'],b['base_km'],b['perkm'],b['waiting_charge'],0,0,0,b['ride_charge'],b['ride_charge_after']  ,b['nride_charge'],b['nride_charge_after']  ]);

def writetocsv(fn,data):
	csvfile=open(fn, 'wb');
	spamwriter = csv.writer(csvfile);
	for i in data:
		spamwriter.writerow(i)
	csvfile.close();

writetocsv("cars/ola.csv",ssdata);

#writefd(open("cars/ola",'w'),json.dumps(data))
