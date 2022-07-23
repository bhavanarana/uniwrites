<?php
session_start();
include 'db.php';
$select = "SELECT * FROM entries WHERE delete_status='0'";
$query_select = mysqli_query($conn, $select);
if (!$query_select) {
  echo 'Failed to fetch details';
}
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  $update = "UPDATE entries SET delete_status = '1' WHERE id = '$id'";
  $update_query = mysqli_query($conn, $update);
  if ($update_query) {
    header("Location: view.php?result=deleted");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "bootstrap.php"; ?>
  <title>Blog</title>
</head>

<body>
  <?php include 'nav.php'; ?>
  <div class="container">
    <div class="row">
      <h1 class="view-heading">Blogs</h1>
    </div>
    <?php if (isset($_REQUEST['result'])) { ?>
      <?php if ($_REQUEST['result'] == 'deleted') { ?>
        <!--alert box-->
        <div class="container">
          <div class="alert alert-success" role="alert">
            You have Successfully Deleted your Blog
          </div>
        </div>
      <?php } ?>
      <?php if ($_REQUEST['result'] == 'updated') { ?>
        <!--alert box-->
        <div class="container">
          <div class="alert alert-success" role="alert">
            You have Successfully updated your Blog
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
    <div class="row">
      <?php foreach ($query_select as $value) { ?>
        <div class="col-lg-6 " style="max-width: 680px;">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-3">
                <?php if ($value['image_url'] != null) { ?>
                  <img class="view-img" src="../uploads/<?php echo $value['image_url'] ?>" class="img-fluid rounded-start">
                <?php } ?>
                <?php if ($value['image_url'] == null) { ?>
                  <img class="view-img" src="../default.png" class="img-fluid rounded-start">
                <?php  } ?>
              </div>
              <div class="col-md-9">
                <div class="card-body">
                  <!-- <div class="d-flex justify-content-between"> -->
                  <?php if ($_SESSION['user_id'] == $value['user_id']) { ?>
                    <p class="d-flex float-end">
                      <a href="edit.php?id=<?php echo $value['user_id'] ?>" class="edit-delete-link">
                        <ion-icon name="create"></ion-icon>
                      </a>
                    <form method="POST">
                      <input type="text" hidden name="id" value="<?php echo $value['id']; ?>">
                      <a href="view.php?id=<?php echo $value['id'] ?>" class="edit-delete-link">
                        <ion-icon name="trash"></ion-icon>
                      </a>
                    </form>
                    </p>
                  <?php } ?>
                  <!-- </div> -->
                  <h5 class="card-title"><?php echo $value['title'] ?></h5>
                  <p class="card-text"><?php echo $value['excerpt'] ?></p>
                  <div class="d-flex justify-content-between">
                    <p class="card-text"><small class="text-muted">
                        <?php
                        $timestamp = $value['timestamp'];
                        $datetime = explode(" ", $timestamp);
                        $date = $datetime[0];
                        $date_format = date('F j, Y', strtotime($date)); //used for changing date format
                        // print_r($date_format);
                        echo $date_format;
                        ?>
                      </small></p>

                    <p>
                      <!-- <small class="test-muted"> -->
                      <a href="openblog.php" class="edit-delete-link">
                        <ion-icon size="large" name="arrow-round-forward"></ion-icon>
                      </a>
                      <!-- </small> -->
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
</body>

</html>
