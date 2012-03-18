
<!--Test Oracle file for UBC CPSC304 2006 Winter Term 2
  Created by Jiemin Zhang
  This file shows the very basics of how to execute PHP commands
  on Oracle.  
  specifically, it will drop a table, create a table, insert values
  update values, and then query for values
 
  IF YOU HAVE A TABLE CALLED "tab1" IT WILL BE DESTROYED

  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the 
  OCILogon below to be your ORACLE username and password -->

<?php 
//this tells the system that it's no longer just parsing 
//html; it's now parsing PHP

// Connect Oracle...
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {

   /* OCILogon() allows you to log onto the Oracle database
      The three arguments are the username, password, and database
      You will need to replace "username" and "password" for this to
      to work. 
      all strings that start with "$" are variables; they are created
      implicitly by appearing on the left hand side of an assignment 
      statement */

  echo "Successfully connected to Oracle.<br><br>";


// Drop old table...
   $cmdstr = "Drop table tab1";
   $parsed = OCIParse($db_conn, $cmdstr);
   
   /* OCIParse() Prepares Oracle statement for execution
      The two arguments are the connection and SQL query. */

   if (!$parsed){
      $e = OCIError($db_conn);  // For OCIParse errors pass the       
                                // connection handle
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); // For OCIExecute errors pass the       
                               // statementhandle
      echo htmlentities($e['message']);
      exit;
   } 
    
   /* OCIExecute() executes a previously parsed statement
      The two arguments are the statement which is a valid OCI
      statement identifier, and the mode. 
      default mode is OCI_COMMIT_ON_SUCCESS. Statement is
      automatically committed after OCIExecute() call when using this
      mode.
      Here we use OCI_DEFAULT. Statement is not committed
      automatically when using this mode */ 


// Create new table...
   $cmdstr = "create table tab1 (col1 number, col2 varchar2(30))";
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   } 

// Insert data into table...
   $cmdstr = "insert into tab1 values (1, 'Frank')";
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed); 
    if (!$r){
      $e = oci_error($parsed, OCI_DEFAULT); 
      echo htmlentities($e['message']);
      exit;
   } 


// Insert data using bind variables...
   /* Sometimes a same statement will be excuted for severl times, only
      the value of variables need to be changed.
      In this case you don't need to create the statement several times; 
      using bind variables can make the statement be shared and just 
      parsed once. */
 
   $cmdstr = "insert into tab1 values (:bind1, :bind2)"; 
   //define two bind variables in the SQL statement. 

   $parsed = OCIParse($db_conn, $cmdstr); // parse the statement
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $var1 = 2;
   $var2 = "Scott"; // define two PHP variables
   OCIBindByName($parsed, ":bind1", $var1); // bind the PHP variables "$var1" to ":bind1"
   OCIBindByName($parsed, ":bind2", $var2); 

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   } 

//Insert data got from user...

  echo "Please insert test data:<br>";

?> 

<p><font size="2"> Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name</font></p>
<form method="POST" action="oracle-test2.php">
<!--go to "oracle-text2.php" when submit-->

   <p><input type="text" name="NO" size="6"><input type="text" name="name" size="18">
<!--define two variables to pass the value-->
      
<input type="submit" value="submit" name="B1"></p>
</form>
<!-- create a form to pass the values. See "oracle-test2.php" for how to get the values--> 


<?php

// Delete data...
   $cmdstr = "delete from tab1 where COL1=1";
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   } 


   
// Update data...
   $cmdstr = "update tab1 set COL1=10 where COL1=2";
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   } 


// Select data...
   $cmdstr = "select * from tab1";
   $parsed = OCIParse($db_conn, $cmdstr);
   if (!$parsed){
      $e = OCIError($db_conn);  
      echo htmlentities($e['message']); 
      exit;
   }

   $r=OCIExecute($parsed, OCI_DEFAULT); 
    if (!$r){
      $e = oci_error($parsed); 
      echo htmlentities($e['message']);
      exit;
   }  

   echo "<br>Got data from table tab1:<br>";

   while ($row = OCI_Fetch_Array($parsed, OCI_BOTH))
   
  /* OCI_Fetch_Array() Returns the next row from the result data as an  
     associative or numeric array, or both.
     The two arguments are a valid OCI statement identifier, and an 
     optinal second parameter which can be any combination of the 
     following constants:

     OCI_BOTH - return an array with both associative and numeric 
     indices (the same as OCI_ASSOC + OCI_NUM). This is the default 
     behavior.  
     OCI_ASSOC - return an associative array (as OCI_Fetch_Assoc() 
     works).  
     OCI_NUM - return a numeric array, (as OCI_Fetch_Row() works).  
     OCI_RETURN_NULLS - create empty elements for the NULL fields.  
     OCI_RETURN_LOBS - return the value of a LOB of the descriptor.  
     Default mode is OCI_BOTH.  */


   {

   echo $row["COL1"];     //or just use "echo $row[0]" 
                          //Where $row[0] is the first column
   echo "\n";

   echo $row["COL2"];     //or just use "echo $row[1]"
  }


//Commit to save changes...
  OCICommit($db_conn); 

  OCILogoff($db_conn); 
}


else {
  $e = OCIError();  // For OCILogon errors pass no handle
  echo htmlentities($e['message']);
}

?>