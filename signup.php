
<?php include("nolinkheader.php"); ?>

    <div class="container">
            <h1>Sign Up</h1>
            <hr/>
            <form method="POST" action="insert_user.php">
              <!--refresh page when submit-->
              <p><h3>Username</h3><input type="text" name="username" size="40"/></p>
              <p><h3>Email</h3><input type="text" name="email" size="40"/></p>
              <p><h3>Password</h3><input type="password" name="password" size="12"/></p>
              <h3>Are you a professor?</h3>
              <table>
                <tr>
                    <td>
                        <input type="radio" name="isprofessor" value="Y" style="margin-right:5px;"/><b>   Yes   </b>
                    </td>
                    <td>
                        <input type="radio" name="isprofessor" value="N" style="margin:5px;" checked="true;"/><b>   No</b>
                    </td>    
                </tr>    
              </table>
              <table>
                <tr>
                    <td>
                            <input class="btn-large" type="submit" value="submit" name="insertuser" style="margin-right:30px;"/>
                </form>
                    </td>
                    <td>
                        <br/>
                        <form method="POST" action="login.php">
                        <input class="btn-large" type="submit" value="cancel" name="cancelnewacct" style="margin-left:30px;"/>
                        </form>
                    </td>
                </tr>
              </table>
    
    </div> <!-- /container -->

<?php include("footer.php"); ?>