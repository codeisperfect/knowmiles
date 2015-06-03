from BeautifulSoup import BeautifulSoup
import sys

def readfd(fd):
	data=fd.read();
	fd.close();
	return data;

def writefd(fd,data):
	fd.write(data);
	fd.close();

def f(inp):
	soup=BeautifulSoup(readfd(open(inp)))
	mclasses=soup.findAll("div",attrs={"class":"field-item even"});
	return ("".join([str(x) for x in mclasses[0].contents ])) if (len(mclasses)>0 ) else  ""


def correct(inp,outp):
	soup=BeautifulSoup(readfd(open(inp)))
	writefd(open(outp,'w'),soup.prettify());



if(sys.argv[1]=='correct'):
	correct(sys.argv[2],sys.argv[3]);
