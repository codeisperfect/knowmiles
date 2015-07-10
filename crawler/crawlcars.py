import os, re, csv, sys, json

def readcsv(fn):
	f=open(fn);
	outp=[];
	for row in csv.reader(f):
		outp.append(row);
	return outp;
	f.close();


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

pyfiles=["ola", "tfs", "easycabs", "blueskycabs", "yocabs", "wowcabs", "sachincabs", "hellocabs", "megacabs"];
dontdo=["ola", "tfs"];


def crawlall():
	for i in pyfiles:
		if i not in dontdo:
			print "Crawling ",i,"...";
			os.system("timeout 500 python "+i+".py");

def convcsv():
	xlsfiles = pyfiles[2:]
	for i in xlsfiles:
		needfile = i+".xls";
		if(os.path.isfile(needfile)):
#		print elc("libreoffice --headless --convert-to csv "+i+".xls --outdir cars");
			print elc("python xsl2csv.py "+needfile+" cars/"+i+".csv");

def mergeall(outpfile, jsonfile):
	data="\n";
	for i in pyfiles:
		needfile = "cars/"+i+".csv";
		if(os.path.isfile(needfile)):
			data+=readfd(open(needfile));
	writefd(open(outpfile, 'w'), data);
	cdata=readcsv( outpfile );
	writefd( open(jsonfile,'w'), json.dumps({"data":cdata}) );


crawlall();
print "Crawling finished.";
convcsv();
mergeall("cars/crawldata.csv", "cars/crawldata.json");
