<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "bootstrap.php";
  ?>
  <title>UniWrites</title>
</head>

<body>
  <?php
  include "nav.php";
  ?>
  <div class="container home-container">
    <img src="../icons/blob_1.svg" alt="" class="blob_1">
    <img src="../icons/blob_2.svg" alt="" class="blob_2">
    <img src="../icons/blob_3.svg" alt="" class="blob_3">
    <h1 class="home-head col-12">Welcome to the Blog</h1>
    <p class="sub-title-head col-12">Discover stories, thinking, and expertise from writers on any topic.</p>

    <?php if (!empty($_SESSION['username'])) { ?>
      <button class="mt-5 nav-button col-2">Welcome</button>
    <?php } else { ?>
      <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="mt-5 nav-button col-2">Sign In / Sign Up</button>
    <?php } ?>
    <?php if (isset($_REQUEST['empty']) || isset($_REQUEST['error'])) { ?>
      <script>
        $(document).ready(function() {
          $('#exampleModal').modal('show');
        });
      </script>
    <?php } ?>
  </div>
</body>

</html><!-- Button trigger modal -->
