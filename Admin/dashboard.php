<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 $sql = "SELECT max(request_id) FROM submitrequest_tb";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);
 $submitrequest = $row[0];

 $sql = "SELECT max(request_id) FROM assignwork_tb";
 $result = $conn->query($sql);
 $row = mysqli_fetch_row($result);
 $assignwork = $row[0];

 $sql = "SELECT * FROM technician_tb";
 $result = $conn->query($sql);
 $totaltech = $result->num_rows;

?>
<div class="col-sm-9 col-md-10">
<div class="row mx-5 text-center">
  <div class="col-sm-4 mt-5">
    <div class="card text-white mb-3" style="max-width: 18rem; background-color: #0F9D58;">
      <div class="card-header">
        <i class="fas fa-tasks"></i>
        Requests Received
      </div>
      <div class="card-body">
        <h4 class="card-title">
          <?php echo $submitrequest; ?>
        </h4>
        <a class="btn text-white" href="request.php">
          <i class="fas fa-eye"></i> View
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 mt-5">
    <div class="card text-white mb-3" style="max-width: 18rem; background-color: #F4B400;">
      <div class="card-header">
        <i class="fas fa-tasks"></i>
        Assigned Work
      </div>
      <div class="card-body">
        <h4 class="card-title">
          <?php echo $assignwork; ?>
        </h4>
        <a class="btn text-white" href="work.php">
          <i class="fas fa-eye"></i> View
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 mt-5">
    <div class="card text-white mb-3" style="max-width: 18rem;background-color: #DB4437;">
      <div class="card-header">
        <i class="fas fa-users"></i>
        No. of Technicians
      </div>
      <div class="card-body">
        <h4 class="card-title">
          <?php echo $totaltech; ?>
        </h4>
        <a class="btn text-white" href="technician.php">
          <i class="fas fa-eye"></i> View
        </a>
      </div>
    </div>
  </div>
</div>

  <div class="mx-5 mt-5 text-center">
    <!--Table-->
    <p class="text-dark p-2"><strong>RECENT REQUESTS</strong></p>
    <?php
    $sql = "SELECT * FROM submitrequest_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table table-auto"">
  <thead class="thead-dark">
   <tr>
    <th scope="col">Client Name</th>
    <th scope="col">Client Mobile</th>
    <th scope="col">Request Name</th>
    <th scope="col">Request Date</th>
    <th scope="col">Request ID</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["requester_name"].'</th>';
    echo '<td>0'. $row["requester_mobile"].'</td>';
    echo '<td>'. $row["request_info"].'</td>';
    echo '<td>'.$row["request_date"].'</td>';
    echo '<td>'.$row["request_id"].'</td>';
  }
 echo '</tbody>
 </table>';
} else {
  echo "0 Result";
}
?>
  </div>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
?>