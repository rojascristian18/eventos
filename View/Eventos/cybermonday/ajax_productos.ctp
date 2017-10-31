
<? foreach ($productos as $i => $producto) : ?>
    <?=$this->element( sprintf('%s/producto_lista', $todo['Evento']['nombre_tema']), array('producto' => $producto) ); ?>
<? endforeach; ?>