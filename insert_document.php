<?php
session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    echo "connected to database<br/>";

    $email = $_SESSION['email'];
    $course = $_SESSION[('course' . (string)$_POST['courseSelect'])];
    $docURL = $_POST['docURL'];
    $docName = $_POST['docname'];
    $docId = 1;
    $time = strtotime("now");
    echo($time) . "</br>";
    
    //find largest document id
    $cmdstr = "select max(document_id) from document";
    
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
    $docId += $row[0];
   }
   

   //insert document
   $cmdstr = "insert into document ($docId, '$docName', CURRENT_TIMESTAMP,'$docURL', '$course[0]', '$course[2]', $course[3]', '$course[4]',  $course[5], '$email')";

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
  OCICommit($db_conn);
  echo("insert worked");
  
  /**
  
  $cmdstr = "select username, email from noteshare_user where email = '$_POST[email]' and password = '$password'";
   
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
   
   $row = OCI_Fetch_Array($parsed, OCI_NUM);
   if (empty($row)) {
    echo "error retrieving account information";
   }
   else {
    OCILogoff($db_conn);
    
    $_SESSION['username'] = $row[0];
    $_SESSION['email'] = $row[1];
    
    if(isset($_SESSION['email'])){
         header('Location: noteshare.php');   
    }
    else {
    header("location:login.php");
    }
   }
  OCILogoff($db_conn);
  header('Location: noteshare.php'); **/
}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>