<!-- Sidebar -->
<?php
    $role_session = mi_get_session('role');

    $logo = mi_db_read_by_id('settings', array('meta_name' => 'site_logo'))[0];
?>
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
    <header class="sidebar-header">
        <a class="logo-icon" href="index.php">
            <img src="assets/logo.png" alt="logo icon">
        </a>
        <span class="logo">
          <a href="index.php"><img src="<?=MI_BASE_URL.$logo['meta_value'];?>" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu">
                <li class="menu-category">Main/Beneficial</li>

                <li class="menu-item">
                    <a class="menu-link" href="index.php">
                        <span class="icon pe-7s-home"></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
    
            <?php if ($role_session['tailoring'] == 1 && $role_session['status'] == 1){?>
                <li class="menu-category">Tailoring</li>


                <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon pe-7s-box2"></span>
                        <span class="title">Fabrics</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="fabrics.php">
                                <span class="dot"></span>
                                <span class="title">All Fabrics</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="add-fabric.php">
                                <span class="dot"></span>
                                <span class="title">Add Fabrics</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a class="menu-link" href="categories.php">
                                <span class="dot"></span>
                                <span class="title">Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>
             

                
            <?php }?>
<!--            -------------design------------->
            <?php if ($role_session['design'] == 1 && $role_session['status'] == 1){?>
                <li class="menu-category">Design Options</li>

            <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ion-tshirt"></span>
                    <span class="title">Shirting</span>
                    <span class="arrow"></span>
                </a>
                <ul class="menu-submenu">
            
                    <li class="menu-item">
                        <a class="menu-link" href="collar_styles.php">
                            <span class="icon pe-7s-angle-right"></span>
                            <span class="title">All Collars</span>
                        </a>
                    </li>

                     <li class="menu-item">
                        <a class="menu-link" href="add_collar.php">
                            <span class="icon pe-7s-angle-right"></span>
                            <span class="title">Add Collars</span>
                        </a>
                    </li>

                   
                </ul>
            </li>
            <?php }?>
<!--            ------------------Administration-------------------->
            <?php if ($role_session['user_management'] == 1 && $role_session['status'] == 1){?>
                <li class="menu-category">Administration</li>

                <li class="menu-item">
                    <a class="menu-link" href="users.php">
                        <span class="icon pe-7s-users"></span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="icon pe-7s-wallet"></span>
                        <span class="title">Staffs</span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="menu-submenu">
                        <li class="menu-item">
                            <a class="menu-link" href="staffs.php">
                                <span class="dot"></span>
                                <span class="title">Show Staffs</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="staff_roles.php">
                                <span class="dot"></span>
                                <span class="title">Staff Roles</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php }?>
<!--            ------------------------settings----------------------->
            <?php if ($role_session['settings'] == 1 && $role_session['status'] == 1){?>
                <li class="menu-category">Settings</li>

                <li class="menu-item">
                    <a class="menu-link" href="home_page_settings.php">
                        <span class="icon pe-7s-tools"></span>
                        <span class="title">Home Page Settings</span>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link" href="backup.php">
                        <span class="icon pe-7s-cloud-download"></span>
                        <span class="title">Site Backup</span>
                    </a>
                </li>
            <?php }?>
        </ul>
    </nav>

</aside>
<!-- END Sidebar -->