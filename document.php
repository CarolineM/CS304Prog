<?php
	include("header.php");
	$db_conn = OCILogon("ora_y8r7", "a28438109", "ug");
?>


	<div class="container">

	<h1>Document page</h1>
	
	<p>Select a Course<br>
		<form method = "POST" action = "document.php">
		<select name="course">
		<?php
			$query = "select course_num from course_is_in";
		if(!$db_conn){
			echo "<p>This doesn't work</p>";
		//	$e = oci_error();
			//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		else{
			$parsed = oci_parse($db_conn, $query);
			if (!$parsed){
				$e = OCIError($db_conn);  
				echo htmlentities($e['message']); 
				exit;
			}
			
			$r=OCIExecute($parsed, OCI_DEFAULT); 
				if (!$r){
				$e = oci_error($parsed); 
				echo htmlentities($e['message']);
				exit;
				}

			while($row = oci_fetch_array($parsed, OCI_NUM))
			{
				echo "<option value=" . $row[0] .">CPSC " . $row[0] . "</option>";
			}	
		}
		
		?>
		</select>
		<input type = "submit" value = "Filter Documents"/>
		</form>
	</p>

		<?php
		
		$cnum = $_POST['course'];
		if(!empty($cnum)){
			echo "<form method = \"POST\" action=\"document.php\">";
			echo "Select a Document<br>";
			echo "<select name=\"document\">";
			

			

				$query2 = "select document_id, document_name from document where course_num = " . $cnum;
			if(!$db_conn){
				echo "<p>This doesn't work</p>";
				$e2 = oci_error();
				trigger_error(htmlentities($e2['message'], ENT_QUOTES), E_USER_ERROR);
			}
			else{
				$parsed2 = oci_parse($db_conn, $query2);
				if (!$parsed2){
					$e2 = OCIError($db_conn);  
					echo htmlentities($e2['message']); 
					exit;
				}
				
				$r2=OCIExecute($parsed2, OCI_DEFAULT); 
					if (!$r2){
					$e2 = oci_error($parsed2); 
					echo htmlentities($e2['message']);
					exit;
					}

				while($row2 = oci_fetch_array($parsed2, OCI_NUM))
				{
					echo "<option value=". $row2[0] .">" . $row2[1] . "</option>";

				}	
			}
			echo "</select>";
			echo "<input type=\"submit\" value=\"Load Document\"/>";
			echo "</form>";
			echo "</p>";
		}
		



	$docid = $_POST['document'];
	
	if (!empty($docid)){
		
		$query3 = "select document_file from document where document_id = " . $docid;
		$query4 = "select email, comment_time, text from ns_comment where comment_id in (select comment_id from comment_with_doc where document_id = " . $docid . ") order by comment_time";
		
		
		if(!$db_conn){
			echo "<p>This doesn't work</p>";
			$e3 = oci_error();
			trigger_error(htmlentities($e3['message'], ENT_QUOTES), E_USER_ERROR);
		}
		else
		{
			$parsed3 = oci_parse($db_conn, $query3);
			if (!$parsed3){
				$e3 = OCIError($db_conn);  
				echo htmlentities($e3['message']); 
				exit;
			}
			
			$r3=OCIExecute($parsed3, OCI_DEFAULT); 
			if (!$r3){
				$e3 = oci_error($parsed3); 
				echo htmlentities($e3['message']);
				exit;
			}
			while($row3 = oci_fetch_array($parsed3, OCI_NUM))
			{
				echo "<iframe src=\"http://docs.google.com/gview?url=" . $row3[0] . "\" style=\"width:1000px; height:600px;\" frameborder=\"0\"></iframe>";
			}	
			
			$parsed4 = oci_parse($db_conn, $query4);
			if (!$parsed4){
				$e4 = OCIError($db_conn);  
				echo htmlentities($e4['message']); 
				exit;
			}
			
			$r4=OCIExecute($parsed4, OCI_DEFAULT); 
			if (!$r4){
				$e4 = oci_error($parsed4); 
				echo htmlentities($e4['message']);
				exit;
			}
			echo "<h3>Comments!</h3>";
			while($row4 = oci_fetch_array($parsed4, OCI_NUM))
			{				 
				echo "<br>" . $row4[0] . " - " . $row4[2] . "</br>";
			}	
		
		
			echo "<form method = \"POST\" action = \"document.php\">";
			echo "<textarea name=\"comment\" cols=\"80\">Insert document comments here...</textarea>";
			echo "<input name= \"submit\" type = \"submit\" value = \"Post Comment\"/>";
			echo "</form>";
		}
		/*
		$comm_submit = $_POST['submit'];
			if($comm_submit){
			$doc_comment = $_POST['comment'];
			echo "<p>"$doc_comment"</p>";
			}
			*/
	}
	
	
			
	/*if (!empty($docid)){
		$doc_comment = $_POST['comment'];
		if (!empty($doc_comment)){
			echo "<p>"$doc_comment"</p>";
		}
	}
	*/
	/*
	if (!empty($doc_comment){
		$query5 = "insert into ns_comment values(to_date(\"1999/12/12:12:12:12\"), 'yyyy/mm/dd:hh:mi:ss'), $doc_comment, to_date(\"1999/12/12:12:12:12\"), 'userguy@gmail.com', $cnum, 'CPSC', 'UBC', 'W2','2012');"
		$query6 = "insert into comment_with_doc values(to_date(\"1999/12/12:12:12:12\")," .  $docid);
		
		if(!$db_conn){
			echo "<p>This doesn't work</p>";
			$e5 = oci_error();
			trigger_error(htmlentities($e5['message'], ENT_QUOTES), E_USER_ERROR);
		}
		else{
			$parsed5 = oci_parse($db_conn, $query5);
			$parsed6 = oci_parse($db_conn, $query6);
			if (!$parsed5 && !$parsed6){
				$e5 = OCIError($db_conn);  
				echo htmlentities($e5['message']); 
				exit;
			}
			
			$r5=OCIExecute($parsed5, OCI_DEFAULT); 
			$r6=OCIExecute($parsed6, OCI_DEFAULT); 
			if (!$r5 && !$r6){
				$e5 = oci_error($parsed5); 
				echo htmlentities($e5['message']);
				exit;
			}

		}
	}
	*/


	
	
	?>
	
	
	
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
