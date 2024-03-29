<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="<?= $webRoot ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title><?= $title ?></title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Entrez votre recherche">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->



    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="Home"><img src="img/core-img/logo.jpg" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="Home"><img src="img/core-img/logo.jpg" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="Home">Accueil</a></li>
                    <li><a href="Shop">Boutique</a></li>
                    <li><a href="Cart">Panier</a></li>
                    <?php if (!isset($_SESSION['auth'])) : ?>
                        <li><a href="Home/login">Se connecter</a></li>
                        <li><a href="Home/registration">Creer mon compte</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['auth'])&& $_SESSION['auth']['role'] == '20') : ?>
                        <li><a href="Dashboard">Mon compte</a></li>
                        <li><a href="Home/disconnected">Se deconnecter</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == '99') : ?>
                        <li><a href="Admin">Administration</a></li>
                        <li><a id="disconnectedSession" href="Home/disconnected">Se deconnecter</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">

                <div class="dropdown">
                    <div id="cart" class="cart">
                        <p><img src="img/core-img/cart.png" alt="image panier"><span style="font-size: 16px; text-transform: uppercase; padding-left: 10px;padding-right: 10px; color: #096A09">Panier</span> (<span id="quantity_product_cart"></span>)</p>
                    </div>
                    <ul id="cart-dropdown" class="cart-dropdown dropdown-menu pull-right">
                        <li ><span id="cart-msg_empty" style="text-align: center"></span></li>
                        <li class="go-to-cart hidden" style="text-align: center"><form method="get" action="/Cart/"><button class="btn btn-primary center-block">Voir le panier</button></form></li>
                    </ul>
                </div>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->
        <!-- Contenu -->
            <?= $content ?>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="Home"><img src="img/core-img/logo.jpg" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="Home">Accueil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/shop">Boutique</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Cart">Panier</a>
                                        </li>
                                        <?php if (!isset($_SESSION['auth'])) : ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="Home/login">Se connecter</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="Home/registration">Creer mon compte</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['auth'])&& $_SESSION['auth']['role'] == '20') : ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="Dashboard">Mon compte</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == '99') : ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="Admin">Administration</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <!-- Gestion du dropdown cart -->
    <script src="js/cart/cartDropdown.js"></script>
    <!-- Check du panier sur l'ensembe des pages -->
    <script src="js/cart/checkStorageContent.js"></script>



</body>

</html>