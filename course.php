<?php include("header.php"); ?>
	<div class="container">
		<?php
			$cnum="304";
			$cdept="CS";
			$cinst="UBC";
			$cterm="W2";
			$cyear="2012";
		?>
		<h1>Course view</h1>
		<p>This page should be access by querying a specific course. Show comments and make comments on this page. Links to documents.</p>
		<h2><?php print($cdept); print($cnum); echo", "; print($cinst); echo", "; print($cterm); echo", "; print($cyear);?></h2>
		
		<h3>Documents</h3>
		<table>
		<tbody>
			<tr>
				<td>link to document1</td>
				<td>(2 comments)</td>
				<td>Last comment posted March 9, 2012 10:11
			</tr>
			<tr>
				<td>link to document2</td>
				<td>(0 comments)</td>
			</tr>
		</tbody>
		</table>
		
		<h3>Comments</h3>
			<textarea name="comment" cols="80">Insert document comments here...</textarea> </br>
			<input id="subbit" type="button" value="Submit Comment"/>
		<br>haxorGuy - March 1, 2012 8:22 - I love this course!</br>
		<br>haxorGirl - March 2, 2012 8:35 - What's a database?</br>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
