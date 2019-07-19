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
    <?= $this->Form->create(null,['url' => ['controller' => 'Aut', 'action' => 'login'],'type'=> 'post']) ?>

      <div class="input-container">
        <input type="text" id="usuario_correo" name="usuario_correo" required="required"/>
        <label for="usuario_correo">Correo Electrónico</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="usuario_password" name="usuario_password" required="required"/>
        <label for="usuario_password">Contraseña</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
      <?= $this->Form->button(__('INICIAR SESIÓN')); ?>     
     </div>
    <?= $this->Form->end() ?>
    </div>

</div>