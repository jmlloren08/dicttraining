
<!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url() ?>login\logout" role="button">
                 <i class="fas fa-sign-out-alt"></i>
             </a>
         </li>

     </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="." class="brand-link">
         <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg/600px-Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg.png" alt="DILG Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">DILG Support Ticket</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">

             <div class="info">
                 <a href="<?= base_url('profile') ?>" class="d-block">Welcome, <?= session('user') ? session('user')['firstname'] : "to DILG Support Ticket System"; ?></a>
                 
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-header">TRANSACTIONS</li>
                 <li class="nav-item">
                     <a href="<?= base_url() ?>dashboard" class="nav-link">
                         <i class="fas fa-chart-line nav-icon"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url() ?>tickets" class="nav-link">
                         <i class="fas fa-headset nav-icon"></i>
                         <p>Support Tickets</p>
                     </a>
                 </li>

                 <?php if (session('user')['role'] === 'Admin') : ?>
                     <li class="nav-header">MASTER FILE</li>
                     <li class="nav-item">
                         <a href="<?= base_url() ?>offices" class="nav-link">
                             <i class="fas fa-building nav-icon"></i>
                             <p>Offices</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url() ?>categories" class="nav-link">
                             <i class="fas fa-building nav-icon"></i>
                             <p>Categories</p>
                         </a>
                     </li>

                     <li class="nav-header">ADMIN</li>
                     <li class="nav-item">
                         <a href="<?= base_url() ?>users" class="nav-link">
                             <i class="fas fa-building nav-icon"></i>
                             <p>Users</p>
                         </a>
                     </li>
                 <?php endif; ?>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>