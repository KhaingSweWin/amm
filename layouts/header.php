<?php
session_start();

//echo "<br><br><br><br>";
if(!isset($_SESSION['email']))
{
  header("location:admin/login.php");
}
//echo $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Aung Myanmar</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <!-- End plugin css for this page -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/style.css">
  <linK rel="stylesheet" href="css/detail_form.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo ml-2" href="#"><img width="170px" height="100px" src="images/agmyanmar.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="admin/login.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">ပစ္စည်းစာရင်း</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="category_index.php">ပစ္စည်းအမျိုးအစား</a></li>
                <li class="nav-item"> <a class="nav-link" href="item_index.php">ပစ္စည်းအမျိုးအမည်</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">ငှားရမ်းသူ</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="lent.php">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">ငှားရမ်းခြင်း</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#return" aria-expanded="false" aria-controls="category">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">ပြန်အပ်ခြင်း</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="return">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="return.php">ပြန်အပ်စာရင်း</a></li>
                <li class="nav-item"> <a class="nav-link" href="broken.php">ကျိုးပဲ့/ပျောက်ဆုံး</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="category">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">စတော့</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="stock">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="stock.php">စာရင်းစာအုပ်</a></li>
                <li class="nav-item"> <a class="nav-link" href="additem.php">အသစ်ရောက်ပစ္စည်းစာရင်း</a></li>
                <li class="nav-item"> <a class="nav-link" href="deposit.php">စပေါ်ငွေ</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">အလုပ်သမားများ</span>
            </a>
          </li>
        </ul>
      </nav>