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
            echo "error";
          }
        } else {
          echo "password does not match";
        }
      } else {
        echo "Current password is incorrect";
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
  <?php include 'nav.php' ?>
  <div class="container">
    <form action="" method="POST">
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
