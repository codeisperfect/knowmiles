import socket
import time
from usemohit import *;


def reg(filen):
	s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	s.connect(("www.iitd.ac.in",80))
	myip=s.getsockname()[0];
	s.close()
	return myip;



PORT = 1113
ip=readfile("myip");

def exec_lc(cmd):
	if(cmd==''):
		return '';
	try:
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s.settimeout(60);
		s.connect((ip, PORT))
		s.send(cmd)
		leng = int(s.recv(15));
		s.send('y');
		outp=s.recv(leng);
		s.send("logout");
		s.close()
		return outp;
	except:
		return "";

if(len(sys.argv)>1):
	print exec_lc(sys.argv[1]),