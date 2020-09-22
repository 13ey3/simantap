<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('_block/header'); ?>

  <script>
    const base_url = '<?= base_url() ?>';
  </script>
</head>
<?php
if ($layout == 1) {
?>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php $this->load->view('_block/sidebar'); ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?php $this->load->view('_block/topbar'); ?>
          <!-- End of Topbar -->
          <!-- Begin Page Content -->
          <?php $this->load->view($content) ?>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php $this->load->view('_block/footer'); ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  <?php
  //  Logout Modal
  $this->load->view('_block/logout_modal');
} elseif ($layout == 2) {
  ?>

    <body class="bg-gradient-info">
      <div class="container">
        <?php $this->load->view($content); ?>
      </div>
    <?php
  }
  // js Librarry
  $this->load->view('_block/js_lib');
  !empty($custom_js) ? $this->load->view($custom_js) : '';
    ?>

    </body>

</html>