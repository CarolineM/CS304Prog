
<?php include("header.php"); ?>


    <div class="container">

      <h1>User Information</h1>
      <p>All user specific information and queries</p>
      <?php
      
      if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){

        //user documents query
        $email = $_SESSION['email'];
        $cmdstr = "select document_id, institution, dept, course_num, document_time from document where email= '$email'";
   
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
   
   //first document fetch
      $areDocuments = TRUE;
      $row = OCI_Fetch_Array($parsed, OCI_NUM);
      if (empty($row)) {
       $_SESSION['doc0'] = "No documents posted.";
       $areDocuments = FALSE;
   }
   else {
    //echo document table
    echo '<h3>Your Documents</h3>';
    echo "<table width=\"100%\" border=\"1\">";
    echo "<tr>
        <th>Document Id</th>
        <th>Name</th>
        <th>Institution</th>
        <th>Department</th>
        <th>Course Number</th>
        <th>TimeStamp</th>
        <tr>";
        
    echo "<tr>
          <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
          <td bgcolor=\"#COCOCO\">" . "PLACEHOLDER" . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[4] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[5] . "</td>
        </tr>";
    while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
    echo "<tr>
          <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
          <td bgcolor=\"#COCOCO\">" . "PLACEHOLDER" . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[4] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[5] . "</td>
        </tr>";
    }
    echo "</table>";
   }
           //user comments
        if ($areDocuments) {
          $cmdstr = "select comment_id, comment_time, text from ns_comment where ns_comment.email = '$email'";
   
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
   
    //echo couse table
       echo '<br/>';
       echo '<h3>Courses You Have Added Content To</h3>';
       echo "<table width=\"100%\" border=\"1\">";
       echo "<tr>
           <th>Course Number</th>
           <th>Name</th>
           <tr>";
       while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
       echo "<tr>
            <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
            <td bgcolor=\"#COCOCO\">" . "PLACEHOLDER" . "</td>
          </tr>";
      }
      echo "</table>";
   }
   
        //user course query interation query (two JOINs with union)
        if ($areDocuments) {
          $cmdstr = "select course_is_in.course_num from course_is_in, document where document.email = '$email' and course_is_in.course_num = document.course_num union select course_is_in.course_num from course_is_in, ns_comment where ns_comment.email = '$email' and course_is_in.course_num = ns_comment.course_num";
   
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
   
    //echo couse table
       echo '<br/>';
       echo '<h3>Courses You Have Added Content To</h3>';
       echo "<table width=\"100%\" border=\"1\">";
       echo "<tr>
           <th>Course Number</th>
           <th>Name</th>
           <tr>";
       while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
       echo "<tr>
            <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
            <td bgcolor=\"#COCOCO\">" . "PLACEHOLDER" . "</td>
          </tr>";
      }
      echo "</table>";
   }

   
   //logoff
    OCILogoff($db_conn);
  }
  //error condition
  else {
    $e = OCIError();  
    echo htmlentities($e['message']);
   }

?>


    </div> <!-- /container -->

<?php include("footer.php"); ?>
