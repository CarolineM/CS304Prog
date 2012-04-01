<?php include("header.php"); ?>
	<div class="container">
		<h1>Course view</h1>
		          <form method="POST" action="insert_document.php">
	  <label for="courseSelect">Select a course:</label>
		<select name="courseSelect">
<?php
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){

   $cmdstr = "select * from course_is_in";
   
   $parsed = OCIParse($db_conn, $cmdstr);
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
  $i = 0;
  while($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
        echo "<option value=" . $i . ">" . $row[3] . " " . $row[0] . " " . $row[1] . "</option>";
        $_SESSION['course' . (string)$i] = $row;
        $i++;
  }
       OCILogoff($db_conn);
}        
  else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>
  </select>
      </form>
		
		<h3>Documents</h3>
		<table>
		<tbody>
			<tr>
				<td>link to document1</td>
				<td>(2 comments)</td>
				<td>Last comment posted March 9, 2012 10:11
			</tr>
			<tr>
				<td>link to document2</td>
				<td>(0 comments)</td>
			</tr>
		</tbody>
		</table>
		
		<h3>Comments</h3>
			<textarea name="comment" cols="80">Insert document comments here...</textarea> </br>
			<input id="subbit" type="button" value="Submit Comment"/>
		<br>haxorGuy - March 1, 2012 8:22 - I love this course!</br>
		<br>haxorGirl - March 2, 2012 8:35 - What's a database?</br>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
