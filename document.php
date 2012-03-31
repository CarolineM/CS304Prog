<?php
	//include("header.php");
	//global $db_conn = OCILogon("y8r7", "ora_a28438109", "ug");
?>


	<div class="container">

	<h1>Document page</h1>
	
	
	
	<p>1.) Select a Course<br>
		<select name="course">
		<?php
		/*
		if(!$db_conn){
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$query = oci_parse($db_conn, "SELECT course_num FROM course_is_in");
		$i = 0;
			
		while($row = oci_fetch_array($query, OCI_NUM)
		{
			echo "<option value=Option". $i .">CPSC " . $row[$i] . "</option>";
			$i++;
		}*/		
		?>
		</select>
	</p>
	
	<form method = "POST" action="document.php">  
		Select a Document<br>
		<select name="document">
		
		</select>
		<input type="submit"/>
	</form>
		<?php
		
		if(!$db_conn){
			
		}
		$query = oci_parse($db_conn, "select document_id from document where course_num =");
		?>
	</p>
	
	<input type="button" onclick="" value="Load Document"/>
	
	<iframe src="http://docs.google.com/gview?url=http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf" style="width:1000px; height:600px;" 
frameborder="0"></iframe>
	
	<textarea name="comment" cols="80">Insert document comments here...</textarea> </br>
	
	<input type="button" onclick="" value="Submit Comment"/>
	
	
	<br> welcome <?php echo $_POST["document"]; ?> .</br>
	
	<br> haxorGirl - March 26, 2012 8:35 - No they arent, I just posted them.</br>
	
	 <!--	  
	SUBMIT COMMENT
	
	TIMESTAMP		
		var $timestamp = date(DATE_RFC822);
		date_format($timestamp, 'yyyy/mm/dd:hh:mi:ss'); 
		
	SUBMIT COMMENT QUERY
		insert into ns_comment
			values(to_date($timestamp, 'yyyy/mm/dd:hh:mi:ss'), (comment from text area comment), '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', 
'2012');
		
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
