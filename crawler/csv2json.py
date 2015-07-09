import json,csv
from collections import OrderedDict

def writefd(fd,data):
	fd.write(data);
	fd.close();

def readcsv(fn):
	f=open(fn);
	outp=[];
	for row in csv.reader(f):
		outp.append(row);
	return outp;

cdata=readcsv( sys.argv[1] );
writefd( open(sys.argv[2],'w'), json.dumps({"data":cdata}) );
