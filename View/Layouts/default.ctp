<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Eventos en Nodriza Spa</title>

    <!-- Favicons-->
    <link rel="icon" href="<?= $this->webroot; ?> 'img/publico/nodiza-favicon.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= $this->webroot; ?> 'img/publico/nodiza-favicon.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= $this->webroot; ?> 'img/publico/nodiza-favicon.png">
    <!-- For Windows Phone -->
    
    <!-- CORE CSS--> 
    <?= $this->Html->css('/publico/css/materialize.min.css', array('media' => 'screen,projection')); ?>
    <?= $this->Html->css('/publico/css/style.css', array('media' => 'screen,projection')); ?>

    <!-- Custome CSS-->    
    <?= $this->Html->css('/publico/css/custom/custom.css', array('media' => 'screen,projection')); ?>

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <?= $this->Html->css('/publico/js/plugins/perfect-scrollbar/perfect-scrollbar.css', array('media' => 'screen,projection')); ?>
    <!--<link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">-->
    <?= $this->fetch('css'); ?>

    <?= $this->Html->scriptBlock("var webroot = '{$this->webroot}';"); ?>
    <?= $this->Html->scriptBlock("var fullwebroot = '{$this->Html->url('', true)}';"); ?>

</head>

<body>
    <!-- Start Page Loading  -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->


        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START CONTENT -->
            <section id="content" class="valign-wrapper">

                <?= $this->fetch('content'); ?>
            
            </section>
            <!-- END CONTENT -->


        </div>
        <!-- END WRAPPER -->


    <?= $this->Html->script(array(
        '/publico/js/plugins/jquery-1.11.2.min.js',
        '/publico/js/materialize.min.js',
        '/publico/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js',
        '/publico/js/plugins/prism/prism.js',
        '/publico/js/plugins/masonry.pkgd.min.js',
        '/publico/js/plugins/imagesloaded.pkgd.min.js',
        '/publico/js/plugins.min.js',
        '/publico/js/custom-script.js',
    )); ?>
    <?= $this->fetch('script'); ?>
</body>

</html>