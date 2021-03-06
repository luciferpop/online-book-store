<?php
	session_start();
	//ini_set('display_errors', 'On');
	error_reporting(E_ERROR);
	include_once "helper/dbconn.php";
	if (isset($_SESSION["login_name"])) {
		$sql = "SELECT Fname, Lname, Email, Addr FROM USER WHERE Usrname = '".$_SESSION["login_name"]."'";
		$result = mysqli_query($conn, $sql);
		//var_dump($result);
		while ($row = $result->fetch_assoc()) {
				$fname = $row['Fname'];
				$lname = $row['Lname'];
				$email = $row['Email'];
				$addr = $row['Addr'];
	    	}
	} else {
		echo "
			<script>
				alert('Please login first! Redirecting...');
				window.location.href='index.php';
			</script>
		";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My Account | User</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
<style type="text/css">
input[type=text], select {
width: 80%;
padding: 10px 10px;
margin: 0px;
display: inline-block;
border: 1px solid #666000;
border-radius: 4px;
box-sizing: border-box;
}
</style>
</head>
<body>
<div id="main_container">
<?php
	require "helper/header.php";
?>
<div class="crumb_navigation"> Navigation: <span class="current">My Account</span> </div>
<fieldset>
<legend><?php echo $_SESSION["login_name"];?> 's account</legend>
<div>
  <form action='myacc_user_update.php' method="post">
  	<table>
        <tr>
        	<td><strong>First Name: </strong></td>
	        <td><input type="text" name="first_name" value="<?php if ($fname != NULL) echo $fname; else echo 'Set Your First Name';?>"></td>
	    </tr>
	    
	    <tr>
	    	<td><strong>Last Name: </strong></td>
	        <td><input type="text" name="last_name" value="<?php if ($lname != NULL) echo $lname; else echo 'Set Your Last Name';?>"></td>
	    </tr>

	    <tr>
	    	<td><strong>Email: </strong></td>
	        <td><input type="text" name="email" value="<?php if ($email != NULL) echo $email; else echo 'Set Your Email Address';?>""></td>
	    </tr>
	    
	    <tr>
	    	<td><strong>Address: </strong></td>
	        <td><input type="text" name="addr" value="<?php if ($addr != NULL) echo $addr; else echo 'Set Your Address';?>"></td>
	    </tr>
	</table>

	    <input type='submit' name="submit" value='Save Changes'>
  </form>
</div>
</fieldset>
<fieldset>
	<legend>Recent Order</legend>
	<div>
		<?php 
			$sql_odr = "SELECT Usrname, Total, Created, Modified FROM ORDERS WHERE CUS_ID = '".$_SESSION['login_id']."' ORDER BY Created DESC";
			$result = mysqli_query($conn, $sql_odr);
			echo '<table>
				  <tr>
				    <th>Username</th>
				    <th>Total Charged</th>
				    <th>Order Created</th>
				    <th>Order Modified</th>
				  </tr>';
			while ($row = $result->fetch_assoc()) {
				echo '
					<tr>
						<td>'.$row['Usrname'].'</td>
						<td>'.$row['Total'].' $</td>
						<td>'.$row['Created'].'</td>
						<td>'.$row['Modified'].'</td>
					</tr>
				';
			}
			echo '</table>';
		?>
	</div>
</fieldset>
<fieldset>
	<legend>Recently Purchased</legend>
	<div>
		<?php 
			$sql_items = "SELECT ORDERS.Usrname, ORDERS.Created, ORDER_ITEMS.ISBN, ORDER_ITEMS.Quantity FROM ORDERS, ORDER_ITEMS 			  WHERE ORDERS.ODR_ID = ORDER_ITEMS.ORD_ID AND ORDERS.CUS_ID = '".$_SESSION['login_id']."' ORDER BY     			  ORDERS.Created DESC";
			$result = mysqli_query($conn, $sql_items);
			echo '<table>
				  <tr>
				    <th>Username</th>
				    <th>Order Created</th>
				    <th>Book ISBN</th>
				    <th>Quantity</th>
				  </tr>';
			while ($row = $result->fetch_assoc()) {
				echo '
					<tr>
						<td>'.$row['Usrname'].'</td>
						<td>'.$row['Created'].'</td>
						<td>'.$row['ISBN'].'</td>
						<td>'.$row['Quantity'].'</td>
					</tr>
				';
			}
			echo '</table>';
		?>
	</div>
</fieldset>
<?php
	require "helper/footer.php";
?>
</div>
</body>
</html>