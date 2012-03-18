
<?php include("header.php"); ?>

    <div class="container">

      <h1>Sign up or Sign in</h1>
      <p>I think this can be done on the same page?</p>
      <form method="POST" action="oracle-test1.php">
      <!--refresh page when submit-->
        <p><h3>Username</h3><input type="text" name="insNo" size="6"/></p>
        <p><h3>Password</h3><input type="text" name="insName" size="18"/></p>
      <!--define two variables to pass the value-->
        <p><input type="submit" value="submit" name="insertsubmit"></p>
    </form>

    </div> <!-- /container -->

<?php include("footer.php"); ?>
