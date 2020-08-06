<?php
// include 'tracking.php';


	require('config/travel-config.php'); //Load DB(mysql) config parameter
	function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}
	session_start(); //Start session
	if (isset($_POST['Email']) and isset($_POST['Password'])){ //If the form is submitted or not.
		$email = antiinjection($_POST['Email']); //Assigning posted values to variables.
		$password = antiinjection($_POST['Password']);
		//Checking the values are existing in the database or not
		$query = "SELECT TravelName, RoleID, Email, FirstName, RoleID  FROM `user` WHERE Email='$email' and Password='".md5($password)."' and Status = 'Active' and date(ExpirationDate) > CURDATE()";
		$result = mysql_query($query,$Link) or die(mysql_error($Link));
		if(mysql_num_rows($result) == 0){
			?>
			<script type="text/javascript" language="javascript">
						alert("Unregistered user or wrong password");
					</script>
<?php
				echo "<meta http-equiv='refresh' content='0; url=./?page=Halaman-Utama'>";
			}else{
				$row = mysql_fetch_assoc($result);
				if($row['RoleID'] == 1){
					$_SESSION['Email'] = $row['Email'];
					$_SESSION['FirstName'] = $row['FirstName'];
					$_SESSION['role'] = $row['RoleID'];
					$_SESSION['Travel'] = $row['TravelName'];
					header("Location: modul/main_agent.php");
				}else if($row['RoleID'] >= 2){
					$_SESSION['Email'] = $row['Email'];
					$_SESSION['FirstName'] = $row['FirstName'];
					$_SESSION['role'] = $row['RoleID'];
					$_SESSION['Travel'] = $row['TravelName'];
					header("Location: modul/main.php");
				}else{

								echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
				}
			}
		}
?>
