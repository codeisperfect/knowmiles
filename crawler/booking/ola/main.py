u="siddharth50563@gmail.com";
p="aashram19!";

#now_utc = datetime.now(timezone('Asia/Kolkata'))
#print now_utc.strftime(fmt)


from datetime import datetime
from pytz import timezone
import urllib
import os,re,csv,json,datetime
from BeautifulSoup import BeautifulSoup
import mechanize;
import sys,time
from selenium import webdriver


from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.proxy import *
from BeautifulSoup import BeautifulSoup


driver=None;



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



def runjscode(jscode):
	while 1:
		try:
			driver.execute_script(jscode);
			break;
		except:
			time.sleep(1);


def runpycode(pycode,retry=5):
	while (retry==-1 or retry>0 ):
		try:
			eval(pycode);
			return True;
		except:
			print "Retring.. ",retry ;
			retry-=1;
			time.sleep(1);
	return False;


def getcaptcha():
	url="https://www.olacabs.com/login";
	driver.get(url);
	captchaimg=driver.find_elements_by_name("password")[0].find_element_by_xpath("../../..").find_elements_by_tag_name("img")[0].get_attribute("src");
	return captchaimg;


def login(u,p,captchatext):
	driver.find_elements_by_name("login")[0].send_keys(u);
	driver.find_elements_by_name("password")[0].send_keys(p);
	driver.find_elements_by_name("captcha")[0].send_keys(captchatext);
	driver.find_elements_by_name("password")[0].find_element_by_xpath("../../..").find_elements_by_css_selector("input[type=submit]")[0].click();

def getallcityids():
	soup=BeautifulSoup(curl("https://www.olacabs.com/"));
	allcitytags=soup.find(attrs={"id":"cityID"}).findAll(recursive=False)
	outp={};
	for i in allcitytags:
		outp[str(i.text)]=str(i['value']);
	return outp;


allcityids=getallcityids();



def bookpage(city,datestr,timestr,carname):
#	datestr=time.strftime("%m/%d/%Y");
#	timestr=time.strftime("%I:%M %p");
	carnames={"Mini":"compact","Economy Sedan":"economy_sedan"};
	bookurl="https://www.olacabs.com/book?"+urllib.urlencode({"cityID": allcityids[city],"pickupDate":datestr,"pickupTime":timestr, "serviceType":"3"});
	driver.get(bookurl);
	runpycode('driver.find_element_by_id("submitStep1").click()');
	runpycode("""driver.find_element_by_css_selector("select#carType > option[value='"""+carnames[carname]+"""']").click()""");


#https://www.olacabs.com/book?cityID=1&pickupDate=05%2F06%2F2015&pickupTime=05%3A15+PM&serviceType=3

driver = webdriver.Firefox()


getcaptcha();
login(u,p,"V9E6");

city="Delhi"
datestr="29/6/2015";
timestr="12:30 AM";
carname="Economy Sedan";
bookpage(city,datestr,timestr,carname);



#driver.close();