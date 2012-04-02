insert into noteshare_user values('mr user', 'userguy@gmail.com', 'N', 'qwerty');
insert into noteshare_user values('dr user', 'userlady@gmail.com', 'Y', 'p455w0rd');
insert into noteshare_user values('awesome user', 'dupuserguy@gmail.com', 'N', 'password');
insert into noteshare_user values('awesome user', 'duplicate.com', 'N', 'password');
insert into noteshare_user values('dr talent', 'user@mail.com', 'Y', 'password');



insert into term values('W2', 2012);

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
insert into document values (148, 'Isnt it the same one', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '316', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (149, 'No.', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '314', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (150, 'Document', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '317', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (151, 'Another one', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '304', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (152, 'MY work.', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '310', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (153, 'Document', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '312', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (154, 'Caroline', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '316', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');
insert into document values (155, 'This one is interesting', default, 'http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf', '314', 'CPSC', 'UBC', 'W2', 2012, 'userguy@gmail.com');

insert into ns_comment values(default, 'Im going to comment on every document',400, 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',401, 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',402, 'userlady@gmail.com', '317', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',403, 'userlady@gmail.com', '317', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',404, 'userlady@gmail.com', '310', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',405, 'userlady@gmail.com', '310', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',406, 'userlady@gmail.com', '316', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',407, 'userlady@gmail.com', '316', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',408, 'userlady@gmail.com', '312', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',409, 'userlady@gmail.com', '312', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',410, 'userlady@gmail.com', '314', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Im going to comment on every document',411, 'userlady@gmail.com', '314', 'CPSC', 'UBC', 'W2' , 2012);

insert into ns_comment values(default, 'Why does this only let us do twitter-length messages?',144, 'userlady@gmail.com', '304', 'CPSC', 'UBC', 'W2' , 2012);
insert into ns_comment values(default, 'Because it saves space in our database.', 222, 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', 2012);
insert into ns_comment values(default, 'Because it saves space in our database??', 234, 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', 2012);
insert into ns_comment values(default, 'Huh?', 228, 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
insert into ns_comment values(default, 'This is a course comment in 317.', 230, 'userguy@gmail.com', '317', 'CPSC', 'UBC', 'W2', 2012);
insert into ns_comment values(default, 'This is a course comment in 310.', 232, 'userguy@gmail.com', '310', 'CPSC', 'UBC', 'W2', 2012);

insert into comment_with_doc values(400, 144);
insert into comment_with_doc values(401, 145);
insert into comment_with_doc values(402, 146);
insert into comment_with_doc values(403, 147);
insert into comment_with_doc values(404, 148);
insert into comment_with_doc values(405, 149);
insert into comment_with_doc values(406, 150);
insert into comment_with_doc values(407, 151);
insert into comment_with_doc values(408, 152);
insert into comment_with_doc values(409, 153);
insert into comment_with_doc values(410, 154);
insert into comment_with_doc values(411, 155);


