

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

<!-- Sliders -->
<? if (!empty($sliders)) : ?>
<div class="slider">
  <ul class="slides">   
  <? foreach ($sliders as $in => $slider) : ?>
      <li>
        <? if (!empty($slider['Banner']['url'])) : ?>
          <a href="<?=$slider['Banner']['url'];?>"><?= $this->Html->image($slider['Banner']['imagen']['slider']); ?></a>
        <? else : ?>
          <?= $this->Html->image($slider['Banner']['imagen']['slider']); ?>
        <? endif; ?>
      </li>   
  <?  endforeach; ?>
  </ul>
</div>
<? endif; ?>
<!-- End slider -->

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