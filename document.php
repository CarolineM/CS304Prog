<?php
	include("header.php");
	$db_conn = OCILogon("ora_p1t7", "a36959104", "ug");
	if(!empty($_POST['doc_id'])){
	$_SESSION['doc_id'] = $_POST['doc_id'];
	}
	if(!empty($_POST['courseinfo'])){
		$course_array = explode (",", $_POST['courseinfo']);
		$_SESSION['cnum'] = $course_array[0];
		$_SESSION['cdept'] = $course_array[1];
		$_SESSION['csem'] = $course_array[2];
		$_SESSION['cyear'] = $course_array[3];
		$_SESSION['cinst'] = $course_array[4];
	}
	if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	}
	$comm_id = 1;
?>


	<div class="container">

	<h1>Document page</h1>
	
	<p>Select a Course<br>
		<form method = "POST" action = "document.php">
		<select name="courseinfo">
		<?php
			$query = "select course_num, dept, semester, tyear, institution from course_is_in";
		if(!$db_conn){
			echo "<p>This doesn't work</p>";
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
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
				echo "<option value=" . $row[0] . ","  . $row[1] . ","  . $row[2] . ","  . $row[3] . ","  . $row[4] . "," .">" . $row[4] . " - " . $row[3] . " - " . $row[2] . " - " . $row[1] . " " . $row[0] . "</option>";
			}
		}
		
		
		echo "</select>";
		echo "<input type = \"submit\" value = \"Filter Documents\"/>";
		echo "</form>";
		echo "</p>";

		if(isset($_SESSION['cnum'])){
			$cnum = $_SESSION['cnum'];
			$cdept = $_SESSION['cdept'];
			$csem = $_SESSION['csem'];
			$cinst = $_SESSION['cinst'];
			$cyear = $_SESSION['cyear'];
			echo "<form method = \"POST\" action=\"document.php\">";	
			echo "Select a Document<br>";
			echo "<select name=\"doc_id\">";
				$query2 = "select document_id, document_name from document where course_num = '" . $cnum . "' and dept = '" . $cdept . "' and semester = '" . $csem . "' and tyear = '" . $cyear . "' and institution = '" . $cinst . "'";
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
		

	if (isset($_SESSION['doc_id'])){
		$docid = $_SESSION['doc_id'];
		
		$query3 = "select document_file from document where document_id = " . $docid;
		$query4 = "select email, comment_time, text from ns_comment where comment_id in (select comment_id from comment_with_doc where document_id = " . $docid . ") order by comment_time asc";
		
		
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
			echo "<br />";
			echo "<br />";
			echo "<h3>Comments!</h3>";
			echo "<br />";
			echo "<form method = \"POST\" action = \"document.php\">";
			echo "<textarea name=\"comment\" cols=\"80\"></textarea>";
			echo "<input name= \"submit\" type = \"submit\" value = \"Post Comment\"/>";
			echo "</form>";
			
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

			while($row4 = oci_fetch_array($parsed4, OCI_NUM))
			{				 
				echo "<br>" . $row4[0] . " commented at: " . $row4[1] . " - " . $row4[2] . "</br>";
			}	

			
			if (!empty($_POST['comment'])){
			   //find largest comment id
				$cmdstr = "select max(comment_id) from ns_comment";
				
				$parsed = OCIParse($db_conn, $cmdstr); // parse the statement
			   if (!$parsed){
				  $e = OCIError($db_conn);  
				  echo htmlentities($e['message']);
				  echo "exiting...";
				  exit;
			   }

			   $r=OCIExecute($parsed, OCI_DEFAULT); 
				if (!$r){
				  $e = oci_error($parsed); 
				  echo htmlentities($e['message']);
				  echo "exiting...";
				  exit;
			   }
			   
				$row = OCI_Fetch_Array($parsed, OCI_NUM);
				if (empty($row)) {
				  $_SESSION['insert_document_result'] = "Internal server error";
				  OCILogoff($db_conn);
				  header('Location: noteshare.php');
			   }
			   else {
				$comm_id += $row[0];

			   }
				$doc_comment = $_POST['comment'];
				$query5 = "insert into ns_comment values (default, '$doc_comment', '$comm_id', '$email', '$cnum', '$cdept', '$cinst', '$csem', '$cyear')";
				$query6 = "insert into comment_with_doc values ('" . $comm_id . "', '" . $_SESSION['doc_id'] . "')";
				echo "<br />";
				echo "<p>$email commented just now"; 
				echo " - $doc_comment</p>";
				

				if(!$db_conn){
					echo "<p>This doesn't work</p>";
					$e5 = oci_error();
					trigger_error(htmlentities($e5['message'], ENT_QUOTES), E_USER_ERROR);
				}
				else{
					$parsed5 = oci_parse($db_conn, $query5);
					
					if (!$parsed5){
						$e5 = OCIError($db_conn);  
						echo htmlentities($e5['message']); 
						exit;
					}
				
					$r5=OCIExecute($parsed5, OCI_DEFAULT); 
					if (!$r5){
						$e5 = oci_error($parsed5); 
						echo htmlentities($e5['message']);
						exit;
					}
						$parsed6 = oci_parse($db_conn, $query6);
					if (!$parsed6){
						$e6 = OCIError($db_conn);  
						echo htmlentities($e6['message']); 
						exit;
					}
					$r6=OCIExecute($parsed6, OCI_DEFAULT); 
					if (!$r6){
						$e6 = oci_error($parsed6); 
						echo htmlentities($e6['message']);
						exit;
					}
					OCICommit($db_conn);

				}
							
			}
		}

	}

	?>
	  

    </div> <!-- /container -->
	

<?php include("footer.php"); ?>
