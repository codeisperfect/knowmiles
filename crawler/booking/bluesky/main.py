
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


bookurl="http://www.blueskycabs.com/tariff.html";
def book(name,phone,email,pickupdate,pickuptime,pickuploc,droploc):
	driver.get(bookurl);
	dataform={"phone":phone,"name":name, "clock":pickuptime, "date":pickupdate,"locationfrom":pickuploc,"to":droploc};
	for i in dataform:
		driver.find_elements_by_name(i)[0].send_keys(dataform[i]);
	driver.find_elements_by_css_selector(".Form > form")[0].submit();
	if(runpycode('driver.find_element_by_id("about_body").text')):
		return driver.find_element_by_id("about_body").text;
	else:
		return "Some error in booking";


if(0):
	driver = webdriver.Firefox()
	print book("mohit","0","mohit@mail.com","06/18/2015","12:56","Delhi","India");

if(1):
	if(len(sys.argv)>7):
		driver = webdriver.Firefox()
		print book(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7]);
		driver.close();
	else:
		print "Arguments are not sufficient";

