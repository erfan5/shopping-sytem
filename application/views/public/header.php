<html>
    <head>
        <title>Shoping Zone</title>
        <!--css-->
        <link rel="stylesheet" href="<?php echo base_url('assets/styles/style.css'); ?>" media="all" />
        <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
        <!--css-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="New Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
        <!--search jQuery-->
        <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
        <!--search jQuery-->
        <script src="<?php echo base_url('assets/js/responsiveslides.min.js'); ?>"></script>
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
        </script>
        <!--mycart-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-3.1.1.min.js'); ?>"></script>
        <!-- cart -->
        <script src="<?php echo base_url('assets/js/simpleCart.min.js'); ?>"></script>
        <!-- cart -->
        <!--start-rate-->
        <script src="<?php echo base_url('assets/js/jstarbox.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jstarbox.css'); ?>" type="text/css" media="screen" charset="utf-8" />
        <script type="text/javascript">
            jQuery(function () {
                jQuery('.starbox').each(function () {
                    var starbox = jQuery(this);
                    starbox.starbox({
                        average: starbox.attr('data-start-value'),
                        changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
                        ghosting: starbox.hasClass('ghosting'),
                        autoUpdateAverage: starbox.hasClass('autoupdate'),
                        buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
                        stars: starbox.attr('data-star-count') || 5
                    }).bind('starbox-value-changed', function (event, value) {
                        if (starbox.hasClass('random')) {
                            var val = Math.random();
                            starbox.next().text(' ' + val);
                            return val;
                        }
                    })
                });
            });
        </script>
        <!--//End-rate-->
    </head>
    <body>
        <!--header-->
        <div class="header">
            <div class="header-top">
                <div class="container">
                    <div class="top-left">
                        <a href="#"> Help  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +92302 7227006</a>
                    </div>
                    <div class="top-right">
                        <ul>
                            <li><a href="<?php echo base_url('customer/cart'); ?>">Checkout</a></li>
                            <?php if (!$this->session->has_userdata('customer_name')) { ?>
                                <li><a href="<?php echo base_url('login') ?>">Login</a></li>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('signup'); ?>"> Create Account </a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="heder-bottom">
                <div class="container">
                    <div class="logo-nav">
                        <div class="logo-nav-left">
                            <h1><a href=<?php echo base_url(); ?>>PL Mall <span>Shop anywhere</span></a></h1>
                        </div>
                        <div class="logo-nav-left1">
                            <nav class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header nav_2">
                                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div> 
                                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="<?php echo base_url(); ?>" class="act">Home</a></li>	
                                        <!-- Mega Menu -->
                                        <?php //getcats(); ?>

                                        <li class="dropdown">

                                            <a id="dLabel" role="button" data-toggle="dropdown" class="linq" data-target="#" href="/page.html">
                                                Categories <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                                <?php
                                                if (count($cats)):

                                                    foreach ($cats as $cat):
                                                        $cate_id = $cat['cat_id']
                                                        ?>
                                                        <li><a href="<?php echo base_url('customer/cat_pro') ?>?cat_id=<?php echo $cate_id; ?>"><?php echo $cat['cat_title']; ?></a></li>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </ul>
                                        </li>
                                        <li class="dropdown">

                                            <a id="dLabel" role="button" data-toggle="dropdown" class="linq" data-target="#" href="/page.html">
                                                Brands <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                                                <?php
                                                if (count($brand)):

                                                    foreach ($brand as $brands):
                                                        $brand_id = $brands['brand_id']
                                                        ?>
                                                        <li><a href="<?php echo base_url('customer/brand_pro') ?>?brand_id=<?php echo $brand_id; ?>"><?php echo $brands['brand_title']; ?></a></li>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>

                                            </ul>


                                        </li>
                                        <!--                                        <li><a href="mail.html">Categories</a></li>-->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="logo-nav-right">
                            <ul class="cd-header-buttons">
                                <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                            </ul> <!-- cd-header-buttons -->
                            <div id="cd-search" class="cd-search">
                                <form method="get" action="<?php echo base_url('main_page/search_result'); ?>" enctype="multipart/form-data">
                                    <input name="user_query" type="text" placeholder="Search...">
                                    <input type="submit" name="search" value="Search" />
                                </form
                                ></div>	
                        </div>
                        <div class="header-right2">
                            <div class="cart box_1">
                                <?php //cart();   ?>
                            

                                <?php
                                if ($this->session->has_userdata('customer_name')) {
                                    echo "<b style='color:orange;' >Welcome:</b>" . $_SESSION['customer_name'];
                                } else {
                                    echo "<b style='color:orange;'>Welcome Guest:</b>";
                                }
                                ?><br/>
                                <a href="<?php echo base_url('customer/cart'); ?>"><h3> <div class="total">
                                            <span><?php if (isset($total_bill)) echo "Rs:" . $total_bill ?></span> (<span><?php if(isset($items)) echo $items; ?></span> items)</div>
                                        <img src="<?php echo base_url('assets/images/bag.png'); ?>" alt="" />
                                    </h3></a>
                                <?php
                                if ($this->router->fetch_class() !== 'main_page' && $this->router->fetch_method() !== 'index') {
                                    ?>
                                    <a href="<?php echo base_url(); ?>" style='color: coral;'>Back to Shop</a>
                                <?php } ?>
                                <?php
                                if (!$this->session->has_userdata('customer_id')) {
                                    ?>
                                    <a href='<?php echo base_url('login') ?>' style='color:orange;'>Login</a>
                                <?php } else {
                                    ?>
                                    <a href='<?php echo base_url('login/logout'); ?>' style='color:orange;'>Logout</a>
                                <?php } ?>




                                <div class="clearfix"> </div>
                            </div>	
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!--header-->

