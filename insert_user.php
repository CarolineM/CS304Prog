<?php
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    echo "connected to database<br/>";

   //import_request_variables('p', 'p_');
   
   $cmdstr = "insert into noteshare_user(username, email, isprofessor, password) values ('$_POST[username]', '$_POST[email]',  '$_POST[isprofessor]', '$_POST[password]')"; 

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
  OCILogoff($db_conn);
  header('Location: noteshare.php');

}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}

?>