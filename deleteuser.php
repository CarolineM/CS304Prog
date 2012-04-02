<?php
//deletes user from database and the logs them out
    session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){
    
    $email = $_SESSION['email'];

   $cmdstr = "delete from noteshare_user where email = '$email'";
   
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
    
    OCICommit($db_conn);
   $cmdstr = "select * from noteshare_user where email = '$email'";
    
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
    if (!empty($row)) {
    echo "delete didn't work";
   }

   else {
    OCILogoff($db_conn);
    header("location:logout.php");
    }



}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>