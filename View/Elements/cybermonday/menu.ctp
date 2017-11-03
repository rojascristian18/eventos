<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="bold <?= ($this->Html->menuActivo(array('controller' => 'eventos', 'action' => 'index')) ? 'active' : ''); ?>">
            <?=$this->Html->link(
                sprintf('<i class="mdi-action-home"></i> %s', $todo['Evento']['nombre']), 
                array('controller' => 'eventos', 'action' => 'index'), 
                array('class' => 'waves-effect waves-grey lighten-5', 'escape' => false)
            );?></li>
        <li class="li-hover"><div class="divider"></div></li>
        <? if (!empty($todo['Categoria'])) : ?>
            <? foreach ($todo['Categoria'] as $ix => $categoria) : ?>
                <? if (empty($categoria['ChildCategoria']) && empty($categoria['Categoria']['parent_id']) ) : ?>
                <li class="bold <?= ($this->Html->menuParam($categoria['Categoria']['nombre_corto']) ? 'active' : ''); ?>">
                    <?=$this->Html->link(
                        sprintf('%s %s', $this->Html->image($categoria['Categoria']['icono_imagen']['path'], array('class' => 'icono-menu')) , $categoria['Categoria']['icono_texto']), 
                        array('controller' => 'categorias', 'action' => 'view', 'slug' => $categoria['Categoria']['nombre_corto']),
                        array('escape' => false));?>
                </li>
                <? elseif (empty($categoria['Categoria']['parent_id'])) : ?>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold">
                            <a class="collapsible-header waves-effect"><?= $this->Html->image($categoria['Categoria']['icono_imagen']['path'], array('class' => 'icono-menu')); ?> <?=$categoria['Categoria']['icono_texto']; ?></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li class="<?= ($this->Html->menuParam($categoria['Categoria']['nombre_corto']) ? 'active' : ''); ?>">
                                        <?=$this->Html->link(
                                        sprintf('%s %s', $this->Html->image($categoria['Categoria']['icono_imagen']['path'], array('class' => 'icono-menu')) , $categoria['Categoria']['icono_texto'] ), 
                                        array('controller' => 'categorias', 'action' => 'view', 'slug' => $categoria['Categoria']['nombre_corto']),
                                        array('escape' => false));?>
                                    </li>
                                    <? foreach ($categoria['ChildCategoria'] as $ich => $hijo) : ?>
                                    <li class="<?= ($this->Html->menuParam($hijo['nombre_corto']) ? 'active' : ''); ?>">
                                        <?=$this->Html->link(
                                        sprintf('%s %s', $this->Html->image(sprintf('Categoria/%d/%s', $hijo['id'], $hijo['icono_imagen']), array('class' => 'icono-menu')) , $hijo['icono_texto']), 
                                        array('controller' => 'categorias', 'action' => 'view', 'slug' => $hijo['nombre_corto']),
                                        array('escape' => false));?>
                                    </li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <? endif; ?>
            <? endforeach; ?>
        <? endif; ?>
    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only naranjo"><i class="mdi-navigation-menu"></i></a>
</aside>
<!-- END LEFT SIDEBAR NAV-->