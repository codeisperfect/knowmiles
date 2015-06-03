import os,re,csv,json
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


def writetocsv(fn,data):
	csvfile=open(fn, 'wb');
	spamwriter = csv.writer(csvfile);
	for i in data:
		spamwriter.writerow(i)
	csvfile.close();


data={};
data['tfs']={};
baseurl="http://www.taxiforsure.com/pune-cabs/fares/";
soup=curl(baseurl);
data['tfs']['city']={};

searchregex="userCityId == '(\d+)'([^\d]+)baseParams.userCity = '(\w+)'";

allcity=list(re.finditer(searchregex,soup));
for i in allcity:
	(cid,temp,cname)=i.groups();
	data['tfs']['city'][str(cname)]={'url':"http://www.taxiforsure.com/fare-chart/?city="+str(cid)};


jdata=json.loads(curl("http://www.taxiforsure.com/fare-chart/?city=2073"));
ssdata=[];

ssdata.append([]);

if(1):
	count=0;
	for j in data['tfs']['city']:
		if(count>1 and 0 ):
			break;
		count+=1;
		data['tfs']['city']



if(0):
	ssdata=[];
	for i in data['tfs']['city']:
		for j in data['tfs']['city'][i]['cartypes']:
			b=data['tfs']['city'][i]['cartypes'][j];
			ssdata.append(['tfs',i,j,0,b['nbase_fair'],b['nbase_km'],b['nperkm'],b['nwaiting_charge'],b['base_fair'],b['base_km'],b['perkm'],b['waiting_charge'],0,0,0,b['ride_charge'],b['ride_charge_after']  ,b['nride_charge'],b['nride_charge_after']  ]);


	writetocsv("cars/tfs.csv",ssdata);


#writefd(open("cars/tfs",'w'),json.dumps(data))
