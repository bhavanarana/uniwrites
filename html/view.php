<?php
session_start();
include 'db.php';
$count = 0;
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
    <div class="add-button-position mt-1">
      <a href="add.php">
        <span>
          <ion-icon name="add-circle" class="add-button size=" large"></ion-icon>
        </span>
      </a>
    </div>
    <div class="row mt-5 ">
      <div>
        <h1 class="add-heading ">Blogs</h1>
      </div>
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
    <div class="row mt-4">
      <?php foreach ($query_select as $value) { ?>
        <div class="col-lg-4">
          <a href="openblog.php?id=<?php echo $value['id']; ?>" class="edit-delete-link">
            <div class="card mt-4">
              <div class="card__header">
                <?php if ($value['image_url'] != null) { ?>
                  <img class="card__image img-fluid" width="600" src="../uploads/<?php echo $value['image_url'] ?>">
                <?php } ?>
                <?php if ($value['image_url'] == null) { ?>
                  <img src="https://source.unsplash.com/600x400/?computer" alt="card__image" class="card__image" width="600">
                <?php  } ?>
              </div>
              <div class="card__body">
                <h4 class="card-title"><?php echo $value['title'] ?></h4>
                <p><?php echo $value['excerpt'] ?></p>
              </div>
              <div class="card__footer">
                <div class="user">
                  <div class="user__info">
                    <div>
                      <small><?php
                              $timestamp = $value['timestamp'];
                              $datetime = explode(" ", $timestamp);
                              $date = $datetime[0];
                              $date_format = date('F j, Y', strtotime($date)); //used for changing date format
                              // print_r($date_format);
                              echo $date_format;
                              ?></small>

                    </div>
                    <div class="icons">
                      <?php if ($_SESSION['user_id'] == $value['user_id']) { ?>
                        <div class="wrapper" style="margin-top: -15px;">
                          <p class="d-flex float-end">
                            <a href="edit.php?id=<?php echo $value['id'] ?>" class="edit-delete-link">
                              <ion-icon name="create"></ion-icon>
                            </a>
                          <form method="POST">
                            <input type="text" hidden name="id" value="<?php echo $value['id']; ?>">
                            <a onClick="confirm()" class="edit-delete-link float-end me-1">
                              <ion-icon name="trash"></ion-icon>
                            </a>
                          </form>
                          </p>
                        </div>
                        <script type="text/javascript">
                          function confirm() {
                            swal({
                                title: "Are you sure?",
                                text: "Once deleted, you will not be able to recover this Blog!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                if (willDelete) {
                                  window.location = "view.php?id=<?php echo $value['id'] ?>";
                                  swal("Post has been Deleted!", {
                                    icon: "success",
                                  });
                                }
                              });
                          }
                        </script>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>

</body>

</html>
