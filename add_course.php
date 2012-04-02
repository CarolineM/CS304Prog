<?php include("header.php"); ?>
        
        <div class="container">
		<h1>Add a course to the Database</h1>
		<form action="add_course_sql.php" method="post">
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
			<td>
			<input name="addsubmit" type="submit" value="Add Course" /></td>
		</tbody>
		</table>
		</form>
                <?php
                if (isset($_SESSION['insert_course_err'])) {
                echo $_SESSION['insert_course_err'];
                unset($_SESSION['insert_course_err'] );
                }
                ?>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
