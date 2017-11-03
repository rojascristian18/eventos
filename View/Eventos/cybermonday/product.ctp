<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1><?=$producto['ProductosIdioma']['name']?></h1>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs end-->

<div id="product">
  <div class="container">
    <div class="row">
      <div class="col s12 m5">
        <div class="img-product-container">
          <? $principal = ''; ?>
          <? $mini = '<div class="row">'; ?>
          <? foreach ($producto['Imagen'] as $i => $imagen) : ?>
          <? if($imagen['cover']) : ?>
          <? $principal = "<div class='cover'>";
             $principal .= $this->Html->image($imagen['Imagen'][0]['url_image_large'], array('class' => 'responsive-img materialboxed'));
             if (isset($producto['Producto']['descuento'])) {
              $principal .= "<a href='#'' class='btn-floating btn-large btn-price waves-effect waves-light naranjo accent-2'>".$producto['Producto']['descuento']."</a>"; 
             }
             $principal .= "</div>";
          ?>   
          <? else : ?>
          <? $mini .= '<div class="mini col s3">';
             $mini .=  $this->Html->image($imagen['Imagen'][0]['url_image_large'], array('class' => 'responsive-img'));
             $mini .= '</div>'; ?>
          <? endif; ?>
          <? endforeach; ?>
          <?=$principal;?>
          <?=$mini;?>
          </div>
        </div>
      </div>
      <div class="col s12 m7">
        <div class="row">
          <div class="col s12 m6">
            <span class="reference">
              <b><?=__('Referencia:'); ?></b> <?=$producto['Producto']['reference'];?>
            <span>
          </div>
          <div class="col s12 m6">
            <span class="brand">
              <b><?=__('Marca:'); ?></b> <?=$producto['MarcasFabricante']['EventosMarca']['nombre'];?>
            <span>
          </div>
        </div>

        <!-- Prices -->
        <div class="row">
          <div class="col s6">
            <?=__('Precio Normal');?>
          </div>
          <div class="col s6 right-align">
            <?=(!empty($producto['Producto']['ahorras'])) ? sprintf('<span class="old-price">%s</span>', CakeNumber::currency($producto['Producto']['valor_iva'], 'CLP')) : sprintf('<span class="price">%s</span>', CakeNumber::currency($producto['Producto']['valor_final'], 'CLP')) ;?>
          </div>
        </div>
        <? if (!empty($producto['Producto']['ahorras'])) : ?>
        <div class="row">
          <div class="col s6">
            <span class="txt-reduced-price"><?=__(sprintf('Precio %s', $todo['Evento']['nombre'])); ?></span>
          </div>
          <div class="col s6 right-align">
            <span class="price"><?=CakeNumber::currency($producto['Producto']['valor_final'], 'CLP')?></span>
          </div>
        </div>

        <div class="row">
          <div class="col s6">
            <?=__('Ahorras');?>
          </div>
          <div class="col s6 right-align">
            <span class="save"><?=CakeNumber::currency($producto['Producto']['ahorras'], 'CLP')?></span>
          </div>
        </div>
        <? endif; ?>
        <!-- end price -->

        <!-- Tabs -->
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s3"><a class="active" href="#pago"><?=__('Opciones de pago');?></a></li>
              <li class="tab col s3"><a href="#despacho">Opciones de despacho</a></li>
            </ul>
          </div>
          <div id="pago" class="col s12">
            <ul>
            <? foreach ($todo['Pago'] as $ip => $pago) : ?>
            <? if ($todo['Evento']['mostrar_cuotas'] && !empty($todo['Evento']['cantidad_cuotas'])) : ?>
              <? $txtCuotas = strpos($pago['descripcion'], '{{cuota}}'); ?>
              <? $txtMonto = strpos($pago['descripcion'], '{{monto}}'); ?>
              <? if( $txtCuotas !== false && $txtMonto !== false ) : ?>
                  <li><?  
                    $pago['descripcion'] = str_replace('{{cuota}}', $todo['Evento']['cantidad_cuotas'], $pago['descripcion']);
                    $cuotasmonto = ($producto['Producto']['valor_final'] / $todo['Evento']['cantidad_cuotas']);
                    $pago['descripcion'] = str_replace('{{monto}}', CakeNumber::currency($cuotasmonto, 'CLP'), $pago['descripcion']);
                    
                    echo $pago['descripcion'];
                    ?></li>
              <? else : ?>
                  <li><?= $pago['descripcion']; ?></li>
              <? endif; ?>
            <? else : ?>
              <? $txtCuotas = strpos($pago['descripcion'], '{{cuota}}'); ?>
              <? $txtMonto = strpos($pago['descripcion'], '{{monto}}'); ?>
              <? if( $txtCuotas === false && $txtMonto === false ) : ?>
                  <li><?= $pago['descripcion']; ?></li>
              <? endif; ?>
            <? endif; ?>
              
            <? endforeach; ?>
            </ul>
          </div>
          <div id="despacho" class="col s12">
            <ul>
            <? foreach ($todo['Despacho'] as $id => $despacho) : ?>
              <li><b><?=$despacho['nombre'];?>:</b> <?=$despacho['descripcion'];?></li>
            <? endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- end tabs -->

        <!-- btn more info -->
        <div class="row">
          <div class="col s12">
            <button class="btn col s12 waves-effect waves-light grey lighten-4 center-text grey-text text-darken-4 z-depth-0" id="to-detail"><i class="mdi-action-list"></i> <?=__('Ver Descripción');?></button>
          </div>
        </div>
        <!-- end btn -->

        <!-- Stock & buy -->
        
        <? if ($producto['Producto']['quantity'] > 0) : ?>

        <div class="row">
          <div class="col s12">
            <span class="stock grey-text text-lighten-1"><?= $producto['Producto']['quantity']; ?> <?=__('en stock');?></span>
          </div>
        </div>

        <div class="row">
        <?= $this->Form->create('Comprar', array('type' => 'get', 'url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action']), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
          <div class="col s12">
            <div class="quantity-action">
              <span class="btn-add"><i class="mdi-content-add"></i></span>
              <input class="input-quantity">
              <span class="btn-add"><i class="mdi-content-remove"></i></span>
            </div>
            <button class="btn waves-effect waves-light naranjo center-text z-depth-1" id="send-sale" action="submit"><?=__('Comprar este producto');?></button>
          </div>
        <?= $this->Form->end(); ?>
        </div>
      <? else : ?>
      <div class="row">
        <div class="col s12">
          <div class="card-panel grey lighten-2"><?=__('Sin stock disponible');?></div>
        </div>
      </div>
      <? endif; ?>

        <!-- end Stock & buy -->

      </div>
    </div>
  </div>
</div>