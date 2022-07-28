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
      <?php foreach ($blog_details as $value) { ?>
        <div class="blog-container mt-5">
          <h1 class="blog-title"><?php echo ucwords($value['title']); ?></h1>
          <small><?php
                  $timestamp = $value['timestamp'];
                  $datetime = explode(" ", $timestamp);
                  $date = $datetime[0];
                  $date_format = date('F j, Y', strtotime($date)); //used for changing date format
                  // print_r($date_format);
                  echo $date_format;
                  ?></small>
          <?php if ($value['image_url'] != NULL) { ?>
            <div class="blog-image">
              <img src="../uploads/<?php echo $value['image_url']; ?>" class="mt-5">
            </div>
          <?php } ?>
          <p class="blog-desc"><?php echo $value['description']; ?></p>

        <?php } ?>
        </div>
    </div>
</body>

</html>
