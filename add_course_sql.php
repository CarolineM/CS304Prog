<?php
//inserts courses into the database
 session_start();
$cname=$_POST['cname'];
$cnumb=$_POST['cnumb'];
$cdept=$_POST['cdept'];
$cinst=$_POST['cinst'];
$cterm=$_POST['cterm'];
$cyear=$_POST['cyear'];

   if (is_numeric($cname)) {
        $cname = strval($cname);
   }
      if (is_numeric($cdept)) {
        $cdept = strval($cdept);
   }
      if (is_numeric($cinst)) {
        $cinst = strval($cinst);
   }
      if (is_numeric($cterm)) {
        $cterm = strval($cterm);
   }
      if (is_numeric($cyear)) {
        $cyear = strval($cyear);
   }
   
   if (strlen($cnumb) >= 4) {
	$_SESSION['insert_course_err'] = "Course number must have 3 digits or less";
	header('Location:add_course.php');
	exit;
   }
      if (strlen($cterm) >= 5) {
	$_SESSION['insert_course_err'] = "Term must have 4 digits or less";
	header('Location:add_course.php');
	exit;
      }
      
        if (strlen($cyear) >= 5) {
	$_SESSION['insert_course_err'] = "Year must have 4 digits or less";
	header('Location:add_course.php');
	exit;
      }
      
        if (strlen($cdept) >= 5) {
	$_SESSION['insert_course_err'] = "Department must have 4 digits or less";
	header('Location:add_course.php');
	exit;
      }

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_p1t7", "a36959104", "ug");

	if ($db_conn)
	{
		$queryterm = "INSERT INTO term VALUES ('$cterm','$cyear')";
		$querycourseisin = "INSERT INTO course_is_in VALUES ($cnumb,'$cname','$cdept','$cinst','$cterm','$cyear')";
		$parse1 = OCIParse($db_conn,$queryterm);
		$parse2= OCIParse($db_conn,$querycourseisin);
	
		if (!$parse1) {
			echo "<br>Cannot parse the following command: " . $queryterm . "<br>";
			$e = OCI_Error($db_conn); // For OCIParse errors pass the       
			// connection handle
			$_SESSION['insert_course_err'] = htmlentities($e['message']);
			$success = False;
		}
		if (!$parse2) {
			echo "<br>Cannot parse the following command: " . $querycourseisin . "<br>";
			$e = OCI_Error($db_conn); // For OCIParse errors pass the       
			// connection handle
			$_SESSION['insert_course_err'] = htmlentities($e['message']);
			$success = False;
		}

		$r1 = OCIExecute($parse1, OCI_DEFAULT);
		$r2 = OCIExecute($parse2, OCI_DEFAULT);
		if (!$r1) {
			echo "<br>Cannot execute the following command: " . $queryterm . "<br>";
			$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
			$_SESSION['insert_course_err'] =  htmlentities($e['message']);
			$success = False;
		} 
		if (!$r2) {
			echo "<br>Cannot execute the following command: " . $querycourseisin . "<br>";
			$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
			$_SESSION['insert_course_err'] = htmlentities($e['message']);
			$success = False;
		}
		if ($success == True) {
			OCICommit($db_conn);
			$_SESSION['insert_course_err'] = "<br>Success!<br>";
			echo "<br>The following commands were committed: " . $queryterm . " and<br>" . $querycourseisin . "<br>";
		} else {
			$_SESSION['insert_course_err'] = "<br>ERROR! NO NULLS<br>";
		}
		OCILogoff($db_conn);
		header('Location:add_course.php');
		
	} else {
		echo "cannot connect";
		$e = OCI_Error(); // For OCILogon errors pass no handle
		echo htmlentities($e['message']);
	}
?>