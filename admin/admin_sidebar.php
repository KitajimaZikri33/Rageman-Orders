<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-light rounded border">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']== 'input_coffee') ? 'active link-light' : 'link-dark' ; ?>"
                                aria-current="page" href="admin.php?x=input_coffee">
                                <i class="bi bi-cup-hot"></i>
                                Input Coffee</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='input_drink') ? 'active link-light' : 'link-dark' ; ?>"
                                href="admin.php?x=input_drink">
                                <i class="bi bi-cup-straw"></i>
                                Input Minuman</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='input_food') ? 'active link-light' : 'link-dark' ; ?>"
                                href="admin.php?x=input_food">
                                <i class="bi bi-egg-fried"></i>
                                Input Makanan</a>
                        </li>

                        <li class="nav-item">
                            <a href="admin.php?x=laporan"
                                class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']== 'laporan') ? 'active link-light' : 'link-dark' ; ?>">
                                <i class="bi bi-file-earmark-bar-graph"></i>
                                Laporan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>