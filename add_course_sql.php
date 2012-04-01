<?php
$cname=$_POST['cname'];
$cnumb=$_POST['cnumb'];
$cdept=$_POST['cdept'];
$cinst=$_POST['cinst'];
$cterm=$_POST['cterm'];
$cyear=$_POST['cyear'];
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_n2f7", "a46785093", "ug");

	if ($db_conn)
	{
		$queryterm = "INSERT INTO term VALUES ('$cterm','$cyear')";
		$querycourseisin = "INSERT INTO course_is_in VALUES ('$cnumb','$cname','$cdept','$cinst','$cterm','$cyear')";
		$parse1 = OCIParse($db_conn,$queryterm);
		$parse2= OCIParse($db_conn,$querycourseisin);
	
		if (!$parse1) {
			echo "<br>Cannot parse the following command: " . $queryterm . "<br>";
			$e = OCI_Error($db_conn); // For OCIParse errors pass the       
			// connection handle
			echo htmlentities($e['message']);
			$success = False;
		}
		if (!$parse2) {
			echo "<br>Cannot parse the following command: " . $querycourseisin . "<br>";
			$e = OCI_Error($db_conn); // For OCIParse errors pass the       
			// connection handle
			echo htmlentities($e['message']);
			$success = False;
		}

		$r1 = OCIExecute($parse1, OCI_DEFAULT);
		$r2 = OCIExecute($parse2, OCI_DEFAULT);
		if (!$r1) {
			echo "<br>Cannot execute the following command: " . $queryterm . "<br>";
			$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		} 
		if (!$r2) {
			echo "<br>Cannot execute the following command: " . $querycourseisin . "<br>";
			$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		}
		if ($success == True) {
			OCICommit($db_conn);
			echo "<br>Success!<br>";
			echo "<br>The following commands were committed: " . $queryterm . " and<br>" . $querycourseisin . "<br>";
		} else {
			echo "<br>No commands were committed.<br>";
		}
		OCILogoff($db_conn);
	}
?>