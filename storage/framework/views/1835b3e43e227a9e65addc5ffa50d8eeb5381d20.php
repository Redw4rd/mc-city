<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo e(route('index')); ?>/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e($site['title']); ?> - Kezelőfelület</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php echo $__env->yieldPushContent('header_css'); ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $__env->yieldPushContent('header_js'); ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><?php echo e($site['title']); ?></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="<?php echo e(route('index')); ?>"><span class="fa fa-sign-out"></span> Kilépés az oldalra</a>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard fa-fw"></i> Kezelőfelület</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-newspaper-o"></i> Hírek<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(route('dashboard.news', 'new')); ?>">Új hír létrehozása</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('dashboard.news')); ?>">Hírek kezelése</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope"></i> Hírlevél<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(route('dashboard.newsletter', 'new')); ?>">Új hírlevél létrehozása</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('dashboard.newsletter')); ?>">Hírlevelek</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo e(route('dashboard.tickets')); ?>"><span class="fa fa-ticket"></span> Hibajegyek</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Egyszerű oldalak<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(route('sites', 'aszf')); ?>">Á.SZ.F</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('sites', 'aff')); ?>">Á.F.F</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('sites', 'szabalyzat')); ?>">Szabályzat</a>
                                </li>
								<li>
                                    <a href="<?php echo e(route('sites', 'tortenet')); ?>">Történet</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo e(route('users')); ?>"><span class="fa fa-users"></span> Felhasználók</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('ranks')); ?>"><span class="fa fa-paypal"></span> Rangok</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Beállítások<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(route('settings.sales')); ?>">Akciók</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('settings.site')); ?>">Weboldal adatai</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo e(route('dashboard.log')); ?>"><span class="fa fa-list"></span> Log</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $__env->yieldContent('pagetitle'); ?></h1>
                </div>
            </div>
            <div class="page-body">
                <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->yieldContent('page'); ?>
            </div>
        </div>

    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.js"></script>
    <script src="js/sb-admin-2.js"></script>
    <?php echo $__env->yieldPushContent('footer_js'); ?>
</body>
</html>