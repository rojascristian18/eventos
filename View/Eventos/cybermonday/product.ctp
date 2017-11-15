<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
    
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1><?=$producto['ProductosIdioma']['name']?></h1>
        <ul class="bradcrumbs">
          <li><a class="grey-text" href="javascript:history.back(1)">Volver Atrás</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!--breadcrumbs end-->

<div id="product">
  <div class="container">
    
    <!-- Producto detail -->
    <div class="row">
      <div class="col s12 m6">
        <div class="img-product-container">
          <? $principal = ''; ?>
          <? $mini = '<div class="row">'; ?>
          <? foreach ($producto['Imagen'] as $i => $imagen) : ?>
          <? if($imagen['cover']) : ?>
          <? $principal = "<div class='cover'>";
             $principal .= $this->Html->image($imagen['Imagen'][0]['url_image_large'], array('class' => 'responsive-img materialboxed'));
             if (isset($producto['Producto']['descuento'])) {
              $principal .= "<a href='#'' class='btn-floating btn-large btn-discount waves-effect waves-light naranjo accent-2'>".$producto['Producto']['descuento']."</a>"; 
             }
             $principal .= "</div>";
          ?>   
          <? endif; ?>
          <?# $mini .= '<div class="mini col s3">';
            # $mini .=  $this->Html->image($imagen['Imagen'][0]['url_image_thumb'], array('class' => 'responsive-img', 'data-full' => $imagen['Imagen'][0]['url_image_large']));
            # $mini .= '</div>'; ?>
          <? endforeach; ?>
          <?=$principal;?>
          <?=$mini;?>
          </div>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="top-info">
          <div class="row">
            <div class="col s6 m6">
              <span class="reference">
                <b><?=__('Referencia:'); ?></b> <?=$producto['Producto']['reference'];?>
              <span>
            </div>
            <div class="col s6 m6">
              <span class="brand">
                <b><?=__('Marca:'); ?></b> 
                <? if(isset($producto['MarcasFabricante']['EventosMarca']['imagen'])) : 
                    echo $this->Html->image( sprintf('/img/EventosMarca/%d/%s', $producto['MarcasFabricante']['EventosMarca']['id'], $producto['MarcasFabricante']['EventosMarca']['imagen']), array('alt' => $producto['MarcasFabricante']['EventosMarca']['nombre'], 'class' => 'responsive-img') );
                  else : 
                    echo 'No especificado';
                  endif; ?>
              <span>
            </div>
          </div>
        </div>

        <!-- Prices -->
        <div class="prices">
          <div class="row">
            <div class="col s6">
              <span class="price-text normal-ptice"><?=__('Precio Normal');?></span>
            </div>
            <div class="col s6 right-align">
              <?=(!empty($producto['Producto']['ahorras'])) ? sprintf('<span class="price-val old-price">%s</span>', CakeNumber::currency($producto['Producto']['valor_iva'], 'CLP')) : sprintf('<span class="price-val price">%s</span>', CakeNumber::currency($producto['Producto']['valor_final'], 'CLP')) ;?>
            </div>
          </div>
          <? if (!empty($producto['Producto']['ahorras'])) : ?>
          <div class="row">
            <div class="col s6">
              <span class="price-text txt-reduced-price"><?=__(sprintf('Precio %s', $todo['Evento']['nombre'])); ?></span>
            </div>
            <div class="col s6 right-align">
              <span class="price-val price"><?=CakeNumber::currency($producto['Producto']['valor_final'], 'CLP')?></span>
            </div>
          </div>

          <div class="row">
            <div class="col s6">
              <span class="price-text"><?=__('Tu ahorras');?>
            </div>
            <div class="col s6 right-align">
              <span class="price-val save"><?=CakeNumber::currency($producto['Producto']['ahorras'], 'CLP')?></span>
            </div>
          </div>
          <? endif; ?>
        </div>
        <!-- end price -->

        <!-- Tabs -->
        <div class="tabs-product">
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
                <li><?=$despacho['descripcion'];?></li>
              <? endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
        <!-- end tabs -->

        <!-- btn more info -->
        <div class="btn-more-info">
          <div class="row">
            <div class="col s12">
              <?=$producto['ProductosIdioma']['description_short']; ?>
            </div>
            <div class="col s12">
              <a class="grey-text text-darken-4 right" id="to-detail"><?=__('<i class="fa fa-list" aria-hidden="true"></i> Más Información');?></a>
            </div>
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
        <!--<?= $this->Form->create('Comprar', array('type' => 'post', 'url' => array('controller' => 'eventos', 'action' => 'redireccionarComercio'), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
        <?= $this->Form->input('url', array('type' => 'hidden', 'value' => $producto['ProductosIdioma']['link_rewrite']));?>
        <?= $this->Form->input('id', array('type' => 'hidden', 'value' => $producto['Producto']['id_product']));?>
          <div class="col s12">
            <div class="quantity-action">
              <span class="btn-remove"><i class="mdi-content-remove"></i></span>--><!--
              --><!--<input data-max="<?=$producto['Producto']['quantity'];?>" class="input-quantity" name="data[Comprar][quantity]" value="1" readonly>--><!--
              --><!--<span class="btn-add"><i class="mdi-content-add"></i></span>
            </div>
            <button class="btn waves-effect waves-light naranjo center-text z-depth-1" id="send-sale" action="submit"><?=__('Comprar este producto');?></button>
          </div>
        <?= $this->Form->end(); ?>-->
          <div class="col s12">
            <a href="<?=$producto['Producto']['url_final'];?>" class="btn waves-effect waves-light naranjo center-text z-depth-1 col s12" action="submit"><?=__('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Comprar este producto');?></a>
          </div>
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
    <!-- end producto detail -->

    <!-- Product Description -->
    <div class="product-description p-info row">
      <div class="col s12">
        <h4 class="sub-title"><?=__('Descripción');?></h4>
      </div>
      <div class="col s12">
        <? if (!empty($producto['ProductosIdioma']['description'])) : ?>
          <?=$producto['ProductosIdioma']['description'];?>
        <? else: ?>
          <? if (!empty($producto['ProductosIdioma']['description_short'])) : ?>
          <?=$producto['ProductosIdioma']['description_short']; ?>
          <? else : ?>
          <label class="grey-text text-lighten-1"><?=__('Sin descripción disponible.')?></label>
          <? endif; ?>
        <? endif; ?>
      </div>
    </div>
    <!-- end product Description -->

    <!-- Product spec -->
    <? if (!empty($producto['Ficha'])) : ?>
    <div class="product-spec p-info row">
      <div class="col s12">
        <h4 class="sub-title"><?=__('Ficha técnica');?></h4>
      </div>
      <div class="col s12">
        <table class="striped">
          <? foreach ($producto['Ficha'] as $f => $spec) : ?>
            <tr>
              <th><?=$spec['nombre']?></th>
              <td><?=$spec['valor']?></td>
            </tr>
          <? endforeach; ?>
        </table>
      </div>
    </div>
    <? endif; ?>
    <!-- end Product spec -->

    <!-- Additional info -->
    <? if (!empty($todo['Evento']['informacion_adicional_productos'])) : ?>
    <div class="additional-info p-info row">
      <div class="col s12">
        <h4 class="sub-title"><?=__('Información adicional');?></h4>
      </div>
      <div class="col s12 text-lighten-1">
        <?=$this->Text->autoParagraph($todo['Evento']['informacion_adicional_productos']); ?>
      </div>
    </div>
    <? endif; ?>
    <!-- end Product spec -->
  </div>
</div>