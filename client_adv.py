#PORT = 1129
import socket,sys

# if(len(sys.argv)>1):
# 	HOST=sys.argv[1];
# else:
# 	print "Provide IP address at argument1";
# 	exit(0);

import json
from usemohit import *

HOST="10.208.20.186";
HOST="172.31.15.215";
#HOST="10.208.20.185";


PORT=int(readfile("listenport"));



try:
#	msg=json.dumps({"cmd":sys.argv[1], "username":sys.argv[2],"id":sys.argv[3],"grades":sys.argv[4]  });
	msg=json.dumps(json.loads(sys.argv[1]));
except:
	msg="";
	print "Not Valid Inputs";

if(msg!=""):
	s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	try:
		s.connect((HOST, PORT))
		s.send(msg);
		got=s.recv(40960);
		print got;
		s.close()
	except:
		print(json.dumps({"ec":-35,"msg":"Error in connection :"+str(sys.exc_info()[0])}));



