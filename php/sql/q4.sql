select daystarttime,temp3.slot from
 (select temp2.id+temp1.id*7*3600*24 as daystarttime from 
  (select 0 as id union select 1 union select 2 union select 3)temp1,
  (select 600 as id union select 700 union select 800 union select 500)temp2
 )temp11,(select 0 as slot union select 1 union select 2 union select 3)temp3
