<?php
session_start();
define('TITLE', 'Success');
include('../dbConnection.php');

 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo TITLE; ?></title>
  <link rel="stylesheet" href="your-css-file.css"> <!-- Link to your CSS file -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }
    th,
    td {
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .printBtn {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 0;
    width: 50%;
    cursor: pointer;
}

.printBtn:hover {
    background-color: #0056b3;
}

.closeBtn {
  background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 0;
    width: 50%;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.closeBtn:hover {
    background-color: #c82333;
}
  </style>
</head>

<body>
  <?php
  $sql = "SELECT * FROM customer_tb WHERE custid = {$_SESSION['myid']}";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='col-sm-9 col-md-10 mt-5'>
    <h3 class='text-center'>Customer Bill</h3>
 <table class='table'>
  <tbody>
   <tr>
     <th>Customer ID</th>
    <td>".$row['custid']."</td>
   </tr>
   <tr>
     <th>Customer Name</th>
     <td>".$row['custname']."</td>
   </tr>
   <tr>
    <th>Address</th>
     <td>".$row['custadd']."</td>
  </tr>
   <tr>
    <th>Product</th>
   <td>".$row['cpname']."</td>
   </tr>
   <tr>
    <th>Quantity</th>
    <td>".$row['cpquantity']."</td>
   </tr>
   <tr>
    <th>Price Each</th>
    <td>".$row['cpeach']."</td>
   </tr>
   <tr>
    <th>Total Cost</th>
    <td>".$row['cptotal']."</td>
   </tr>
   <tr>
    <th>Date</th>
    <td>".$row['cpdate']."</td>
    </tr>
  <tr>
    <td colspan='2'>
        <form class='d-print-none' style='display: flex; justify-content: space-between;'>
            <input class='btn btn-danger printBtn' type='submit' value='Print Request' onClick='window.print()'>
            <a href='assets.php' class='btn btn-danger closeBtn' style='text-decoration: none;'>Close</a>
        </form>
    </td>
</tr>

  </tbody>
 </table> </div>
 </div>
 </div>
 ";
  } else {
    echo "Failed";
  }
  ?>




  <?php
  include('includes/footer.php');
  $conn->close();
  ?>