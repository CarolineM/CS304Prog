<?php include("header.php"); ?>
	<div class="container">
		<h1>Course view</h1>
		          <form method="POST" action="getdocsandcomments.php">
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
        $_SESSION['courseselect' . (string)$i] = $row;
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
      <p>Insert course comments here:</p>         
      <p><textarea name="comment" cols="100"></textarea></p> 
      <p><input class="btn-large" type="submit" value="submit" name="insertsubmit"></p>
      </form>
                <?php
                if (isset($_SESSION['gd_error'])) {
                  echo $_SESSION['gd_error'];
                  unset($_SESSION['gd_error']);
                }
                ?> 
		
		<h3>Documents</h3>
                <?php
              echo "<table width=\"100%\" border=\"1\">";
              echo "<tr>
                  <th>Document Id</th>
                  <th>Name</th>
                  <th>Poster</th>
                  <th>TimeStamp</th>
                  </tr>";
              $i = 0;
            while (isset($_SESSION['document_res' . (string) $i])) {
                $row = $_SESSION['document_res' . (string) $i];
            echo "<tr>
                <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
                </tr>";
                unset($_SESSION['document_res' . (string) $i]);
                $i++;
    }
    echo "</table>";
                ?>
		
		<h3>Comments</h3>
              <?php
              echo "<table width=\"100%\" border=\"1\">";
              echo "<tr>
                  <th>Comment Id</th>
                  <th>Text</th>
                  <th>Poster</th>
                  <th>TimeStamp</th>
                  </tr>";
              $i = 0;
            while (isset($_SESSION['comment_res' . (string) $i])) {
                $row = $_SESSION['comment_res' . (string) $i];
            echo "<tr>
                <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
                <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
                </tr>";
                unset($_SESSION['comment_res' . (string) $i]);
                $i++;
    }
    echo "</table>";
                ?>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
