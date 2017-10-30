

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1><?=$todo['Evento']['nombre']?></h1>
        <? if (!empty($todo['Evento']['subtitulo'])) : ?>
        <h5>
            <?=$todo['Evento']['subtitulo'];?>
        </h5>
        <? endif; ?>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs end-->


<? if (!empty($todo['Evento']['imagen_portada'])) : ?>
<!-- Portada -->
<div class="container">
    <div class="row">
        <div class="col s12">
            <?=$this->Html->image($todo['Evento']['imagen_portada']['path'], array('class' => 'col s12')); ?>
        </div>
    <div>
</div>
<!-- end portada -->
<? endif; ?>

<!--start container-->
<div class="container">
  <div class="section">
    <!-- statr products list -->
    <div id="products" class="row">
        <div class="product-sizer"></div>

        <? foreach ($todo['Producto'] as $i => $producto) : ?>
            <?=$this->element( sprintf('%s/producto_lista', $todo['Evento']['subdomino']), array('producto' => $producto) ); ?>
        <? endforeach; ?>


        <!-- Productos AJAX -->
    </div>
    <!--/ end items list -->
  </div>
  <!-- Floating Action Button -->
    <div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
        <a class="btn-floating btn-large">
          <i class="mdi-action-stars"></i>
        </a>
        <ul>
          <li><a href="css-helpers.html" class="btn-floating red"><i class="large mdi-communication-live-help"></i></a></li>
          <li><a href="app-widget.html" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
          <li><a href="app-calendar.html" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
          <li><a href="app-email.html" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
        </ul>
    </div>
    <!-- Floating Action Button -->
</div>
<!--end container-->
