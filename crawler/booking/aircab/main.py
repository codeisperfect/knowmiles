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


#allcityids=getallcityids();

def getalert(isa=False):
	alert=driver.switch_to_alert();
	outp=alert.text;
	if(isa):
		alert.accept();
	return outp;


bookurl="http://aircab.co.in/HomeStyle1.aspx";
def book(name,phone,email,pickupdate,pickuptime,pickuploc,droploc):
	driver.get(bookurl);
	dataform={"ctl00_txtmob":phone,"ctl00_txtname":name,"ctl00_txtemail":email,"ctl00_txtcal":pickupdate,"ctl00_txtPickupLoc":pickuploc,"ctl00_txtDropLoc":droploc};
	ddform={"ctl00_DropDownList1":pickuptime};
	for i in dataform:
		driver.find_element_by_id(i).send_keys(dataform[i]);
	for i in ddform:
		driver.find_element_by_css_selector("select#"+i+" > option[value='"+pickuptime+"']").click();
	time.sleep(0.5);
	driver.find_element_by_id("ctl00_Submit").click();
	if(runpycode("getalert()")):
		return getalert(True);
	else:
		return "Some error in booking";




if(1):
	if(len(sys.argv)>7):
		driver = webdriver.Firefox()
		print book(sys.argv[1],sys.argv[2],sys.argv[3],sys.argv[4],sys.argv[5],sys.argv[6],sys.argv[7]);
		driver.close();
	else:
		print "Arguments are not sufficient";

