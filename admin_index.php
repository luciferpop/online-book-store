<?php
  session_start();
  error_reporting(E_ERROR);
  include_once "helper/dbconn.php";
  //$_SESSION["login_name"] = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Book Store | Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <?php
    require "helper/header_admin.php";
  ?>
  <div class="crumb_navigation"> Navigation: <span class="current">Administrator</span> </div>
    <fieldset>
      <legend>Recent Registered</legend>
      <?php 
        $sql = "SELECT Fname, Lname, Usrname, Email, Addr, Created FROM USER ORDER BY Created DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        echo '<table>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Time Created</th>
          </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '
                <tr>
                  <td>'.$row['Fname'].'</td>
                  <td>'.$row['Lname'].'</td>
                  <td>'.$row['Usrname'].'</td>
                  <td>'.$row['Email'].'</td>
                  <td>'.$row['Addr'].'</td>
                  <td>'.$row['Created'].'</td>
                </tr>
              ';
        }
        echo '</table>';
      ?>
    </fieldset>
    <fieldset>
      <legend>Recent Orders</legend>
        <?php 
        $sql = "SELECT ODR_ID, Usrname, Total, Created FROM ORDERS ORDER BY Created DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        echo '<table>
          <tr>
            <th>Order Id</th>
            <th>User Name</th>
            <th>Total Charged</th>
            <th>Time Created</th>
          </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '
                <tr>
                  <td>'.$row['ODR_ID'].'</td>
                  <td>'.$row['Usrname'].'</td>
                  <td>'.$row['Total'].' $</td>
                  <td>'.$row['Created'].'</td>
                </tr>
              ';
        }
        echo '</table>';
      ?>
    </fieldset>
    <fieldset>
      <legend>Recent Order Items</legend>
      <?php 
        $sql_items = "SELECT ORDERS.Usrname, ORDERS.Created, ORDER_ITEMS.ISBN, ORDER_ITEMS.Quantity FROM ORDERS, ORDER_ITEMS        WHERE ORDERS.ODR_ID = ORDER_ITEMS.ORD_ID ORDER BY ORDERS.Created DESC LIMIT 5";
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
    </fieldset>
    <fieldset>
      <legend>Recent Activities</legend>
      <p><font size=2 color="#666000">No recent activities recorded.</font></p>
    </fieldset>
<?php
  require "helper/footer.php";
?>
</div>
</body>
</html>
