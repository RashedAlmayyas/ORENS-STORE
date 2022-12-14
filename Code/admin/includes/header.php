<?php
require("includes/connect.php");
require_once("functions.php");
session_start();
?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] != 0) {
  if ($_SESSION["type"] == 2) {
    $id = $_SESSION["super_admin_id"];
  } else {
    $id = $_SESSION["admin_id"];
  }
  $sql    = "SELECT * FROM admins WHERE admin_id=$id";
  $result = mysqli_query($conn, $sql);
  $admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
} elseif (!isset($_SESSION["type"])) {
  redirect('../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dahboard</title>
  <!-- Favicon -->
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
  <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="./assets/css/style.min.css">

  <style>
    .fa-bars,.fa-xmark{
      visibility: hidden;
      font-size:22px;
      cursor: pointer;
    }
    @media (max-width:1200px) {
      .fa-bars,.fa-xmark{
        visibility:visible;
    }
    }
  </style>
</head>

<body>
  <div class="layer"></div>
  <!-- ! Body -->
  <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
  <div class="page-flex">
    <!-- ! Sidebar -->
    
    <aside class="sidebar "id='barView' style="background-color:black !important;">

      <div class="sidebar-start">
        <div class="sidebar-head">
        <div class="main-nav-start">
            <div style="font-weight:800; text-align:center;color: white;padding: 10px;display: flex;justify-content: space-between;width: 220px;"><a href="../index.php" style="text-decoration: none; color:white;">ORENS STOR</a> <i class="fa-solid fa-xmark" id='hide' style="font-size: 20px;" onclick="hide()"></i></div>
          </div>
        
        
        </div>
        <div class="sidebar-body">
          <ul class="sidebar-body-menu">
            <li>
              <a class="active" href="./index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
            </li>
            <?php
            if (isset($_SESSION["type"])) {
              if ($_SESSION["type"] == 2) {
                echo '<li>
                        <a href="manage_admins.php"><span class="icon document" aria-hidden="true"></span>Admin</a>
                      </li>
                      <li>
                        <a href="manage_users.php"><span class="icon document" aria-hidden="true"></span>Users</a>
                      </li>';
              }
            }
            ?>
            </li>
            <li>
            <li>
              <a href="manage_categories.php"><span class="icon folder" aria-hidden="true"></span>Categories</a>
            </li>
            </li>
            <li>
            <li>
            <!--  -->
              <a href="manage_products.php"><span class="icon image" aria-hidden="true"></span>Products</a>
            </li>
            <li>
            <!--  -->
              <a href="manage_orders.php"><span class="icon paper" aria-hidden="true"></span>Orders</a>
            </li>
            <li>
            <!--  -->
              <a href="manage_coupons.php"><span class="icon paper" aria-hidden="true"></span>Coupons</a>
            </li>
            <li>
              <a href="../index.php"><span class="icon paper" aria-hidden="true"></span>webisite</a>
            </li>
            </li>
          </ul>
          <?php
          if (isset($_SESSION["type"])) {
            if ($_SESSION["type"] == 2)
              echo '<div class="sidebar-footer" style="margin-top: 70px;">
            <a href="##" class="sidebar-user">
              <span class="sidebar-user-img">
              <img src="' . @$admins[0]['admin_image'] . '">
              </span>
              <div class="sidebar-user-info">
                <span class="sidebar-user__title">' . @$admins[0]['admin_name'] . '</span>
              </div>
            </a>
          </div>';
            else {
              echo '<div class="sidebar-footer" style="margin-top: 370px;">
              <a href="##" class="sidebar-user">
              <span class="sidebar-user-img">
              <img src="' . $admins[0]['admin_image'] . '">
              </span>
              <div class="sidebar-user-info">
                <span class="sidebar-user__title">' . $admins[0]['admin_name'] . '</span>
              </div>
            </a>
          </div>';
            }
          }
          ?>
    </aside>
    <div class="main-wrapper">
      <!-- ! Main nav -->
      <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-end">
            <div class="nav-user-wrapper">
              <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                <span class="sr-only">My profile</span>
                <span class="nav-user-img">
                  <img src="<?php echo  $admins[0]['admin_image'] ?>" alt="abcd">
                </span>
              </button>
              <ul class="users-item-dropdown nav-user-dropdown dropdown">
                <li><a class="danger" href="../logout.php">
                  <i data-feather="log-out" aria-hidden="true"></i>
                  <span>Log out</span>
                </a></li>
              </ul>
            </div>
          </div>
          <div class="main-nav-end">
          <i class="fa-solid fa-bars" id='button'  onclick="viewsid()"></i>

            <!-- <div style=" background-color: blue;text-align:center;color: white;line-height: 1.5;width: 150px;padding: 10px;opacity: 0.5;"><a href="../index.php" style="text-decoration: none; color:white;">ORENS STOR</a></div> -->
          </div>
        </div>
      </nav>