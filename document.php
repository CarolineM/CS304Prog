
<?php include("header.php"); ?>



	
	<div class="container">
	
	<?php
	session_start();
	?>

	<h1>Document page</h1>
    <p>View a document, make comments, view comments on the document</p>
	  
	<p>Select a Document<br>
		<select name="Document: ">
		<option value="What" selected>Option 1</option>
		<option value="in">Option 2</option>
		<option value="the">Option 3</option>
		<option value="f">Option 4</option>
		</select>
	</p>
	
	<iframe src="http://docs.google.com/gview?url=http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf" style="width:1000px; height:500px;" frameborder="0"></iframe>
	
	<h3> Comment on the document here (max 500 char)</h3>
	<textarea name="comment">
	</textarea>
	
	<input type="button" onclick="" value="Submit Comment" />
	
	
	  
	  <!-- 
		Showing a pdf with php
		http://googlesystem.blogspot.ca/2009/09/embeddable-google-document-viewer.html
		
		eg. (doc pdf var goes after url=)
		
	 
		Make Comments Insert
		var $comment = 'need comment function';
		
		var $timestamp = date(DATE_RFC822); example: 2005-08-15T15:52:01+00:00
		date_format($timestamp, 'yyyy/mm/dd:hh:mi:ss'); 
		
		echo date(DATE_ATOM);
		
		insert into ns_comment
		values(to_date($timestamp, 'yyyy/mm/dd:hh:mi:ss'), $comment, '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
	  -->

    </div> <!-- /container -->
	

<?php include("footer.php"); ?>
