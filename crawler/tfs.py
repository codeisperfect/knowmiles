import os,re,csv,json,datetime
from BeautifulSoup import BeautifulSoup
from usemohit import *

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

ssdata=[];

limit =500000;
for i in allcity:
	if(limit<=0):
		break;
	limit-=1;
	(cid,temp,cname)=i.groups();
	city=str(cname);
	url="http://www.taxiforsure.com/fare-chart/?city="+str(cid);
	data['tfs']['city'][city]={'url':url};
	try:
		jdata=json.loads(curl(url));
	except:
		print "Error in City : "+city+",  Ignored ! moved ahead";
		continue;
	dinfo=jdata['response_data']['response_data']['day']['p2p'];
	ninfo=jdata['response_data']['response_data']['night']['p2p'];
	ntime=jdata['response_data']['response_data']['night']['timings'];
	dtime=jdata['response_data']['response_data']['day']['timings'];
	for j in range(min(len(ninfo),len(dinfo))):
		i=ninfo[j];
		k=dinfo[j];
		row=['TaxiForSure',city,i['car_model'],time2h(ntime), i['base_fare'], i['base_km'],i['extra_km_fare'],0,k['base_fare'],k['base_km'],k['extra_km_fare'],0,time2h(dtime),0,0,k['trip_time_pulse_rate'],0,i['trip_time_pulse_rate'],0];
		ssdata.append(row);
	print "Done for city : ",city;


writetocsv("cars/tfs.csv",ssdata);


#ssdata.append([]);

if(0):
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
