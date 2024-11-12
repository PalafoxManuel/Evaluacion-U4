<?php 
  include_once "../../app/config.php";
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <?php 

      include "../layouts/head.php";
    ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <?php 

    include "../layouts/sidebar.php";

  ?>

  <?php 

    include "../layouts/nav.php";

  ?>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>products">Productos</a></li>
                  <li class="breadcrumb-item" aria-current="page">Tabla ordenes</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Tabla ordenes</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card table-card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover tbl-product" id="pc-dt-simple">
                    <thead>
                      <tr>
                        <th>Detalle de la orden</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="row">
                            <div class="col">
                              <h6 class="mb-1">Sennheiser HD 450BT Wireless</h6>
                              <p class="text-muted f-12 mb-0">Noise-cancelling, Bluetooth 5.0, Over-ear</p>
                            </div>
                          </div>
                        </td>
                        <td></td>
                        <td class="text-end"></td>
                        <td class="text-end"></td>
                        <td class="text-center">
                          <i class="ph-duotone f-24"></i>
                        </td>
                        <td class="text-center">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="row">
                            <div class="col">
                              <h6 class="mb-1">Bose QuietComfort 35 II</h6>
                              <p class="text-muted f-12 mb-0">Noise Cancelling, Bluetooth 4.1, Over-ear</p>
                            </div>
                          </div>
                        </td>
                        <td></td>
                        <td class="text-end"></td>
                        <td class="text-end"></td>
                        <td class="text-center">
                          <i class="ph-duotone f-24"></i>
                        </td>
                        <td class="text-center">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <?php 

      include "../layouts/footer.php";

      ?>
    <?php 

      include "../layouts/scripts.php";

      ?>
    <script>
      // scroll-block
      var tc = document.querySelectorAll('.scroll-block');
      for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
      }
    </script>
    <?php 
      include "../layouts/modals.php";
      ?>
  </body>
  <!-- [Body] end -->
</html>