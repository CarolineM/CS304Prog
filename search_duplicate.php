<?php include("header.php"); ?>
<div class="container">
<?php
//search results page
//aggregate nested query
$db_conn = OCILogon("ora_p1t7", "a36959104", "ug");
$selectquery = "select count(*), username from noteshare_user ns where 1 < (select count(*) from noteshare_user ns2 where ns.username = ns2.username) group by username";
$parse = OCIParse($db_conn, $selectquery);
echo "Your query: " . $selectquery . "<br>";

if (!$parse) {
	echo "<br>Cannot parse the following command: " . $selectquery . "<br>";
	$e = OCI_Error($db_conn); // For OCIParse errors pass the       
	// connection handle
	echo htmlentities($e['message']);
} else {
//execute query
	$r = OCIExecute($parse, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute the following command: " . $selectquery . "<br>";
		$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
		echo htmlentities($e['message']);
	} else {
//return query
		echo "<h3>Results</h3>";
		echo "<table width=\"100%\" border=\"1\">";
		echo "<tr>
				<th>Count</th>
				<th>User Name</th>
			</tr>";
		while($row = oci_fetch_array($parse, OCI_NUM)) {
			echo "<tr>
					  <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
					  <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
					</tr>";
		}
		echo "</table>";
	}
}
?>
</div>
<?php include("footer.php"); ?>
