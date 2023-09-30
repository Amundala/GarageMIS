<?php
define('TITLE', 'Work Order');
define('PAGE', 'work');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>

<div class="col-sm-6 mt-5  mx-5">
 <h3 class="text-center">Assigned Work Details</h3>
 <?php
 if(isset($_REQUEST['view'])){
    //echo $_REQUEST['id'];
  //$sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
  $sql = "SELECT 
  ass.rno, ass.request_id, ass.request_info, ass.requester_name,
  ass.requester_add2, ass.requester_city, ass.requester_mobile, 
  ass.assign_date, ass.request_desc, ass.requester_state, 
  ass.requester_email, ass.requester_add1, tdbb.empName
FROM assignwork_tb ass 
LEFT JOIN technician_request td ON ass.rno = td.request_id 
LEFT JOIN technician_tb tdbb ON tdbb.empid = td.technicial_id 
WHERE ass.request_id = {$_REQUEST['id']}";

 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
 <table class="table table-auto table-bordered">
  <tbody>
   <tr>
    <td style="font-weight: 600;">Request ID</td>
    <td>
     <?php if(isset($row['request_id'])) {echo $row['request_id']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Request Info</td>
    <td>
     <?php if(isset($row['request_info'])) {echo $row['request_info']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Request Description</td>
    <td>
     <?php if(isset($row['request_desc'])) {echo $row['request_desc']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Name</td>
    <td>
     <?php if(isset($row['requester_name'])) {echo $row['requester_name']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Address Line 1</td>
    <td>
     <?php if(isset($row['requester_add1'])) {echo $row['requester_add1']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Address Line 2</td>
    <td>
     <?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">City</td>
    <td>
     <?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Sector</td>
    <td>
     <?php if(isset($row['requester_state'])) {echo $row['requester_state']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Email</td>
    <td>
     <?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Mobile</td>
    <td>
     <?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Assigned Date</td>
    <td>
     <?php if(isset($row['assign_date'])) {echo $row['assign_date']; }?>
    </td>
   </tr>
   <tr>
    <td style="font-weight: 600;">Technician Name</td>
    <td>
     <?php if(isset($row['empName'])) {echo $row['empName']; }?>
    </td>
   </tr>
  </tbody>
 </table>
 <div class="text-center">
  <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>
  <form class='d-print-none d-inline' action="work.php"><input class='btn btn-secondary' type='submit' value='Close'></form>
 </div>
</div>

<?php
include('includes/footer.php'); 
?>