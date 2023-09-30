<?php
// The contact Us Form wont work with Local Host but it will work on Live Server
if(isset($_REQUEST['submit'])) {
 // Checking for Empty Fields
 if(($_REQUEST['name'] == "") || ($_REQUEST['subject'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['message'] == "")){
  // msg displayed if required field missing

  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  
 } else {
 $name = $_REQUEST['name'];
 $subject = $_REQUEST['subject'];
 $email = $_REQUEST['email'];
 $message = $_REQUEST['message'];

 $mailTo = "tomamundala15@gmail.com";
 $headers = "From: ". $email;
 $txt = "You have received an email from ". $name. ".\n\n".$message;
 mail($mailTo, $subject, $txt, $headers);
 $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Sent Successfully </div>';

}
}
?>

<!--Start Contact Us Row-->
<div class="container pt-5" id="registration"> 
  <h2 class="text-center">Contact Us</h2>
  <div class="row mt-4 mb-4">
    <div class="col-md-6 offset-md-3">
       <form action="" method="post">
<?php if(isset($msg)) {echo $msg; } ?>
  <input type="text" class="form-control" name="name" placeholder="Name" pattern="[A-Za-z]+" title="Only alphabetic characters are allowed"><br>
  <input type="text" class="form-control" name="subject" placeholder="Subject" pattern="[A-Za-z]+" title="Only alphabetic characters are allowed"><br>
  <input type="email" class="form-control" name="email" placeholder="E-mail"><br>
  <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
  <!-- <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br> -->
  <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold" name="submit">Send</button>
 </form>
    </div>
  </div>
</div>
<!-- <div class="col-md-8"> -->
 <!--Start Contact Us 1st Column-->

<!-- </div>  -->
<!-- End Contact Us 1st Column-->