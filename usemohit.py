import os,sys,time
def elc(c):
	f=os.popen(c);
	data=f.read();
	f.close();
	return data;

def readfile(filen):
	f=open(filen,'r');
	data=f.read();
	f.close();
	return data;

def writefile(filen,data):
	f=open(filen,'w');
	f.write(data);
	f.close();


