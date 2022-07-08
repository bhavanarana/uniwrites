<?php
include "db.php";

// Sign up
if (isset($_POST['signup'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (!empty($email) || !empty($password)) {
    $checkInput = "SELECT * FROM user_credential WHERE email = '$email'";
    mysqli_report(MYSQLI_REPORT_STRICT);
    $checkInputQuery = mysqli_query($conn, $checkInput);
    if (mysqli_num_rows($checkInputQuery) > 0) {
      header('Location: index.php?empty=taken');
      die();
    } else {

      $secure_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO user_credential(username, email, password) VALUES ('$name','$email','$secure_password')";
      $query_run = mysqli_query($conn, $query);
      if ($query_run) {
        header('Location: index.php?info=signup');
        die();
      } else {
        echo "error";
      }
    }
  } else {
    header("Location:index.php?empty=empty_field");
  }
}

// Sign in
if (isset($_REQUEST['signin'])) {
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $query = "SELECT * FROM user_credential WHERE email='$email'";
  $select_query = mysqli_query($conn, $query);
  foreach ($select_query as $value) {
    $match_password = password_verify($password, $value['password']);
    if ($match_password) {
      $_SESSION['username'] = $value['name'];
      $_SESSION['user_id'] = $value['id'];
      $fetch_letter = substr($_SESSION['username'], 0, 1);
      $_SESSION['username'] = strtoupper($fetch_letter);
      header('Location: add.php');
      exit();
    }
  }
}
?>

<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SignUp/SignIn</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active login-selector" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sign Up</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link login-selector" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sign In</button>
          </li>
        </ul>
        <?php if (isset($_REQUEST['empty'])) { ?>
          <?php if ($_REQUEST['empty'] == 'empty_field') { ?>
            <div class="alert alert-danger mt-3" role="alert">
              Fill the empty fields
            </div>
          <?php } ?>
          <?php if ($_REQUEST['empty'] == 'taken') { ?>
            <div class="alert alert-danger mt-3" role="alert">
              Email already taken
            </div>
          <?php } ?>
        <?php } ?>
        <div class="social-login">
          <p class="model-text">Login with your social network</pc>
          <ul class="social-logo">
            <li class="social-list"><img src="../icons/facebook.png"></li>
            <li class="social-list"><img src="../icons/gmail.png"></li>
            <li class="social-list"><img src="../icons/twitter.png"></li>
          </ul>
        </div>
        <p class="model-text">or</p>
        <div class="tab-content signup-tab mt-4" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form method="POST" id="signup-form">
              <div class="mb-3">
                <input type="text" name="name" class="form-control" id="name" aria-describedby="textHelp" placeholder="Username">
                <small id="name-error">Error Message</small>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
                <small id="email-error">Error Message</small>
              </div>
              <div class="mb-3">
                <input type="password" name="password" class="form-control password-input" id="password" placeholder="Password">
                <small id="password-error">Error Message</small>
              </div>
              <button type="submit" name="signup" class="model-button" id="signup-button">Submit</button>
              <p class="signin-link model-text">Already have an account? <a href="#">Sign In</a></p>
            </form>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form>
              <div class="mb-3">
                <input type="email" class="form-control" name="email" id=" exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control password-input" name="password" id="exampleInputPassword1" placeholder="Password">
              </div>
              <button type="submit" name="signin" class="model-button">Submit</button>
              <p class="signin-link model-text">Don't have an account? <a href="#">Sign Up</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
