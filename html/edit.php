<?php
session_start();
include 'db.php';
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  $fetch = "SELECT * FROM entries WHERE id = '$id'";
  $fetch_details = mysqli_query($conn, $fetch);
}
if (isset($_REQUEST['submit'])) {
  $id = $_REQUEST['id'];
  $title = $_REQUEST['title'];
  $desc = $_REQUEST['desc'];
  $description = mysqli_real_escape_string($conn, $disc);
  $excerpt = $_REQUEST['excerpt'];
  $img = $_FILES['image_thumb']; //access image
  print_r($img);
  $img_size = $img['size']; // image size
  $img_name = $img['name']; // acess name of image
  $img_temp_name = $img['tmp_name']; // acess path of image store temporary
  if ($img_name) {
    if ($img_size > 4194304) {  //4194304byte = 4mb
      header('Location:edit.php?error=size');
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
        header('Location:edit.php?error=format');
        die();
      }
    }
  } else {
    $unique_name = NULL;
  }
  $user_id = $_SESSION['user_id'];
  $update = "UPDATE entries SET image_url = '$unique_name', title = '$title', description = '$desc', excerpt = '$excerpt' WHERE id = '$id'";
  $update_value = mysqli_query($conn, $update);
  if ($update_value) {
    header("Location: view.php?result=updated");
  } else {
    echo "error" . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <?php include "bootstrap.php"; ?>
  <title>Edit Blog</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  <div class="container add-container">
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
    <?php } ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <?php foreach ($fetch_details as $value) { ?>
        <div class="mb-3">
          <h1 class="add-heading">Edit Your Blog</h1>
          <input type="text" hidden name="id" value="<?php echo $value['id'] ?>">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" class="title" value="<?php echo $value['title']; ?>">
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <textarea class="form-control" class="desc" name="desc" rows="3"><?php echo $value['description']; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="excerpt" class="form-label">Excerpt</label>
          <textarea class="form-control" id="text-desc" name="excerpt" rows="2" cols="50" required><?php echo $value['excerpt']; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="Image_thumb" class="form-label">Upload Image</label>
          <input type="file" class="form-control" name="image_thumb" class="title">
        </div>
        <input type="submit" class="btn btn-primary button mt-4" name="submit" value="Save">
      <?php } ?>
    </form>
  </div>
</body>

</html>
