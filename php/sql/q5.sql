select temp.daytime,count(temp.slot) as num_slot,group_concat(temp.slot) as fslot,sum(temp.isbook) as num_book from 
 ( select *,(sid>0) as isbook from timeslot where tid=? AND daytime>? AND daytime<? order by slot) temp 
group by daytime

