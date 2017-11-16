<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1><?=$pagina['Pagina']['nombre']?></h1>
        <ul class="bradcrumbs">
          <li><a class="grey-text" href="javascript:history.back(1)">Volver Atrás</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs end-->

<? if (!empty($pagina['Pagina']['imagen'])) : ?>
<!-- Portada -->
<div id="portada">
    <div class="col s12 no-padding">
        <?=$this->Html->image($pagina['Pagina']['imagen']['path'], array('class' => 'col s12')); ?>
    </div>
</div>
<!-- end portada -->
<? endif; ?>

<!-- Cuerpa -->
<div id="cuerpo">
  <div class="container">
    <div class"col s12">
      <?=$pagina['Pagina']['cuerpo']; ?>
    </div>
  </div>
<div>
<!-- end cuerpa -->