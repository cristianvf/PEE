<?php
echo $this->Html->css(["dependencias/jquery-ui.min.css"]);
echo $this->Form->create(null, [
        'type' => 'post',
        'id' => 'formGuardarActividad',
        'templates' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>'
        ]
    ]);

    if (isset($datos['actividad_id'])&& !empty($datos['actividad_id'])){
         echo $this->Form->hidden('actividad_id',['id' => 'actividad_id', 'value' => $datos['actividad_id']]);
    }
    echo $this->Form->hidden('niv_edu_id',['id' => 'niv_edu_id', 'value' => $idNivelEducativoId]);
?>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <?php
            echo $this->Form->control('actividad_nombre',[
                'label' => [
                     'class' => 'control-label',
                     'text' => 'Nombre del curso'
                 ],
                'id' => 'actividad_nombre',
                'class' => 'form-control',
                'value' =>  (isset($datos['actividad_nombre']) && !empty($datos['actividad_nombre'])) ? $datos['actividad_nombre'] : '',
            ]);
        ?>
    </div>
    <div class="col-xs-12 col-sm-6">
            <?php
                echo $this->Form->control('fecha',[
                    'label' => [
                         'class' => 'control-label',
                         'text' => 'Fecha de emisión'
                     ],
                    'id' => 'fecha',
                    'class' => 'form-control',
                    'value' =>  (isset($datos['fecha']) && !empty($datos['fecha'])) ? $datos['fecha']->format('d/m/Y') : '',
                ]);
            ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <?php
            echo $this->Form->control('escuela_emision',[
                'label' => [
                     'class' => 'control-label',
                     'text' => 'Escuela de emisión'
                 ],
                'id' => 'escuela_emision',
                'class' => 'form-control',
                'value' =>  (isset($datos['escuela_emision']) && !empty($datos['escuela_emision'])) ? $datos['escuela_emision'] : '',
            ]);
        ?>
    </div>
    <div class="col-xs-12 col-sm-6">
            <?php
                echo $this->Form->control('url',[
                    'label' => [
                         'class' => 'control-label',
                         'text' => 'URL'
                     ],
                    'id' => 'url',
                    'class' => 'form-control',
                    'value' =>  (isset($datos['url']) && !empty($datos['url'])) ? $datos['url'] : '',
                ]);
            ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php

        (isset($datos['actividad_nombre_archivo']) && !empty($datos['actividad_nombre_archivo'])) ? $disabled = 'disabled' : $disabled = 'false';

        echo $this->Form->control('actividad_nombre_archivo', [
            'id' =>'act_nombre_archivo',
            'label' => 'Anexo',
            'type' => 'file',
            'class' => 'archivo',
            'disabled' => $disabled
        ]); ?>
        <div class="archivoSubido">
        <?php
        if(!empty($datos['actividad_nombre_archivo'])){
           echo $this->Form->hidden('actividad_nombre_archivo',[
                   'id'=>'actividad_nombre_archivo',
                   'value'=>$datos['actividad_nombre_archivo'],
                   'data-id' => 'actividad_nombre_archivo',
                   'class' => 'archivoActividadOculto']);

           echo $datos['actividad_nombre_archivo'].'&nbsp;&nbsp;&nbsp<br>';

           echo $this->Html->link(
              '<span class="fa fa-arrow-down fa-fw"></span>',
               ['controller' => 'Home','action' => 'descargarArchivo',$usuarioId,$datos['actividad_id'],$datos['actividad_nombre_archivo']],
               ['class' => 'btn btn-primary btn-xs margin-right-5', 'escape' => false, 'title' => 'Descargar archivo.', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom',]
           );

           echo $this->Form->button($this->Html->tag('span', '', array('class' => 'fa fa-lg fa-times')),
              ['class' => 'btn btn-danger btn-xs archivoActividad', 'type' => 'button',
               'title' => 'Eliminar archivo.',
               'data-toggle' => 'tooltip',
               'data-placement' => 'bottom',
               'onclick' => 'eliminarArchivo(this);']);
       }
        ?>
      </div>

    </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <?php
    echo $this->Form->control('comentario',[
        'label' => [
            'class' => 'control-label',
            'text' => 'Comentario'
        ],
        'id' => 'comentario',
        'class' => 'form-control no-resizable',
        'required'=> false,
        'value' => (isset($datos['url']) && !empty($datos['url'])) ? $datos['url'] : '',
        'type' => 'textarea'
    ]);
    ?>
  </div>
</div>
<?= $this->Form->end(); ?>

<?= $this->Html->script(['home/editar',"funciones/funciones.js","dependencias/jquery-ui.min.js"],['block' => 'scriptBottom']); ?>
<?= $this->fetch('scriptBottom') ?>
