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
data['meru']={};
baseurl="https://www.merucabs.com/fares/";
soup=BeautifulSoup(curl(baseurl));
data['meru']['city']={};

allcity= soup.find(attrs={"id":"cityn"}).findAll(recursive=False);


alldata=list(i.groups() for i in list(re.finditer("city == '([^']+)'\)\{([^\}]+)",str(soup))));



ssdata=[];

limit =0;
for i in allcity:
	data['meru']['city'][str(i.text)]={'url':''};

#writetocsv("cars/tfs.csv",ssdata);

