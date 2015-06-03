import xlrd,json

def writefd(fd,data):
	fd.write(data);
	fd.close();


if(1):
	wb=xlrd.open_workbook("database all.xlsx");
	ws=wb.sheet_by_name("Sheet1");

data={};
def setifunset(data,key,val):
	if(not(data.has_key(key))):
		data[key]=val;

allcity={};
allcars={};
allcars_ids={};
allcartypes={};

for i in range(1,ws.nrows):
	row=[];
	for j in range(min(ws.ncols,16)):
		row.append(str(ws.cell(i,j).value))

	setifunset(allcars,row[0],{});
	setifunset(allcity,row[1],1);
	setifunset(allcars[row[0]],row[2],1);

	setifunset(data,row[0],{});
	setifunset(data[row[0]],row[1],{});
	setifunset(data[row[0]][row[1]],row[2],row[3:] );

ii=1;
for i in allcity:
	allcity[i]=ii;
	ii+=1;

jj=1;
for i in allcars:
	for j in allcars[i]:
		allcars[i][j]=jj;
		jj+=1;
ii=1;
for i in allcars:
	allcars_ids[i]=ii;
	ii+=1;

ii=1;
db_car=[];
db_cartypes=[];


for i in allcars:
	db_car.append([ii,i]);
	ii+=1;
	for j in allcars[i]:
		db_cartypes.append([allcars[i][j],j]);

db_city=[];
for i in allcity:
	db_city.append([allcity[i],i]);

db_cardata=[];
for i in data:
	for j in data[i]:
		for k in data[i][j]:
			db_cardata.append([allcars_ids[i],allcity[j],allcars[i][k]]+data[i][j][k])



outp={"db_car":db_car,"db_city":db_city,"db_cartypes":db_cartypes,"db_cardata":db_cardata};
writefd( open("json_car_data.json",'w'), json.dumps(outp) );

