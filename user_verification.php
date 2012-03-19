<?php

if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    echo "connected to database<br/>";

   $password = $_POST['password'];
   if (is_numeric($password)) {
        $password = strval($password);
   }

   $cmdstr = "select username from noteshare_user where email = '$_POST[email]' and password = '$password'";
   echo $cmdstr . PHP_EOL;
   
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
    echo "hello " . $row[0];
    OCILogoff($db_conn);
    header('Location: noteshare.php');
   }


}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>