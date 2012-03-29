<?php
session_start();
if ($db_conn=OCILogon("ora_y8r7", "a28438109", "@ug")) {
    echo "connected to database<br/>";

   //import_request_variables('p', 'p_');
   
    $password = $_POST['password'];
   if (is_numeric($password)) {
        $password = strval($password);
   }
   
   $cmdstr = "insert into noteshare_user(username, email, isprofessor, password) values ('$_POST[username]', '$_POST[email]',  '$_POST[isprofessor]', '$password')"; 

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
  header('Location: noteshare.php');

}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>