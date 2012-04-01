insert into noteshare_user 
values('mr user', 'userguy@gmail.com', 'N', 'qwerty');
insert into noteshare_user 
values('dr user', 'userlady@gmail.com', 'Y', 'p455w0rd');

insert into term
values('W2', '2012'); 

insert into course_is_in
values('304', 'DATABAAASE', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in
values('317', 'INTERNETS', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in
values('310', 'WIZARD SCIENCE', 'CPSC', 'UBC', 'W2', 2012);

insert into document 
values (123, 'My work', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '317', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document 
values (126, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '304', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');

insert into ns_comment
values(default, 'Why does this only let us do twitter-length messages?','225', 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , '2012');
insert into ns_comment
values(default, 'Because it saves space in our database.', '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');

insert into comment_with_doc
values('222', '123');
insert into comment_with_doc
values('225', '126');

insert into ns_comment values(to_date('1998/05/11:12:00:33', 'yyyy/mm/dd:hh:mi:ss'), 'This is a comment!', '333', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into comment_with_doc values('333', '126');

select email, comment_time, text from ns_comment where comment_id in (select comment_id from comment_with_doc where document_id = 126) order by comment_time;
