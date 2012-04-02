
<?php include("header.php"); ?>


    <div class="container">

      <h1>User Information</h1>
      <hr/>
      <?php
      
      if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){

        //user documents query
        $email = $_SESSION['email'];
        $cmdstr = "select document_id,  document_name, institution, dept, course_num, document_time from document where email= '$email'";
   
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
        <th>Delete?</th>
        <tr>";
    if (!empty($row)) {    
    echo "<tr>
          <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[4] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[5] . "</td>
           <td bgcolor=\"#COCOCO\"> <form name='delete_form' action='deletedoc.php' method='POST'>
          <input type='hidden' name='dotodelete' value='$row[0]'>
         <button class=\"btn-small\" type=\"submit\">Delete</button><form></td>
        </tr>";
    while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
    echo "<tr>
          <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[4] . "</td>
          <td bgcolor=\"#COCOCO\">" . $row[5] . "</td>
          <td bgcolor=\"#COCOCO\"> <form name='delete_form' action='deletedoc.php' method='POST'>
          <input type='hidden' name='dotodelete' value='$row[0]'>
         <button class=\"btn-small\" type=\"submit\">Delete</button><form></td>
        </tr>";
    }
    }
    echo "</table>";
     if (isset($_SESSION["deldocres"] )) {
        echo  $_SESSION["deldocres"];
        unset( $_SESSION["deldocres"] );
     }
   
          //user comments
          $cmdstr = "select comment_id, text, comment_time from ns_comment where email = '$email'";
   
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
       echo '<h3>Your Comments</h3>';
       echo "<table width=\"100%\" border=\"1\">";
       echo "<tr>
           <th>ID</th>
           <th>Text</th>
           <th>Time</th>
           <th>Delete?</th>
           <tr>";
       while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
       echo "<tr>
            <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
            <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
            <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
            <td bgcolor=\"#COCOCO\"> <form name='delete_form' action='deletecomment.php' method='POST'>
          <input type='hidden' name='comtodelete' value='$row[0]'>
         <button class=\"btn-small\" type=\"submit\">Delete</button><form></td>
        </tr>";
      }
      echo "</table>";
   }

       
        if ($areDocuments || $areComments) {
                  
           //user course query interation query (two JOINs with union)
          $cmdstr = "select course_is_in.course_num, course_is_in.course_name from course_is_in, document where document.email = '$email' and course_is_in.course_num = document.course_num union select course_is_in.course_num, course_is_in.course_name from course_is_in, ns_comment where ns_comment.email = '$email' and course_is_in.course_num = ns_comment.course_num";
   
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
            <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
          </tr>";
      }
      echo "</table>";

   //logoff
    OCILogoff($db_conn);
  }
  //error on connection
  else {
    $e = OCIError();  
    echo htmlentities($e['message']);
   }

?>
<hr/>
<h1>Change Password</h1>
    <form method="POST" action="change_password.php">
         <p><h3>Old Password</h3><input type="password" name="old_password" size="18"/></p>
         <p><h3>New Password</h3><input type="password" name="new_password" size="18"/></p>
         <p><input class="btn-large" type="submit" value="submit" name="insertsubmit"></p>
           <?php
  if (isset($_SESSION['pw_change_result'])) {
    echo "<b>" . $_SESSION['pw_change_result'] . "</b>";
    unset($_SESSION['pw_change_result']);
  }
  ?>
    </form>
  <button class="btn-large" type="submit" onclick="location.href ='deleteuser.php';">Delete Your Account :(</button></br>
  



    </div> <!-- /container -->

<?php include("footer.php"); ?>
