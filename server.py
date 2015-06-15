import thread
import os,sys,time,socket;

from usemohit import *;

proxys=[21,22,62,82,61];#61 is phd
listen_port=1113;

def ep(num):
	return 'export http_proxy="http://10.10.78.'+str(num)+':3128" export  https_proxy="http://10.10.78.'+str(num)+':3128" ; ';

def islogin():
	for i in proxys:
		testData=elc(ep(i)+'curl --connect-timeout 10 -s google.com');
		if(testData!=""):
			return i;
	return False;

def reg(filen):
	s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	s.connect(("www.iitd.ac.in",80))
	myip=s.getsockname()[0];
	s.close();
	writefile(filen,myip);
	return myip;



def serv():
	sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	sock.bind(('',listen_port))
	sock.listen(1);
	def talk(conn,client_address):
		print "a Client connected me ",client_address;
		while True : 
			cmd=conn.recv(15000);
			if(cmd=="logout"):
				break;
			print "From ",client_address," Received command ",cmd,"....",
			sending_data="";
			if(cmd=="islogin"):
				sending_data=str(islogin());
			elif(cmd=='myid'):
				sending_data=str(client_address[1]);
			elif(cmd[:5]=='proxy'):
#				ptype=islogin();
				ptype=22;
				if(ptype):
					sending_data=elc( ep(ptype) + cmd[6:]);
			else:
				sending_data=elc(cmd);
			conn.send(str(len(sending_data)));
			conf=conn.recv(1);
			if(conf=='y'):
				if(sending_data==""):
					sending_data="done";
				conn.send(sending_data);
#				leng=len(sending_data);
#				for i in range(0,leng,1024):
#					conn.send(sending_data[i:min(leng,i+1024)]);
			print "Sent it's executed value ! ";
		print client_address," client closed connection";


	while True:
		print "Waiting...";
		conn, client_address = sock.accept();
		thread.start_new_thread(talk,(conn,client_address));
	sock.close();

print "I am ",reg("myip");

serv();


