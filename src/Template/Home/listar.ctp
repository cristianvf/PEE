<?php if ($countListado > SIN_REGISTROS) { ?>
  <div class="table-responsive margin-top-5">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr class="ajax-pagination icono-titulo">
                    <th style="min-width: 160px">Acciones</th>
                    <th style="width:40%"><?= $this->Paginator->sort('actividad_nombre', 'Nombre del curso'); ?></th>
                    <th style="width:10%"><?= $this->Paginator->sort('fecha', 'Fecha de emisión'); ?></th>
                    <th style="width:10%"><?= $this->Paginator->sort('escuela_emision', 'Escuela de emisión'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listadoActividades as $dato): ?>
                    <tr>
                        <td class="text-center">
                          <?php
                          $btn['editar']['onclick'] = 'modalEditarActividad('.$dato['actividad_id'].');';
                          $btn['editar']['title'] = "Para editar los datos de la actividad, haga clic aquí.";
                          $btn['detalle']['onclick'] = 'modalDetalleActividad('.$dato['actividad_id'].');';
                          $btn['detalle']['title'] = "Para ver el detalle de la actividad, haga clic aquí.";
                          $btn['eliminar']['onclick'] = 'eliminarActividad('.$dato['actividad_id'].');';
                          $btn['eliminar']['title'] = "Para eliminar la actividad, haga clic aquí.";

                          echo $this->Html->tag('span', $this->Form->button($this->Html->tag('span', '', ['class' => 'fa fa-pencil fa-fw']), [
                                  'class' => 'btn btn-primary btn-sm margin-right-5',
                                  'id' => 'btn-editar',
                                  'type' => 'button',
                                  'onclick' => $btn['editar']['onclick']]),
                                  ['class' => 'tooltip-disabled', 'data-placement' => 'top', 'data-toggle' => 'tooltip', 'title' => $btn['editar']['title']]);

                          echo $this->Html->tag('span', $this->Form->button($this->Html->tag('span', '', ['class' => 'fa fa-search fa-fw']), [
                                  'class' => 'btn btn-info btn-sm margin-right-5',
                                  'id' => 'btn-detalle',
                                  'type' => 'button',
                                  'onclick' => $btn['detalle']['onclick']]),
                                  ['class' => 'tooltip-disabled', 'data-placement' => 'top', 'data-toggle' => 'tooltip', 'title' =>   $btn['detalle']['title'] ]);

                          echo $this->Html->tag('span', $this->Form->button($this->Html->tag('span', '', ['class' => 'fa fa-trash-o fa-fw']), [
                                  'class' => 'btn btn-danger btn-sm margin-right-5',
                                  'id' => 'btn-eliminar',
                                  'type' => 'button',
                                  'onclick' => $btn['eliminar']['onclick']]),
                                  ['class' => 'tooltip-disabled', 'data-placement' => 'top', 'data-toggle' => 'tooltip', 'title' =>   $btn['eliminar']['title'] ]);
                            ?>
                        </td>
                        <td><?= h($dato["actividad_nombre"]) ?></td>
                        <td><?= h($dato["fecha"]) ?> </td>
                        <td><?= h($dato["escuela_emision"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <div class="row">
        <div class="col-xs-12 simbologia">
            <ul class="list-unstyled">
                <li class="margin-bottom-5"><?= '<strong>Simbolog&iacute;a</strong>'?></li>

                <li class="margin-bottom-5"><?= $this->Form->button('<span class="fa fa-pencil fa-fw"></span>', array(
                    'class' => 'btn btn-primary btn-xs margin-right-5', 'type' => 'button',
                    'escapeTitle' => false)) . 'Editar actividad'?>
                </li>
                <li class="margin-bottom-5"><?= $this->Form->button('<span class="fa fa-search fa-fw"></span>', array(
                    'class' => 'btn btn-info btn-xs margin-right-5', 'type' => 'button',
                    'escapeTitle' => false)) . 'Detalle de la actividad'?>
                </li>
                <li class="margin-bottom-5"><?= $this->Form->button('<span class="fa fa-trash-o fa-fw"></span>', array(
                    'class' => 'btn btn-danger btn-xs margin-right-5', 'type' => 'button',
                    'escapeTitle' => false)) . 'Eliminar actividad'?>
                </li>
            </ul>
        </div>
    </div>




<?php } else{
  echo '<div class="row margin-top-20">';
  echo '<div class="col-md-12">';
  echo $this->element('Avisos/warning', array('message' => MSG_SIN_REGISTROS));
  echo '</div>';
  echo '</div>';
}
