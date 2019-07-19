<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portafolio de evidencias educativa</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?= $this->Html->css(['dependencias/bootstrap.min.css','dependencias/font-awesome.min.css','dependencias/ionicons.min.css',
  'dependencias/AdminLTE.min.css','dependencias/skin-blue.min.css','pee.css','dependencias/pnotify.custom.min.css']); ?>
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 <?= $this->Html->script(['dependencias/jquery.min.js','dependencias/bootstrap.min.js','dependencias/adminlte.min.js','dependencias/pnotify.custom.min.js']); ?>
  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>

  <script>
    var NIVEL_EDUCATIVO_SECUNDARIA = <?= NIVEL_EDUCATIVO_SECUNDARIA ?>;
    var NIVEL_EDUCATIVO_BACHILLERATO = <?= NIVEL_EDUCATIVO_BACHILLERATO ?>;
    var NIVEL_EDUCATIVO_UNIVERSIDAD = <?= NIVEL_EDUCATIVO_UNIVERSIDAD ?>;
    var NOTIFY_SUCCESS = '<?= NOTIFY_SUCCESS ?>';
    var NOTIFY_ERROR = '<?= NOTIFY_ERROR ?>';
    var TITLE_NOTIFY_SUCCESS = '<?= TITLE_NOTIFY_SUCCESS ?>';
    var TITLE_NOTIFY_ERROR = '<?= TITLE_NOTIFY_ERROR ?>';
    var MSG_ERROR_DEFAULT = '<?= MSG_ERROR_DEFAULT ?>';
  </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a  class="logo">
      <span class="logo-mini"><b>PEE</b></span>
      <span class="logo-lg">Portafolio</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">

      </div>
    </nav>
  </header>
  <aside class="main-sidebar">

    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="menu-sec active">
          <?= $this->Html->link('<i class="fa fa-book"></i><span>Secundaria</span>',
          ['controller' => 'Home', 'action'=>'index',NIVEL_EDUCATIVO_SECUNDARIA],['escape' => false]); ?>
        </li>
        <li class="menu-bach">
          <?= $this->Html->link('<i class="fa fa-graduation-cap"></i><span>Bachillerato</span>',
          ['controller' => 'Home', 'action'=>'index',NIVEL_EDUCATIVO_BACHILLERATO],['escape' => false]); ?>
        </li>
        <li class="menu-uni">
          <?= $this->Html->link('<i class="fa fa-university"></i><span>Universidad</span>',
          ['controller' => 'Home', 'action'=>'index',NIVEL_EDUCATIVO_UNIVERSIDAD],['escape' => false]); ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-sign-out"></i><span>Cerrar Sesión</span>',
          [],['escape' => false]); ?>
        </li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
      <?= $this->Flash->render() ?>
      <!-- Main content -->
      <section class="content">
          <?= $this->fetch('content') ?>
      </section>
      <!-- /.content -->
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>


  <div class="control-sidebar-bg"></div>
  </div>
  <?= $this->Html->script(['funciones/funciones.js']); ?>

  </script>

</body>
</html>
