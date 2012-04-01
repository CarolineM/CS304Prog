DROP TABLE comment_with_doc;
DROP TABLE ns_comment;
DROP TABLE document;
DROP TABLE course_is_in;
DROP TABLE term;
DROP TABLE noteshare_user;

CREATE TABLE noteshare_user
	(username VARCHAR(40) NOT NULL, 
	email VARCHAR(40),
	isprofessor CHAR(1) CHECK (isprofessor IN ( 'Y', 'N' )) NOT NULL,
	password VARCHAR(12) NOT NULL,
	PRIMARY KEY (email)
        );
GRANT SELECT ON noteshare_user TO PUBLIC;

CREATE TABLE term(
	semester VARCHAR(4) NOT NULL,
	tyear NUMBER(4) NOT NULL,
	PRIMARY KEY(semester, tyear));
GRANT SELECT ON term TO PUBLIC;

CREATE TABLE course_is_in(
	course_num NUMBER(3),
        course_name VARCHAR(30) NOT NULL,
	dept VARCHAR(4),
	institution CHAR(30),
	semester VARCHAR(4),
	tyear   NUMBER(4),
	PRIMARY KEY (course_num, dept, semester, tyear, institution),
	FOREIGN KEY (semester, tyear) REFERENCES term ON DELETE CASCADE
        );
GRANT SELECT ON course_is_in TO PUBLIC;

CREATE TABLE document
	(document_id NUMBER(9),
        document_name VARCHAR(30) NOT NULL,
	document_time TIMESTAMP default systimestamp NOT NULL,
    	document_file VARCHAR(500) NOT NULL,
    	course_num NUMBER(3) NOT NULL,
	dept VARCHAR(4) NOT NULL,
	institution CHAR(30) NOT NULL,
	semester VARCHAR(4) NOT NULL,
	tyear  NUMBER(4) NOT NULL,
        email VARCHAR(40),
	PRIMARY KEY (document_id),
        FOREIGN KEY (course_num, dept, semester, tyear, institution) REFERENCES course_is_in ON DELETE CASCADE,
        FOREIGN KEY (email) REFERENCES noteshare_user ON DELETE SET NULL
        );
GRANT SELECT ON document TO PUBLIC;
 
CREATE TABLE ns_comment
	(comment_time TIMESTAMP default systimestamp NOT NULL,
	text VARCHAR(2000) NOT NULL,
	comment_id NUMBER(9),
	email VARCHAR(40),
    	course_num NUMBER(3) NOT NULL,
	dept VARCHAR(4) NOT NULL,
	institution CHAR(30) NOT NULL,
	semester VARCHAR(4) NOT NULL,
	tyear  NUMBER(4) NOT NULL,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (email) REFERENCES noteshare_user ON DELETE SET NULL,
        FOREIGN KEY (course_num, dept, semester, tyear, institution) REFERENCES course_is_in ON DELETE CASCADE
	);
GRANT SELECT ON ns_comment TO PUBLIC;	

	
CREATE TABLE comment_with_doc
	(comment_id NUMBER(9),
    	document_id NUMBER(9),
	PRIMARY KEY (comment_id, document_id),
    	FOREIGN KEY (document_id) REFERENCES document ON DELETE CASCADE,
    	FOREIGN KEY (comment_id) REFERENCES ns_comment ON DELETE CASCADE
     	);

GRANT SELECT ON comment_with_doc TO PUBLIC;