
<?php include("nolinkheader.php"); ?>
    <div class="container">
      <div class="center">
      <h1>Sign In</h1>
      <hr/>
      <form method="POST" action="user_verification.php">
         <p><h3>Email</h3><input type="text" name="email" size="6"/></p>
         <p><h3>Password</h3><input type="password" name="password" size="18"/></p>
         <p><input class="btn-large" type="submit" value="submit" name="insertsubmit"></p>
      </form>
      <button class="btn-large" type="submit" onclick="location.href ='signup.php';"> Need An Account?</button>
      </div>
    </div> <!-- /container -->

<?php include("footer.php"); ?>
