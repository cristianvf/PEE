<?= $this->Html->css(['Aut/Aut.css']); ?>
<?= $this->Html->script(['Aut/main.js']); ?>
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Portafolio de Evidencias Estudiantil</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Inicio de sesión</h1>
    <?= $this->Form->create() ?>

      <div class="input-container">
        <input type="#{type}" id="#{label}" name="usuario_correo" required="required"/>
        <label for="#{label}">Correo Electrónico</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="#{type}" id="#{label}" name="usuario_password" required="required"/>
        <label for="#{label}">Contraseña</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
      <?= $this->Form->button(__('INICIAR SESIÓN')); ?>     
     </div>
    <?= $this->Form->end() ?>
    </div>

</div>