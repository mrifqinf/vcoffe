<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg rounded border mt-2" style="background-color: #F8EDE3;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                <div class="offcanvas-header" style="background-color: #DFD3C3;;">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="background-color: #F8EDE3;">
                    <ul class="navbar-nav nav-underline flex-column justify-content-end flex-grow-1">
                        <!-- ALL USER -->
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'active link-dark' : ''; ?>" aria-current="page" href="home"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active link-dark' : ''; ?>" href="menu"><i class="bi bi-card-list"></i> Menu</a>
                        </li>

                        <!-- KASIR DAN PELAYAN -->
                        <?php if ($hasil['level'] == 2 || $hasil['level'] == 3) { ?>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-dark' : ''; ?>" href="order"><i class="bi bi-cart3"></i> Order</a>
                            </li>
                        <?php } ?>

                        <!-- DAPUR ONLY -->
                        <?php if ($hasil['level'] == 4) { ?>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'dapur') ? 'active link-dark' : ''; ?>" href="dapur"><i class="bi bi-box2"></i> Kitchen & Bar </a>
                            </li>
                        <?php } ?>

                        <!-- SUPER ADMIN ONLY -->
                        <?php if ($hasil['level'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-dark' : ''; ?>" href="order"><i class="bi bi-cart3"></i> Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'dapur') ? 'active link-dark' : ''; ?>" href="dapur"><i class="bi bi-box2"></i> Kitchen & Bar </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'katmenu') ? 'active link-dark' : ''; ?>" href="katmenu"><i class="bi bi-tags"></i> Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-dark' : ''; ?>" href="user"><i class="bi bi-card-list"></i> User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-dark' : ''; ?>" href="report"><i class="bi bi-file-earmark-bar-graph"></i> Report</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>