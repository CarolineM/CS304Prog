<?php
 session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")){

   $oldpassword = $_POST['old_password'];
   $newpassword = $_POST['new_password'];
   $email = $_SESSION['email'];
   
   if (is_numeric($password)) {
        $password = strval($password);
   }

   $cmdstr = "select username, email from noteshare_user where email = '$email' and password = '$oldpassword'";
   
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
    $_SESSION['pw_change_result'] = "invalid username or password";
   }
   else {
    $cmdstr = "update noteshare_user set password = '$newpassword' where email = '$email'";
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
    $cmdstr = "select username, email from noteshare_user where email = '$email' and password = '$newpassword'";
   
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
    $_SESSION['pw_change_result'] = "fail :(";
   }
    else {
    $_SESSION['pw_change_result'] = "Success!";
    }
    }
    OCILogoff($db_conn); 
    header('Location: settings.php'); 


}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}


?>