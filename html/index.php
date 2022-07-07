<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "bootstrap.php";
  ?>
  <title>Portfolio</title>
</head>

<body>
  <?php
  include "nav.php";
  include "script.php"; ?>
  <div class="container home-container">
    <h1 class="home-head col-12">Welcome to the Blog</h1>
    <p class="sub-title-head col-12">Discover stories, thinking, and expertise from writers on any topic.</p>
    <?php if ($_REQUEST['info'] == 'signup') { ?>
      <button class="mt-5 nav-button col-2">Let's Go</button>
    <?php } else { ?>
      <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="mt-5 nav-button col-2">Get Started</button>
    <?php } ?>
  </div>
</body>

</html><!-- Button trigger modal -->
