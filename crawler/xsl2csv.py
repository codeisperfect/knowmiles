import xlrd, csv, sys



def csv_from_excel(inp, outp):
	wb = xlrd.open_workbook(inp)
	sh = wb.sheet_by_index(0);
	your_csv_file = open(outp, 'wb')
	wr = csv.writer(your_csv_file)
	for rownum in xrange(sh.nrows):
		wr.writerow(sh.row_values(rownum))
	your_csv_file.close()

csv_from_excel(sys.argv[1], sys.argv[2]);
