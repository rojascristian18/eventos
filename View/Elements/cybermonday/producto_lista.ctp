<div class="product col s6 m25">
    <div class="card hoverable">
        <div class="card-image waves-effect waves-block waves-light">
            <? if (isset($producto['Producto']['descuento']) ) : ?>
                <a href="#" class="btn-floating btn-price waves-effect waves-light naranjo accent-2"><?=$producto['Producto']['descuento']?></a>
            <? endif; ?>
            
            <a href="">
            <? if (!empty($producto['Imagen'])) : ?>
            <? foreach ($producto['Imagen'] as $im => $imagen) : ?>
                <? if ($imagen['cover']) : ?>
                    <?=$this->Html->image($imagen['Imagen'][0]['url_image_thumb'], array('class' => 'responsive-img image-product'));?>
                <? endif; ?>
            <? endforeach; ?>
            <? else : ?>
                <img src="https://dummyimage.com/250x250/f2f2f2/4a4a4a&text=No+disponible" alt="product-img">
            <? endif; ?>
            </a>
        </div>
        <ul class="card-action-buttons">
            <li>
                <?=$this->Html->link('<i class="mdi-action-shopping-cart"></i>', array('controller' => 'eventos', 'action' => 'product', 'slug' => sprintf('%s-%s', $producto['ProductosIdioma']['link_rewrite'], $producto['Producto']['id_product'])), array('class' => 'btn-floating waves-effect waves-light naranjo', 'escape' => false)); ?>
            </li>
        </ul>
        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">
                    	<?=$this->Text->truncate(
						    $producto['ProductosIdioma']['name'],
						    50,
						    array(
						        'ellipsis' => '...',
						        'exact' => false
						    )
						); ?></a>
                    </p>
                </div>
                <div class="col s12 marca">
                    <? if (isset($producto['MarcasFabricante'])) : ?>
                    <?=$this->Html->image( sprintf('/img/EventosMarca/%d/%s', $producto['MarcasFabricante']['EventosMarca']['id'], $producto['MarcasFabricante']['EventosMarca']['imagen']), array('alt' => $producto['MarcasFabricante']['EventosMarca']['nombre'], 'class' => 'responsive-img') );?>
                    <? endif; ?>
                </div>

                <? if (isset($producto['Producto']['descuento'])) : ?>
                    <div class="col s12 price-content">
                        <span class="price text-naranjo"><?= CakeNumber::currency($producto['Producto']['valor_final'], 'CLP'); ?></span>
                        <span class="old-price grey-text lighten-1"><?= CakeNumber::currency($producto['Producto']['valor_iva'], 'CLP'); ?></span>
                    </div>
                <? else : ?>
                    <div class="col s12 price-content">
                        <span class="price text-naranjo"><?= CakeNumber::currency($producto['Producto']['valor_final'], 'CLP'); ?></span>
                        <span class="old-price"></span>
                    </div>
                <? endif; ?>

                <!-- Cuotas -->
                <? if ($todo['Evento']['mostrar_cuotas'] && !empty($todo['Evento']['cantidad_cuotas']) ) : ?>
                <div class="col s12">
                    <span class="cuotas">
                        <?=$cuota = ($todo['Evento']['cantidad_cuotas'] > 1) ? sprintf('%d cuotas sin interés de <br>%s', $todo['Evento']['cantidad_cuotas'], $this->Html->calcularCuota($todo['Evento']['cantidad_cuotas'], $producto['Producto']['valor_final'])) : ''; ?> 
                    </span>
                </div>
                <? endif;  ?>

                <!-- Stock -->
                <div class="col s12">
                <? if ($producto['Producto']['quantity'] > 0) : ?>
                    <span class="en-stock grey-text darken-1">En Stock</span>
                <? else : ?>
                    <span class="en-stock grey-text darken-1">Agotado</span>
                <? endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>