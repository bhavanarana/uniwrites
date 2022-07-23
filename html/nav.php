<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-new">
  <div class="container">
    <a class="navbar-brand nav-brand" href="index.php">
      <h3>UniWrites</h3>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item nav-home">
          <a class="nav-link active ms-4" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item nav-about">
          <a class="nav-link active ms-4" aria-current="page" href="view.php">Blog</a>
        </li>
        <li class="nav-item nav-services">
          <a class="nav-link active ms-4" aria-current="page" href="#services">About Us</a>
        </li>
        <?php if (!empty($_SESSION['username'])) { ?>
          <li>
            <div class="dropdown ms-4">
              <button class="profile-button dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['letter'] ?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">View your Blogs</a></li>
                <li><a class="dropdown-item" href="add.php">Add your Blogs</a></li>
                <li><a class="dropdown-item" href="#">
                    <form method="POST">
                      <input type="submit" name="logout" value="Logout" class="btn btn-danger">
                    </form>
                  </a></li>
              </ul>
            </div>
          </li>
        <?php } else { ?>
          <li class="nav-item nav-services">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="ms-4 nav-button">Sign Up</button>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<!-- Modal -->
<?php include "model.php";
?>
