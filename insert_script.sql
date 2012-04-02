insert into noteshare_user values('mr user', 'userguy@gmail.com', 'N', 'qwerty');
insert into noteshare_user values('dr user', 'userlady@gmail.com', 'Y', 'p455w0rd');
insert into noteshare_user values('awesome user', 'dupuserguy@gmail.com', 'N', 'password');
insert into noteshare_user values('dr talent', 'user@mail.com', 'Y', 'password');

insert into term
values('W2', '2012');
values('W1', '2012');
values('W3', '2012');
values('W4', '2012');

insert into course_is_in values('304', 'DATABAAASE', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in values('317', 'INTERNETS', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in values('310', 'WIZARD SCIENCE', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in values('312', 'BORING CLASS', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in values('316', 'CAROLINE', 'CPSC', 'UBC', 'W2', 2012);
insert into course_is_in values('314', 'A CLASS', 'CPSC', 'UBC', 'W2', 2012);

insert into document values (144, 'My work', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '317', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (145, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '304', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (146, 'Some other doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '310', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (147, 'This a doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '312', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (148, 'Isn't it the same one?', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '316', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (149, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '314', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (150, 'My work', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '317', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (151, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '304', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (152, 'My work', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '310', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (153, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '312', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (154, 'My work', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '316', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (155, 'Awesome Doc', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '314', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');

insert into ns_comment
values(default, 'Why does this only let us do twitter-length messages?','225', 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , '2012');
insert into ns_comment
values(default, 'Because it saves space in our database.', '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into ns_comment
values(default, 'Because it saves space in our database??', '234', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into ns_comment
values(default, 'This is a course comment in 304.', '228', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into ns_comment
values(default, 'This is a course comment in 317.', '230', 'userguy@gmail.com', '317', 'CPSC', 'UBC', 'W2', '2012');
insert into ns_comment
values(default, 'This is a course comment in 310.', '232', 'userguy@gmail.com', '310', 'CPSC', 'UBC', 'W2', '2012');

insert into comment_with_doc
values('222', '123');
insert into comment_with_doc
values('225', '126');

insert into ns_comment values(default, 'This is a comment!', '333', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into comment_with_doc values('333', '126');

select email, comment_time, text from ns_comment where comment_id in (select comment_id from comment_with_doc where document_id = 126) order by comment_time;
