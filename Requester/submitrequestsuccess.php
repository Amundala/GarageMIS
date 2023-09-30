<?php
define('TITLE', 'Success');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
  $rEmail = $_SESSION['rEmail'];
} else {
  echo "<script> location.href='RequesterLogin.php'; </script>";
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
  $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_SESSION['myid']}";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='col-sm-9 col-md-10 mt-5'>
 <table class='table'>
  <tbody>
   <tr>
     <th>Request ID</th>
     <td>" . $row['request_id'] . "</td>
   </tr>
   <tr>
     <th>Name</th>
     <td>" . $row['requester_name'] . "</td>
   </tr>
   <tr>
   <th>Email ID</th>
   <td>" . $row['requester_email'] . "</td>
  </tr>
   <tr>
    <th>Request Info</th>
    <td>" . $row['request_info'] . "</td>
   </tr>
   <tr>
    <th>Request Description</th>
    <td>" . $row['request_desc'] . "</td>
   </tr>
  <tr>
    <td colspan='2'>
        <form class='d-print-none' style='display: flex; justify-content: space-between;'>
            <input class='btn btn-danger printBtn' type='submit' value='Print Request' onClick='window.print()'>
            <a href='SubmitRequest.php' class='btn btn-danger closeBtn' style='text-decoration: none;'>Close</a>
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