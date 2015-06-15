import datetime;
def time2h(inp):
	try:
		return datetime.datetime.strptime(inp.split('-')[0],"%I:%M%p").hour
	except:
		print "error for input="+inp
		return 0;
