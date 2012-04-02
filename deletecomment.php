<?php
    session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){
    
    $comment = $_POST['comtodelete'];

   $cmdstr = "delete from ns_comment where comment_id = '$comment'";
   
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION["delcomres"]  = htmlentities($e['message']);
      header("location:settings.php");
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION["delcomres"]  = htmlentities($e['message']);
      header("location:settings.php");
      exit;
   }
    
    OCICommit($db_conn);
   $cmdstr = "select * from ns_comment where comment_id = '$comment'";
    
    $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION["delcomres"]  = htmlentities($e['message']);
      header("location:settings.php");
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION["delcomres"]  = htmlentities($e['message']);
      header("location:settings.php");
      exit;
   }
    
    $row = OCI_Fetch_Array($parsed, OCI_NUM);
    if (!empty($row)) {
    $_SESSION["delcomres"]  =  "delete didn't work";
   }

   else {
    $_SESSION["delcomres"]  =  "Success!";
    }
    
    OCILogoff($db_conn);
    header("location:settings.php");



}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}