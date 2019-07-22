<div class="row">
    <div class="col-md-6 margin-bottom-15">
        <?=  $this->Form->label('actividad_nombre', 'Nombre de la actividad'); ?>
        <div class="detalle">
            <?= (isset($datos[0]['actividad_nombre']) && !empty($datos[0]['actividad_nombre'])) ? $datos[0]['actividad_nombre'] : SIN_INFORMACION;?>
        </div>
    </div>
    <div class="col-md-6 margin-bottom-15">
        <?=  $this->Form->label('fecha', 'Fecha de emisión'); ?>
        <div class="detalle">
            <?= (isset($datos[0]['fecha']) && !empty($datos[0]['fecha'])) ? $datos[0]['fecha']->format("d/m/Y") : SIN_INFORMACION;?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 margin-bottom-15">
        <?=  $this->Form->label('escuela_emision', 'Escuela de emisión'); ?>
        <div class="detalle">
            <?= (isset($datos[0]['escuela_emision']) && !empty($datos[0]['escuela_emision'])) ? $datos[0]['escuela_emision'] : SIN_INFORMACION;?>
        </div>
    </div>
    <div class="col-md-6 margin-bottom-15">
        <?=  $this->Form->label('url', 'URL'); ?>
        <div class="detalle">
            <?= (isset($datos[0]['url']) && !empty($datos[0]['url'])) ? $datos[0]['url'] : SIN_INFORMACION;?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 margin-bottom-15">
        <?=  $this->Form->label('actividad_nombre_archivo', 'Archivo de evidencia'); ?>
        <div class="detalle">
            <?php if(isset($datos[0]['actividad_nombre_archivo']) && !empty($datos[0]['actividad_nombre_archivo'])) {
               echo $datos[0]['actividad_nombre_archivo'];
               echo $this->Html->link(
                       '<span class="fa fa-arrow-down fa-fw bloqueo"></span>',
                        ['controller' => 'Home','action' => 'descargarArchivo',
                            $usuarioId,
                            $datos[0]['actividad_id'],
                            $datos[0]['actividad_nombre_archivo'],
                            ],
                        ['class' => 'btn btn-primary btn-xs margin-right-5 margin-left-5 tooltip-disabled', 'escape' => false, 'data-placement' => 'bottom', 'data-toggle' => 'tooltip', 'title' => 'Descargar archivo']);
             }else{
                echo SIN_INFORMACION;
             }
             ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 margin-bottom-15">
        <?=  $this->Form->label('comentario', 'Comentario'); ?>
        <div class="detalle">
            <?= (isset($datos[0]['comentario']) && !empty($datos[0]['comentario'])) ? $datos[0]['comentario'] : SIN_INFORMACION;?>
        </div>
    </div>
</div>
