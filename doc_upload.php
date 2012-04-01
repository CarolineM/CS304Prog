
<?php include("header.php"); ?>
<div class="container">
      <h1>Link a document</h1>
      <p>We do not host documents locally. Please input the URL of the document you wish to display.</p>
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
	<br />
	<label for="docURL">Input the document URL:</label>
	<input type="text" name="docURL"></input>
        <label for="docname">Input the document Name:</label>
	<input type="text" name="docname"></input>
	<br />
	<input class="btn-large" type="submit" value="submit" name="insertsubmit"/>
      </form>
	<?php
        if(isset($_SESSION['insert_document_result'])) {
          echo($_SESSION['insert_document_result'] );
        }
        
        ?>

    </div> <!-- /container -->

<?php include("footer.php"); ?>