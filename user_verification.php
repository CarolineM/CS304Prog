<?php
    session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {

   $password = $_POST['password'];
   if (is_numeric($password)) {
        $password = strval($password);
   }

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
    echo "invalid username or password";
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


}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>