
<?php include("header.php"); ?>

    <div class="container">
      <div class="center">
      <h1>Sign In</h1>
      <hr/>
      <form method="POST" action="oracle-test1.php">
              <!--refresh page when submit-->
         <p><h3>Username</h3><input type="text" name="insNo" size="6"/></p>
         <p><h3>Password</h3><input type="text" name="insName" size="18"/></p>
              <!--define two variables to pass the value-->
          <p><input type="submit" value="submit" name="insertsubmit"></p>
      </form>
      <button class="btn-large" type="submit" onclick="location.href ='signup.php';"> Need An Account?</button>
      </div>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
