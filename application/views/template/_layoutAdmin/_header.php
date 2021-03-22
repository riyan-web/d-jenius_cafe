<header class="main-header">
  <!-- Logo -->
  <a href="<?= base_url(); ?>dashboard" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><small>Kedai</small></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Kedai Happy </b> Memory</span>
  </a>
  <?php date_default_timezone_set('Asia/Jakarta'); ?>

  <!-- nav -->
  <?= @$_nav; ?>
</header>