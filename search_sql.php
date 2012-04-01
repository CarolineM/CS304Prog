<?php
$cname=$_POST['cname'];
$cnumb=$_POST['cnumb'];
$cdept=$_POST['cdept'];
$cinst=$_POST['cinst'];
$cterm=$_POST['cterm'];
$cyear=$_POST['cyear'];
$cdocs=$_POST['cdocs'];
$db_conn = OCILogon("ora_n2f7", "a46785093", "ug");

//check variables valid

//connect to database
if ($db_conn)
{
	//queries
	if ($cdocs == 1)
		{
		//join query course_is_in and documents
		}
		ELSE
		{
			//query course_is_in
			$query = "SELECT * FROM course_is_in WHERE
				course_num='$cnumb' AND
				course_name='$cname' AND
				dept='$cdept' AND
				institution='$cinst' AND
				semester='$cterm' AND
				tyear = '$cyear';"
			$num = mysql_numrows($results);
			$i = 0;
			while ($i < $num)
			{
				
				$i++;
			}		
	}
}
?>