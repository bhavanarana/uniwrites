<?php
session_start();
include 'db.php';
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  $fetch_details = "SELECT * FROM entries WHERE id = '$id'";
  $blog_details = mysqli_query($conn, $fetch_details);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "bootstrap.php"; ?>
  <title>View Blog</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  <div class="container">
    <div class="row justify-content-center">
      <?php foreach ($blog_details as $value) {     ?>
        <div class="mt-5" style="text-align: center;">
          <h1><?php echo $value['description']; ?></h1>
          <?php if ($value['image_url'] != NULL) { ?>
            <img src="../uploads/<?php echo $value['image_url']; ?>">
          <?php } ?>
          <p><?php echo $value['description']; ?></p>

        <?php } ?>
        </div>
    </div>
</body>

</html>
