insert into noteshare_user 
values('mr user', 'userguy@gmail.com', 'N', 'qwerty');
insert into noteshare_user 
values('dr user', 'userlady@gmail.com', 'Y', 'p455w0rd');

insert into term
values('W2', '2012'); 

insert into course_is_in
values('304', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in
values('317', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in
values('310', 'CPSC', 'UBC', 'W2', 2012);

insert into document 
values (123, to_date('1998/05/11:12:00:00', 'yyyy/mm/dd:hh:mi:ss'),'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '317', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document 
values (126, to_date('1998/05/11:12:00:00', 'yyyy/mm/dd:hh:mi:ss'),'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '304', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');

insert into ns_comment
values(to_date('1998/05/11:12:00:00', 'yyyy/mm/dd:hh:mi:ss'), 'Why does this only let us do twitter-length messages?','225', 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , '2012');
insert into ns_comment
values(to_date('1998/05/11:12:00:00', 'yyyy/mm/dd:hh:mi:ss'), 'Because it saves space in our database.', '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');

insert into comment_with_doc
values('222', '123');
insert into comment_with_doc
values('225', '126');