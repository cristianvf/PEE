<script>
  var urlEditarActividad = '<?php echo $this->Url->build(["controller" => "Home", "action" => "editar"]); ?>';
  var urlGuardarActividad = '<?php echo $this->Url->build(["controller" => "Home", "action" => "guardar"]) ?>';
  var urlListarActividad = '<?php echo $this->Url->build(["controller" => "Home", "action" => "listar"]) ?>';
  var urlDetalleActividad = '<?php echo $this->Url->build(["controller" => "Home", "action" => "detalle"]) ?>';
  var urlEliminarActividad = '<?php echo $this->Url->build(["controller" => "Home", "action" => "eliminar"]) ?>';
  var MSG_BORRAR_ACTIVIDAD = '<?= MSG_BORRAR_ACTIVIDAD ?>';
  var TITULO_ELIMINAR_ACTIVIDAD = '<?= TITULO_ELIMINAR_ACTIVIDAD ?>';
  var idNivelEducativo = <?= $idNivelEducativo ?>
</script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $titulo ?></h1>
    </div>
</div>

<div class="row margin-top-20">
    <div class="col-md-12">
        <?php
          echo $this->Form->button('Registrar actividad', ['escape' => false,
             'class' => 'btn btn-md btn-success btn-right',
             'id' => 'btnRegistrarActividad',
             'onclick' => 'modalRegistrarActividad();',
             'type' => 'button']);

       ?>
    </div>
</div>

<div id="listado-actividades" class="margin-top-20"></div>
<?= $this->element("Modals/large", array('modalId' => 'modalEditarActividad')); ?>
<?= $this->element("Modals/large", array('modalId' => 'modalDetalleActividad')); ?>
<?= $this->element("Modals/small", array('modalId' => 'modalEliminarActividad')); ?>

<?= $this->Html->script('home/main'); ?>
