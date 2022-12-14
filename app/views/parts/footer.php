<?php /** @var $this \wfm\View */ ?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Версия</b> 1.0
    </div>
    <strong>Система учета затрат физических и юридических лиц  &copy; 2023.</strong> Все права защищены.
</footer>

<div class="logs">
    <?php /* $this->getDbLogs(); */?>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
    const PATH = '<?= PATH ?>';
    const ADMIN = '<?= PATH ?>';
</script>

<!-- jQuery -->
<script src="<?= PATH ?>/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= PATH ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= PATH ?>/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= PATH ?>/adminlte/dist/js/demo.js"></script>
<script src="<?= PATH ?>/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= PATH ?>/adminlte/plugins/select2/js/select2.full.js"></script>
<script src="<?= PATH ?>/adminlte/main.js"></script>
</body>
</html>
