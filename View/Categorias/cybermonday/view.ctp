

<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1><?=$categoria['Categoria']['nombre']?></h1>
        <? #=$this->element( sprintf('%s/breadcrumbs', $todo['Evento']['nombre_tema']) ); ?>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs end-->


<? if (!empty($categoria['Categoria']['imagen_principal'])) : ?>
<!-- Portada -->
<div id="portada">
    <div class="col s12 no-padding">
        <?=$this->Html->image($categoria['Categoria']['imagen_principal']['path'], array('class' => 'col s12')); ?>
    </div>
</div>
<!-- end portada -->
<? endif; ?>

<!-- Filtro -->
<?=$this->element( sprintf('%s/filtro', $todo['Evento']['nombre_tema']) ); ?>
<!-- end filtro -->

<!--start container-->
<div class="container">
  <div class="section">
    <!-- statr products list -->
    <div id="products" class="row">
        <!-- Productos AJAX -->
    </div>
    <!--/ end items list -->
  </div>
</div>
<!--end container-->