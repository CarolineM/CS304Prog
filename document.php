

	<div class="container">
	<p>Put header back when error stops!!!!!!!!</p>

	<h1>Document page</h1>
	
	<p>Select a Course<br>
		<select name="document">
		<option value="Option1" selected>CPSC 304</option>
		<option value="Option2">CPSC 317</option>
		<option value="Option3">CPSC 310</option>
		<option value="Option4">CPSC 313</option>
		</select>
	</p>
	  
	<p>Select a Document<br>
		<select name="document">
		<option value="Option1" selected>Introduction to Database Systems</option>
		<option value="Option2">doc2</option>
		<option value="Option3">doc3</option>
		<option value="Option4">doc4</option>
		</select>
	</p>
	<input type="button" onclick="" value="Load Document"/>
	
	<iframe src="http://docs.google.com/gview?url=http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf" style="width:1000px; height:600px;" frameborder="0"></iframe>
	
	<textarea name="comment" cols="80">Insert document comments here...</textarea> </br>
	
	<input type="button" onclick="" value="Submit Comment"/>
	
	<br> haxorGuy - March 26, 2012 8:22 - These are old notes</br>
	<br> haxorGirl - March 26, 2012 8:35 - No they aren't, I just posted them.</br>
	
	 <!--	  
	SUBMIT COMMENT
	
	TIMESTAMP		
		var $timestamp = date(DATE_RFC822);
		date_format($timestamp, 'yyyy/mm/dd:hh:mi:ss'); 
		
	SUBMIT COMMENT QUERY
		insert into ns_comment
			values(to_date($timestamp, 'yyyy/mm/dd:hh:mi:ss'), (comment from text area comment), '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
		
		insert into comment_with_doc
			values('222', '123');
				
		
	RETRIEVE COMMENTS ON A PARTICULAR DOCUMENT
		select text from ns_comment where comment_id = (select comment_id from comment_with_doc where document_id = (var for doc id here);
	  
	RETRIEVE COURSE NUMBERS FOR LIST
		select course_num from course_is_in;
		
	RETRIEVE DOCUMENTS IN A COURSE(from list)
		select document_id from document where course_num = (var from course number table);
		
	RETRIEVE DOCUMENT GIVEN DOC NAME (we have to add document name)
		select document_id from document where doc_name = (doc name from table);
		this needs more for unique
	  -->
	  

    </div> <!-- /container -->
	

<?php include("footer.php"); ?>
