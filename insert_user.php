<?php
//inserts user into the database
session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    echo "connected to database<br/>";
   
    $password = $_POST['password'];
   if (is_numeric($password)) {
        $password = strval($password);
   }
   
   $cmdstr = "insert into noteshare_user(username, email, isprofessor, password) values ('$_POST[username]', '$_POST[email]',  '$_POST[isprofessor]', '$password')"; 

   $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
       $_SESSION['sign_err']  =  htmlentities($e['message']);
       header("location:signup.php");
       exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
       $_SESSION['sign_err']  =  htmlentities($e['message']);
        header("location:signup.php");
      exit;
   } 
  OCICommit($db_conn);
  
  $cmdstr = "select username, email from noteshare_user where email = '$_POST[email]' and password = '$password'";
   
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
       $_SESSION['sign_err']  =  htmlentities($e['message']);
        header("location:signup.php");
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
       $_SESSION['sign_err']  =  htmlentities($e['message']);
        header("location:signup.php");
      exit;
   }  
   
   $row = OCI_Fetch_Array($parsed, OCI_NUM);
   if (empty($row)) {
    $_SESSION['sign_err']  = "error retrieving account information";
    header("location:signup.php");

   }
   else {
    OCILogoff($db_conn);
    
    $_SESSION['username'] = $row[0];
    $_SESSION['email'] = $row[1];
    
    if(isset($_SESSION['email'])){
         header('Location: noteshare.php');   
    }
    else {
    header("location:signup.php");
    }
   }

}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>