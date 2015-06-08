#listen_port=1129

import os,sys,time,socket,json;
from usemohit import *;


agents={};#Aid => ('sock'=>socket object, 'que'=> {'userid'=>status Que(wentForCalculate)  }  )
requests={};#userid => socket objects


errorcodes={-30:"Killed",-31:"No Grade Checking Agent is running",-32:"Your password was incorrect",-33:"Unexpected Error ! ",-34:"Not Valid inputs",-35:"Server not running"};



listen_port=int(readfile("listenport"));

def reg():
	s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	s.connect(("www.iitd.ac.in",80))
	myip=s.getsockname()[0];
	s.close()
	return myip;


def closewithmsg(conn,msg,ec=-30):
	conn.send( json.dumps({"msg":msg,"ec":ec}) );
	conn.close();


def serv():
	sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	sock.bind(('',listen_port))
	sock.listen(1);

	def killifexist(d,key,v):
		if(d[key]!=None):
			closewithmsg(d[key],"Killed");
		d[key]=v;

	def myjob(aid):
		uids=[];
		for i in agents[aid]['que']:
			if(not(agents[aid]['que'][i])):
				uids.append(i);
				agents[aid]['que'][i]=True;
		if(len(uids)>0):
			agents[aid]['sock'].send( json.dumps({"msg":"order","users":uids,"ec":1})  );
			agents[aid]['sock'].close();
			agents[aid]['sock']=None;

	def talk(conn,client_address):#talk to each request
		print "a Client connected me ",client_address;
		cmd=conn.recv(1024);
		try:
			cmd=json.loads(cmd);
		except:
			closewithmsg(conn,"Not Valid Inputs");
			return;
		if(cmd['cmd']=="kill"):
			closewithmsg(conn,"killed");
			elc("kill "+str(os.getpid()));
		elif(cmd['cmd']=="ready"):
			aid=cmd['id'];
			if(agents.has_key(aid)):
				killifexist(agents[aid],'sock',conn);
			else:
				agents[aid]={'sock':conn,'que':{}};
				for r in requests:
					agents[aid]['que'][r]=False;
			myjob(aid);

		elif(cmd["cmd"]=="calg"):
			username=cmd["username"];
			if(requests.has_key(username)):
				closewithmsg(requests[username],"Killed");
			requests[username]=conn;
			for i in agents:
				agents[i]['que'][username]=False;
				if(agents[i]['sock']!=None):
					myjob(i);
			if(len(agents)==0):
				closewithmsg(conn,"No Agent is running",-31);
				requests.pop(username);

		elif(cmd["cmd"]=="foundg"):
			if(requests.has_key(cmd["username"]) ):
				closewithmsg(requests[cmd["username"]],cmd["grades"],cmd["grades"]['ec']);
				requests.pop(cmd["username"],None);
				for i in agents:
					agents[i]['que'].pop(cmd["username"]);
				closewithmsg(conn,"thanku :)",1);#Super good news
			else:
				closewithmsg(conn,"Actually Someone else Already Calculted it ! Thank you Anyway !",2);#Good news
		print agents;
		print requests;
	while True:
		print "Waiting...";
		conn, client_address = sock.accept();
		talk(conn,client_address);
#		thread.start_new_thread(talk,(conn,client_address));
	sock.close();

print "I am ",reg()," On port ",listen_port;
serv();

