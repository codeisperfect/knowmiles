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
soup=BeautifulSoup(readfd(open("locadata.html")));

allloc=soup.find(attrs={"name":"pickupLocality"}).findAll(recursive=False)[1:]
locdict={};
for i in allloc:
	locdict[str(i['value'])]=str(i.text);

