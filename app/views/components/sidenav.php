<link rel="stylesheet" type="text/css" href="/../../styles/sidebar.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<div class="l-navbar show" id="nav-bar">
    <nav class="sidenav">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div>
            <div class="nav_list">
                <a href="/login" class="nav_link active">
                    <i class='bx bx-user nav_icon'></i>
                    <span class="nav_name">Mijn account</span>
                </a>
                <a href="/order" class="nav_link active">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Mijn bestellingen</span>
                </a>
                <?php
                if (isset($_SESSION['user'])) {
                    $user = unserialize($_SESSION['user']);
                    $role = $user->getRole();
                }
                ?>
                <?php if ($role->getId() == 2 || $role->getName() == "Admin") : ?>

                    <a href="#" class="nav_link active">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Gebruikers</span>
                    </a>
                    <a href="/allproducts" class="nav_link active">
                        <i class='bx bx-shopping-bag nav_icon'></i>
                        <span class="nav_name">Producten</span>
                    </a>
                    <a href="#" class="nav_link active">
                        <i class='bx bx-basket nav_icon'></i>
                        <span class="nav_name">Alle bestellingen</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <a href="/logout" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">Log uit</span>
        </a>
    </nav>
</div>