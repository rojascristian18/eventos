<a href="#"><span class="fa fa-tasks"></span></a>
<div class="informer informer-warning"><?= $contTareas = (!empty($tareasNotificacion)) ? count($tareasNotificacion) : 0 ; ?></div>
<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-tasks"></span> Tareas a revisar</h3>
        <div class="pull-right">
            <span class="label label-warning"><?=$contTareas = (!empty($tareasNotificacion)) ? count(Hash::extract($tareasNotificacion, '{n}.Tarea.en_revision') ) . ' tarea en revisión' : '0 tareas en revisión' ; ?></span>
        </div>
    </div>
    <div class="panel-body list-group scroll" style="height: 200px;">
    <? foreach ($tareasNotificacion as $index => $tarea) : ?>
        <? $progressBar = ''; ?>
        <? if ( $tarea['Tarea']['porcentaje_realizado'] < 50 ) : ?>
            <?  
                $progressBar = '<div class="progress progress-small progress-striped active">';
                $progressBar .= '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="' . $tarea['Tarea']['porcentaje_realizado'] . '"';
                $progressBar .= 'aria-valuemin="0" aria-valuemax="100" style="width: ' . $tarea['Tarea']['porcentaje_realizado'] . '%;">';
                $progressBar .= $tarea['Tarea']['porcentaje_realizado'].'%</div>';
                $progressBar .= '</div>';
            ?>
        <? endif; ?>
        <? if ( $tarea['Tarea']['porcentaje_realizado'] >= 50 && $tarea['Tarea']['porcentaje_realizado'] < 100 ) : ?>
            <?  
                $progressBar = '<div class="progress progress-small progress-striped active">';
                $progressBar .= '<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="' . $tarea['Tarea']['porcentaje_realizado'] . '"';
                $progressBar .= 'aria-valuemin="0" aria-valuemax="100" style="width: ' . $tarea['Tarea']['porcentaje_realizado'] . '%;">';
                $progressBar .= $tarea['Tarea']['porcentaje_realizado'].'%</div>';
                $progressBar .= '</div>';
            ?>
        <? endif; ?>
        <? if ( $tarea['Tarea']['porcentaje_realizado'] == 100 ) : ?>
            <?  
                $progressBar = '<div class="progress progress-small progress-striped active">';
                $progressBar .= '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . $tarea['Tarea']['porcentaje_realizado'] . '"';
                $progressBar .= 'aria-valuemin="0" aria-valuemax="100" style="width: ' . $tarea['Tarea']['porcentaje_realizado'] . '%;">';
                $progressBar .= $tarea['Tarea']['porcentaje_realizado'].'%</div>';
                $progressBar .= '</div>';
            ?>
        <? endif; ?>
        	<?=$this->Html->link(
        		'<strong>['.$tarea['Tienda']['nombre'].'] '.$tarea['Tarea']['nombre'].'</strong>'
                . $progressBar .
                '<small class="text-muted">'.$tarea['Usuario']['nombre'].' <'.$tarea['Usuario']['email'].'>, '.$this->Time->format($tarea['Tarea']['created'], '%e de %m, %Y').' / '.$tarea['Tarea']['porcentaje_realizado'].'% completado</small>', 
                array('controller' => 'tareas', 'action' => 'edit', $tarea['Tarea']['id']), array('escape' => false, 'class' => 'list-group-item')); ?>
    <? endforeach; ?>
    </div>
    <div class="panel-footer text-center">
        <?=$this->Html->link('Mostrar todas', array('controller' => 'tareas', 'action' => 'index')); ?>
    </div>
</div>


