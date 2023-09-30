<?php    
define('TITLE', 'Sell Product');
define('PAGE', 'assets');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 if(isset($_REQUEST['psubmit'])){
  // Checking for Empty Fields
  if(($_REQUEST['cname'] == "") || ($_REQUEST['cadd'] == "") || ($_REQUEST['pname'] == "") || ($_REQUEST['pquantity'] == "") || ($_REQUEST['psellingcost'] == "") || ($_REQUEST['totalcost'] == "") || ($_REQUEST['selldate'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable for update
    $pid = $_REQUEST['pid'];
    $pava = ($_REQUEST['pava'] - $_REQUEST['pquantity']);

    // Assigning User Values to Variable for insert
    $custname = $_REQUEST['cname'];
    $custadd = $_REQUEST['cadd'];
    $cpname = $_REQUEST['pname'];
    $cpquantity = $_REQUEST['pquantity'];
    $cpeach = $_REQUEST['psellingcost'];
    $cptotal = $_REQUEST['totalcost'];
    $cpdate = $_REQUEST['selldate'];
    $sqlin = "INSERT INTO customer_tb(custname, custadd, cpname, cpquantity, cpeach, cptotal, cpdate) VALUES ('$custname','$custadd', '$cpname', '$cpquantity', '$cpeach', '$cptotal', '$cpdate')";
    if($conn->query($sqlin) == TRUE){
      // below function captures inserted id
      $genid = mysqli_insert_id($conn);
      session_start();
      $_SESSION['myid'] = $genid;
      echo "<script> location.href='productsellsuccess.php'; </script>";
    } 
    // Updating Assest data for available product after sell
    $sql = "UPDATE assets_tb SET pava = '$pava' WHERE pid = '$pid'";
    $conn->query($sql);
  }
}
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Customer Bill</h3>
  <?php
 if(isset($_REQUEST['issue'])){
  $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
  <?php if(isset($msg)) {echo $msg; } ?>
    <div class="form-group">
      <label for="pid">Product ID</label>
      <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="cname">Customer Name</label>
      <input type="text" class="form-control" id="cname" name="cname">
    </div>
    <div class="form-group">
      <label for="cadd">Customer Address</label>
      <input type="text" class="form-control" id="cadd" name="cadd">
    </div>
    <div class="form-group">
      <label for="pname">Product Name</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>">
    </div>
    <div class="form-group">
      <label for="pava">Available</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>"
        readonly onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="pquantity">Quantity</label>
      <input type="text" oninput="calculateTotalPrice()" class="form-control" id="pquantity" name="pquantity" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="psellingcost">Unit Price</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>"
        onkeypress="isInputNumber(event)" oninput="calculateTotalPrice()">
    </div>
    <div class="form-group">
      <label for="totalcost">Total Price</label>
      <input type="text" class="form-control" id="totalcost" name="totalcost" onkeypress="isInputNumber(event)" readonly>
    </div>
    <div class="form-group col-md-4">
      <label for="inputDate">Date</label>
      <input type="date" class="form-control" id="inputDate" name="selldate" max="<?php echo date('Y-m-d');?>">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Submit</button>
      <a href="assets.php" class="btn btn-secondary">Close</a>
    </div>
  </form>
</div>

<script>
function calculateTotalPrice() {
    // Get the values of Quantity and Unit Price
    var quantity = parseFloat(document.getElementById("pquantity").value) || 0;
    var unitPrice = parseFloat(document.getElementById("psellingcost").value) || 0;

    // Calculate the Total Price
    var totalPrice = quantity * unitPrice;

    // Update the Total Price field
    document.getElementById("totalcost").value = totalPrice.toFixed(2); // You can adjust the number of decimal places as needed
}

// <!-- Only Number for input fields -->

  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php
include('includes/footer.php'); 
?>