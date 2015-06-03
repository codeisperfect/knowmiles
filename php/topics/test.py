mapi={"tmp1":"IIT Mains","tmp2":"Class-VI","tmp3":"Class-VII","tmp4":"Class-VIII","tmp7":"Class XI","tmp8":"Class XII","tmp5":"Class IX","tmp6":"Class IX" ,"tmp9":"IIT Advance"};


# for pppp in range(1,10):
# 	f=open("tmp"+str(pppp));
# 	data=f.read().split("\n");
# 	f.close();
# 	keys=data[0].split("\t");
# 	outp={};
# 	for i in keys:
# 		outp[i]=[];
# 	for i in data[1:]:
# 		p=i.split('\t');
# 		if(len(p)==len(keys)):
# 			for j in range(len(p)):
# 				if(p[j]!=''):
# 					outp[keys[j]].append(p[j]);

# 	printp='$subt["'+mapi["tmp"+str(pppp)]+'"]=array(';
# 	for i in outp:
# 		printp+='"'+i+'"=>array(';
# 		printp+=str(outp[i])[1:-1]
# 		printp+="),";
# 	printp+=");\n";
# 	print printp;

f=open("tmp10");
data=f.read().split("\n");
f.close();
keys=data[0].split("\t");
outp={};
for i in keys:
	outp[i]=[];
for i in data[1:]:
	p=i.split('\t');
	if(len(p)==len(keys)):
		for j in range(len(p)):
			if(p[j]!=''):
				outp[keys[j]].append(p[j]);

printp='$subt["'+"Class-X"+'"]=array(';
for i in outp:
	printp+='"'+i+'"=>array(';
	printp+=str(outp[i])[1:-1]
	printp+="),";
printp+=");\n";
print printp;
