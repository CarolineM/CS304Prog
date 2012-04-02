<?php
//returns docs and comments connected to a course
session_start();
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    
    $email = $_SESSION['email'];
    $course = $_SESSION[('courseselect' . (string)$_POST['courseSelect'])];
    
        //insert any comments 
    if (!empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    $commentId = 1;
    $email = $_SESSION['email'];
    
    //find largest comment id
    $cmdstr = "select max(comment_id) from ns_comment";
    
    $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   }
   
    $row = OCI_Fetch_Array($parsed, OCI_NUM);
    if (empty($row)) {
      $_SESSION['gd_error'] = "Internal server error";
      OCILogoff($db_conn);
      header('Location:noteshare.php');
   }
   else {
    $commentId += $row[0];
   }
    
    $cmdstr = "insert into ns_comment values(default, '$comment', $commentId, '$email', '$course[0]', '$course[2]', '$course[3]', '$course[4]', $course[5])";

   $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   } 
  OCICommit($db_conn);
    
}
    

$cmdstr = "select document_id,  document_name, document_time, email from document where institution = '$course[3]' and dept = '$course[2]' and course_num  = $course[0] and tyear = $course[5]";

   $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   } 
  OCICommit($db_conn);
  echo("select worked");
    
    $i = 0;  
    while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
        $_SESSION['document_res' . (string)$i] = $row;
        $i++;
    }
    
    $cmdstr = "select comment_id,  text, comment_time, email from ns_comment where institution = '$course[3]' and dept = '$course[2]' and course_num  = $course[0] and tyear = $course[5]";

   $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      $_SESSION['gd_error'] = htmlentities($e['message']);
      header('Location:noteshare.php');
      exit;
   } 
  OCICommit($db_conn);
  echo("select worked");
    
    $i = 0;  
    while ($row = OCI_Fetch_Array($parsed, OCI_NUM)) {
        $_SESSION['comment_res' . (string)$i] = $row;
        $i++;
    }
    
    header('Location:noteshare.php');
    
    


}else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}
    
    
?>