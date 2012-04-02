<?php include("header.php"); ?>
<div class="container">
<?php
 session_start();
=======
//search against course
$cname=$_POST['cname'];
$cnumb=$_POST['cnumb'];
$cdept=$_POST['cdept'];
$cinst=$_POST['cinst'];
$cterm=$_POST['cterm'];
$cyear=$_POST['cyear'];
$db_conn = OCILogon("ora_p1t7", "a36959104", "ug");

//check variables valid
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
	header('Location:search.php');
	exit;
   }
      if (strlen($cterm) >= 5) {
	$_SESSION['insert_course_err'] = "Term must have 4 digits or less";
	header('Location:search.php');
	exit;
      }
      
        if (strlen($cyear) >= 5) {
	$_SESSION['insert_course_err'] = "Year must have 4 digits or less";
	header('Location:search.php');
	exit;
      }
      
        if (strlen($cdept) >= 5) {
	$_SESSION['insert_course_err'] = "Department must have 4 digits or less";
	header('Location:search.php');
	exit;
      }

//Build query
$selectquery = "SELECT * FROM course_is_in WHERE";
if (!empty($cnumb)) {
	$selectquery .= " course_num=$cnumb AND";
}
if (!empty($cname)) {
	$selectquery .= " course_name='$cname' AND";
}
if (!empty($cdept)) {
	$selectquery .= " dept='$cdept' AND";
}
if (!empty($cinst)) {
	$selectquery .= " institution='$cinst' AND";
}
if (!empty($cterm)) {
	$selectquery .= " semester='$cterm' AND";
}
if (!empty($cyear)) {
	$selectquery .= " tyear=$cyear";
} else {
	$selectquery = substr($selectquery,0,-4);
}
echo "Your query: " . $selectquery . "<br>";

//connect to database
if ($db_conn)
{
	//queries
	//parse query
	$success = True;
	$parse = OCIParse($db_conn, $selectquery);
	if (!$parse) {
		echo "<br>Cannot parse the following command: " . $selectquery . "<br>";
		$e = OCI_Error($db_conn); // For OCIParse errors pass the       
		// connection handle
		$_SESSION['insert_course_err'] = htmlentities($e['message']);
		$success = False;
	} else {
	//execute query
		$r = OCIExecute($parse, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $selectquery . "<br>";
			$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
			$_SESSION['insert_course_err'] = htmlentities($e['message']);
			$success = False;
		} else {
	//return query
			echo "<h3>Results</h3>";
			echo "<table width=\"100%\" border=\"1\">";
			echo "<tr>
					<th>Course Number</th>
					<th>Course Name</th>
					<th>Department</th>
					<th>Institution</th>
					<th>Semester</th>
					<th>Year</th>
				</tr>";
			while($row = oci_fetch_array($parse, OCI_NUM)) {
				echo "<tr>
						  <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
						  <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
						  <td bgcolor=\"#COCOCO\">" . $row[2] . "</td>
						  <td bgcolor=\"#COCOCO\">" . $row[3] . "</td>
						  <td bgcolor=\"#COCOCO\">" . $row[4] . "</td>
						  <td bgcolor=\"#COCOCO\">" . $row[5] . "</td>
						</tr>";
			}
			echo "</table>";
		}
	}
}
if(!$success) {
	header('Location:search.php');
}

?>
</div>
<?php include("footer.php"); ?>
