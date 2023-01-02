<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= PATH ?>" class="brand-link" target="_blank">
        <!--<img src="<?= PATH ?>/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
        <span class="brand-text font-weight-light">Учет затрат</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!--
            <div class="image">
                <img src="<?= PATH ?>/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            -->
            <div class="info">
                <?php if($_SESSION['user']['role'] == 'superadmin') { ?>
                <a href="<?= PATH ?>/user/edit/<?php echo $_SESSION['user']['id']; ?>" class="d-block">
                     <?php echo  h($_SESSION['user']['name']); ?>
                </a>
                <?php } else {?>
                <span style="color:#c2c7d0;"><?php echo  h($_SESSION['user']['name']); ?></span>

                <?php }?>
                <a href="<?= PATH ?>/user/logout" class="d-block">Выйти</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= PATH ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Главная</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="<?= PATH ?>/legal-entities" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>Юр. лица</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= PATH ?>/physical-entities" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>Физ. лица</p>
                    </a>
                </li>

                <?php if($_SESSION['user']['role'] == 'superadmin') { ?>

                <li class="nav-item">
                    <a href="<?= PATH ?>/category" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Категории</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= PATH ?>/users" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Пользователи</p>
                    </a>
                </li>

                <?php } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
