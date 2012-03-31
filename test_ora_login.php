<?php
if ($db_conn=OCILogon("ora_p1t7", "a36959104", "ug")) {
    echo "connected to database<br/>";
}
else {
  $e = OCIError();  
  echo htmlentities($e['message']);
}
?>