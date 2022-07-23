<?php
session_start();
include 'db.php';
if (isset($_POST['submit'])) {
  if (!empty(($_POST['desc']) && ($_POST['title']))) {
    $title = $_POST['title'];
    $disc = $_POST['desc'];
    $description = mysqli_real_escape_string($conn, $disc);
    $excerpt = $_POST['excerpt'];
    $img = $_FILES['image_thumb']; //access image
    $img_size = $img['size']; // image size
    $img_name = $img['name']; // acess name of image
    $img_temp_name = $img['tmp_name']; // acess path of image store temporary
    if ($img_name) {
      if ($img_size > 4194304) {  //4194304byte = 4mb
        header('Location:add.php?error=size');
        die();
      } else {
        $array_alw_fmt = array("jpg", "png", "jpeg");
        $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $new_img_ext = strtolower($img_ext);
        if (in_array($new_img_ext, $array_alw_fmt)) {
          $unique_name = uniqid("IMG-", true) . "." . $new_img_ext;
          $img_path = '../uploads/' . $unique_name;
          move_uploaded_file($img_temp_name, $img_path);
        } else {
          header('Location:add.php?error=format');
          die();
        }
      }
    } else {
      $unique_name = NULL;
    }
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO entries (image_url, title, description, excerpt, user_id) VALUES ('$unique_name','$title','$description', '$excerpt', '$user_id')";
    $query_insert = mysqli_query($conn, $query);
    if ($query_insert) {
      //echo '<h1>You have Successfully Submitted</h1>';
      header('Location:view.php?result=added');
    } else {
      echo '<h1>Try Again</h1>';
    }
    // print_r($img_size);
  }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "bootstrap.php"; ?>
  <title>Add your Blog</title>
</head>

<body>
  <?php
  include 'nav.php';
  ?>
  <?php if (isset($_REQUEST['error'])) { ?>
    <?php if ($_REQUEST['error'] == 'size') { ?>
      <!--alert box-->
      <div class="container">
        <div class="alert alert-success" role="alert">
          File size exceeded!
        </div>
      </div>
    <?php } ?>
    <?php if ($_REQUEST['error'] == 'format') { ?>
      <!--alert box-->
      <div class="container">
        <div class="alert alert-success" role="alert">
          Format not allowed!
        </div>
      </div>
    <?php } ?>
    <?php if ($_REQUEST['result'] == 'added') { ?>
      <!--alert box-->
      <div class="container">
        <div class="alert alert-success" role="alert">
          You have Successfully uploaded your Blog
        </div>
      </div>
    <?php } ?>
  <?php } ?>
  <div class="container add-container mt-5">
    <div class="add-container">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <h1 class="add-heading">Add Your Blog</h1>
          <label for="title" class="form-label input-headers mt-3">Title</label>
          <input type="text" class="form-control input-fields input-height" name="title" id="title_focus" class="title" required>
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label input-headers">Description</label>
          <textarea class="form-control input-fields" id="text-desc" name="desc" rows="6" cols="50" required></textarea>
        </div>

        <div class="mb-3">
          <label for="excerpt" class="form-label input-headers">Excerpt<span class="input-header-div"> (Max characters:150)</span></label>
          <textarea class="form-control input-fields" id="text-desc" name="excerpt" rows="2" cols="50" onkeyup="limit(this);" required></textarea>
        </div>
        <div class="mb-3">
          <label for="Image_thumb" class="form-label input-headers">Upload Image</label>
          <input type="file" class="form-control input-fields" name="image_thumb" class="title">
          <!-- <input type="submit" class=" nav-button col-3 mt-5 btn-secondary" name="submit" value="Cancel"> -->
          <input type="submit" class=" nav-button col-3 mt-5 float-end" name="submit" value="Create blog">
        </div>
      </form>
    </div>
  </div>
  <script>
    $("#title_focus").focus();

    function limit(element) {
      var max_chars = 100;

      if (element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }
  </script>
</body>

</html>
