<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title><?=$todo['Evento']['nombre'];?> en <?=$todo['Tienda']['nombre']; ?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?= $this->webroot . 'img/' . $todo['Evento']['favicon']['favicon'];?>" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= $this->webroot . 'img/' . $todo['Evento']['favicon']['apple'];?>">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= $this->webroot . 'img/' . $todo['Evento']['favicon']['window'];?>">
    <!-- For Windows Phone -->
    
    <!-- CORE CSS--> 
    <?= $this->Html->css(sprintf('/%s/css/materialize.min.css', $todo['Evento']['nombre_tema']), array('media' => 'screen,projection')); ?>
    <?= $this->Html->css(sprintf('/%s/css/style.css', $todo['Evento']['nombre_tema']), array('media' => 'screen,projection')); ?>

    <!-- Custome CSS-->    
    <?= $this->Html->css(sprintf('/%s/css/custom/custom.css', $todo['Evento']['nombre_tema']), array('media' => 'screen,projection')); ?>

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <!--<?= $this->Html->css(sprintf('/%s/js/plugins/perfect-scrollbar/perfect-scrollbar.css', $todo['Evento']['nombre_tema']), array('media' => 'screen,projection')); ?>
    <link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="/eventos/webroot/DESKTOP-9COL73V/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">-->
    <?= $this->fetch('css'); ?>

    <?= $this->Html->scriptBlock("var webroot = '{$this->webroot}';"); ?>
    <?= $this->Html->scriptBlock("var fullwebroot = '{$this->Html->url('', true)}';"); ?>
    
    <script type="text/javascript">
        var productosJson = <?=$todo['Producto']['json'];?>
    </script>
</head>

<body>
    <!-- Start Page Loading 
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>-->
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <?=$this->element( sprintf('%s/header', $todo['Evento']['nombre_tema']) ); ?>
    

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <?=$this->element( sprintf('%s/menu', $todo['Evento']['nombre_tema']) ); ?>

            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START CONTENT -->
            <section id="content">
                <!-- Search for small screen -->
                <div class="header-search-wrapper grey hide-on-large-only">
                <?= $this->Form->create('Buscar', array('type' => 'get', 'url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action']), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
                    <i class="mdi-action-search active"></i>
                    <input type="text" name="b" class="header-search-input z-depth-2" placeholder="Busca tu herramienta o accesorio">
                <?= $this->Form->end(); ?>
                </div>

                <?= $this->fetch('content'); ?>
            
            </section>
            <!-- END CONTENT -->

            <!-- Floating Action Button -->
            <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
                <a class="btn-floating btn-large yellow darken-3 pulse">
                  <?=$this->Html->image(sprintf('/%s/images/ayuda-icono.png', $todo['Evento']['nombre_tema']), array('class' => 'icono-ayuda'));?>
                </a>
                <ul>
                  <li>
                    <a href="tel:<?=$todo['Evento']['fono'];?>" class="btn-floating red"><i class="large mdi-communication-phone"></i></a>
                  <li>
                    <a href="mailto:<?=$todo['Evento']['email'];?>" class="btn-floating blue"><i class="large mdi-communication-email"></i></a>
                  </li>
                  <li>
                    <a href="https://api.whatsapp.com/send?phone=+56942077596" class="btn-floating green"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                  </li>
                </ul>
            </div>
            <!-- Floating Action Button -->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?=$this->element( sprintf('%s/footer', $todo['Evento']['nombre_tema']) ); ?>


    <?= $this->Html->script(array(
        sprintf('/%s/js/plugins/jquery-1.11.2.min.js', $todo['Evento']['nombre_tema']),
        sprintf('/%s/js/materialize.min.js', $todo['Evento']['nombre_tema']),
        sprintf('/%s/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js', $todo['Evento']['nombre_tema']),
        sprintf('/%s/js/custom-script.js', $todo['Evento']['nombre_tema']),
    )); ?>
    <?= $this->fetch('script'); ?>

    <!-- Custome CSS-->    
    <?= $this->Html->css(sprintf('/%s/css/font-awesome.css', $todo['Evento']['nombre_tema']), array('media' => 'screen,projection')); ?>
</body>

</html>