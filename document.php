
<?php include("header.php"); ?>

    <div class="container">

      <h1>Document page</h1>
      <p>View a document, make comments, view comments on the document</p>
	  
	  <!-- 
		Showing a pdf with php
		http://googlesystem.blogspot.ca/2009/09/embeddable-google-document-viewer.html
		
		eg. (doc pdf var goes after url=)
		<iframe src="http://docs.google.com/gview?url=http://www.ugrad.cs.ubc.ca/~cs304/2011W2/notes/Chapter1-intro-2up.pdf" style="width:600px; height:500px;" frameborder="0"></iframe>
		
	  -->
	  
	  <!--
		Make Comments Insert
		var $comment = 'need comment function';
		
		var $timestamp = date(DATE_RFC822); example: 2005-08-15T15:52:01+00:00
		date_format($timestamp, 'yyyy/mm/dd:hh:mi:ss'); 
		
		echo date(DATE_ATOM);
		
		
		insert into ns_comment
		values(to_date($timestamp, 'yyyy/mm/dd:hh:mi:ss'), $comment, '222', 'userguy@gmail.com', '304', 'CPSC', 'UBC', 'W2', '2012');
		
	  <--

    </div> <!-- /container -->

<?php include("footer.php"); ?>
