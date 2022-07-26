<?php
session_start();
include 'db.php';
if (isset($_POST['changepassword'])) {
  $oldpass = $_POST['oldpassword'];
  $newpass = $_POST['newpassword'];
  $confirmpass = $_POST['confirmpassword'];
  if (!empty($oldpass)) {
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM user_credential WHERE id=$id";
    $select_query = mysqli_query($conn, $query);
    foreach ($select_query as $value) {
      $match_password = password_verify($oldpass, $value['password']);
      if ($match_password) {
        if ($newpass == $confirmpass) {
          $secure_password = password_hash($newpass, PASSWORD_DEFAULT);
          $query_update = "UPDATE user_credential SET password = '$secure_password'  WHERE id = '$id'";
          $query_run = mysqli_query($conn, $query_update);
          if ($query_run) {
            header('Location: password.php?info=success');
            die();
          } else {
            header('Location: password.php?info=queryfail');
          }
        } else {
          header('Location: password.php?info=passmismatched');
        }
      } else {
        header('Location: password.php?info=currmismatched');
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Password Change</title>
  <?php include "bootstrap.php"; ?>
</head>

<body>
  <form action="" method="POST">
    <?php include 'nav.php' ?>
    <div class="container">
      <?php if ($_REQUEST['info']) { ?>
        <?php if ($_REQUEST['info'] == 'success') { ?>
          <div class="alert alert-success" role="alert">
            Password is Successfully changed!
          </div>
        <?php } ?>
        <?php if ($_REQUEST['info'] == 'queryfail') { ?>
          <div class="alert alert-success" role="alert">
            Oops Try Again Later!
          </div>
        <?php } ?>
        <?php if ($_REQUEST['info'] == 'passmismatched') { ?>
          <div class="alert alert-success" role="alert">
            Your new Password mismatched with Confirm Password!
          </div>
        <?php } ?>
        <?php if ($_REQUEST['info'] == 'currmismatched') { ?>
          <div class="alert alert-success" role="alert">
            Your Current Password is Incorrect!
          </div>
        <?php } ?>
      <?php } ?>
      <label for="inputPassword" class="col-sm-2 mt-5 col-form-label">Current Password</label>
      <div class="col-sm-10">
        <input type="password" name="oldpassword" class="form-control" id="inputPassword" required>
      </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
      <div class="col-sm-10">
        <input type="password" name="newpassword" class="form-control" id="inputPassword" required>
      </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
      <div class="col-sm-10">
        <input type="password" name="confirmpassword" class="form-control" id="inputPassword" required>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
      <input type="submit" name="changepassword" value="Submit">
      <!-- <button type="button" name="" class="btn btn-primary mt-3">Change Password</button> -->
    </div>
    </div>
  </form>
</body>

</html>
