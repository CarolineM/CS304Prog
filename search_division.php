<?php include("header.php"); ?>
	<div class="container">
		<?php
			$db_conn = OCILogon("ora_n2f7", "a46785093", "ug");
			$createview = "
				Create View user_in_doc(email, doc_id) 
				As 
				Select N.email, C.document_id 
				From ns_comment N, comment_with_doc C 
				Where N.comment_id=C.comment_id";
			$destroyview = "DROP VIEW user_in_doc";
			$selectquery = "
				Select username, email
				From noteshare_user
				Where email IN(
				Select U.email
				From user_in_doc U, document D
				Where U.doc_id = D.document_id
				Group by U.email
				Having count(U.doc_id)=(Select count(document_id) From document))";
			$viewparse = OCIParse($db_conn, $createview);
			$dropparse = OCIParse($db_conn, $destroyview);
			$parse = OCIParse($db_conn, $selectquery);
			echo "Your query: " . $selectquery . "<br>";

			if (!$viewparse) {
				echo "<br>Cannot parse the following command: " . $createview . "<br>";
				$e = OCI_Error($db_conn); // For OCIParse errors pass the       
				// connection handle
				echo htmlentities($e['message']);
			} else {
			//execute query
				$r = OCIExecute($viewparse, OCI_DEFAULT);
				if (!$r) {
					echo "<br>Cannot execute the following command: " . $createview . "<br>";
					$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
					echo htmlentities($e['message']);
				}
			}

			if (!$parse) {
				echo "<br>Cannot parse the following command: " . $selectquery . "<br>";
				$e = OCI_Error($db_conn); // For OCIParse errors pass the       
				// connection handle
				echo htmlentities($e['message']);
			} else {
			//execute query
				$r = OCIExecute($parse, OCI_DEFAULT);
				if (!$r) {
					echo "<br>Cannot execute the following command: " . $selectquery . "<br>";
					$e = oci_error($parse); // For OCIExecute errors pass the statementhandle
					echo htmlentities($e['message']);
				} else {
			//return query
					echo "<h3>Results</h3>";
					echo "<table width=\"100%\" border=\"1\">";
					echo "<tr>
							<th>User Name</th>
							<th>User Email</th>
						</tr>";
					while($row = oci_fetch_array($parse, OCI_NUM)) {
						echo "<tr>
								  <td bgcolor=\"#COCOCO\">" . $row[0] . "</td>
								  <td bgcolor=\"#COCOCO\">" . $row[1] . "</td>
								</tr>";
					}
					echo "</table>";
				}
			}
			OCIExecute($destroyview, OCI_DEFAULT);
		?>
	</div>
<?php include("footer.php"); ?>
