
<?php include("header.php"); ?>

    <div class="container">

      <h1>All comments view</h1>
      <p>The document level and course level comments of a course</p>
	  
	  <!--  Comments on a particular course -->	  
		<!-- 
		select text from ns_comment where course_num= (var for course num here); 
		-->
	 
	  
	  <!-- Comments on a particular document -->
		<!--
		select text from ns_comment where comment_id = (select comment_id from comment_with_doc where document_id = (var for doc id here);
		-->

    </div> <!-- /container -->

<?php include("footer.php"); ?>
