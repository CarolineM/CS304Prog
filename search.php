<?php include("header.php"); ?>

	<div class="container">

		<h1>Search view</h1>
		<p>You do not need to fill out all blanks.</p>
		<form action="search_sql.php" method="post">
		<table>
		<tbody>
		<tr>
			<td>Course Name:</td>
			<td>
			<input type="text" name="cname"></td>
		</tr>
		<tr>
			<td>Course Number:</td>
			<td>
			<input type="number" name="cnumb"></td>
		</tr>
		<tr>
			<td>Course Department:</td>
			<td>
			<input type="text" name="cdept"></td>
		</tr>
		<tr>
			<td>Institution:</td>
			<td>
			<input type="text" name="cinst"></td>
		</tr>
		<tr>
			<td>Term:</td>
			<td>
			<input type="text" name="cterm"></td>
		</tr>
		<tr>
			<td>Year:</td>
			<td>
			<input type="number" name="cyear"></td>
		</tr>
		<tr>
			<td>Other:</td>
			<td>
			<input type="checkbox" value="1" name="cdocs"><label>Show # of documents.</label>
			</td>
		</tr>
		<tr>
			<td>
			<input name="csearchsubmit" type="submit" value="Search" /></td>
		</tbody>
		</table>
		</form>
		
		<h2>Find duplicate usernames</h2>
		<p>A nested-aggregate query.</p>
		<form action="search_duplicate.php" method="post">
		<input name="dupsearchsubmit" type="submit" value="Search" />
		</form>
	</div> <!-- /container -->

<?php include("footer.php"); ?>
