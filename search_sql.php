<?php
$cname=$_POST['cname'];
$cnumb=$_POST['cnumb'];
$cdept=$_POST['cdept'];
$cinst=$_POST['cinst'];
$cterm=$_POST['cterm'];
$cyear=$_POST['cyear'];
$cdocs=$_POST['cdocs'];

//check variables valid

//connect to database

//queries
if ($cdocs == 1)
	{
	//join query course_is_in and documents
	}
	ELSE
	{
		//query course_is_in
		$query = "SELECT * FROM course_is_in WHERE
			course_num="$cnumb",
			course_name="$cname",
			dept="$cdept",
			institution="$cinst",
			semester="$cterm",
			tyear = "$cyear""
		// $result = mysql_query($query);
		//print results
		$num = mysql_numrows($results);
		$i = 0;
		while ($i < $num)
		{
			
			$i++;
		}		
}

?>