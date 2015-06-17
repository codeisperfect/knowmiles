
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


#driver=None;



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



def runjscode(jscode,retry=5):
	while (retry==-1 or retry>0 ):
		try:
			driver.execute_script(jscode);
			return True;
		except:
			print "Retrying.. ",retry
			retry-=1;
			time.sleep(1);
	return False;


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


def getalert(isa=False):
	alert=driver.switch_to_alert();
	outp=alert.text;
	if(isa):
		alert.accept();
	return outp;


bookurl="http://www.hellocabsdelhi.com/booking.html";
def book(name,phone,email,pickupdate,pickuptime,pickuploc,droploc):
	driver.get(bookurl);
	dataform={"phone":phone,"name":name, "email":email, "pick":pickuploc,"drop":droploc};
	for i in dataform:
		driver.find_elements_by_name(i)[0].send_keys(dataform[i]);

	try:
		(dd,mm,yyyy)=pickupdate.split("/")[:3];
		(time_hrs,time_min)=pickuptime.split(":");
		ddform={"noofpass":"03","dd":dd,"mm":mm,"yyyy":yyyy,"hrs":time_hrs,"min":time_min};
		for i in ddform:
			driver.find_element_by_css_selector("select[name="+i+"]").find_element_by_css_selector("option[value='"+ddform[i]+"']").click();
	except:
		pass
	time.sleep(0.5);
	driver.find_element_by_id("button").click();
	if(runpycode("getalert()")):
		return getalert(True);
	else:
		return "Error in booking";

if(0):
	driver = webdriver.Firefox()
	print book("mohit","123456","mohit@mail.com","18/06/2015","12:15","Delhi","India");

if(1):
	if(len(sys.argv)>7):
		driver = webdriver.Firefox()
		print book(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7]);
		driver.close();
	else:
		print "Arguments are not sufficient";

