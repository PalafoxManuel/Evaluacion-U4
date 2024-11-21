<?php 
  include_once "../../app/config.php";

  include_once "../../app/sales/OrdersController.php";

  $presentation_id = $_POST['id'];
  // var_dump('----------------------------------------------------------------------------' . $presentation_id);

  $OrdersController = new OrdersController();
  $Orders = $OrdersController->get();
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

                      <?php
                        foreach ($Orders['data'] as $order) {
                          foreach ($order['presentations'] as $presentation) {
                            // var_dump($presentation['product_id']);
                            // if ($presentation['id'] == $presentation_id) {
                              echo '<tr>';
                                echo '<td>';
                                  echo '<div class="row">';
                                    echo '<div class="col">';
                                      echo '<h6 class="mb-1">Orden: ' . $order['folio'] . '</h6>';
                                      echo '<p class="text-muted f-12 mb-0">Codigo de presentacion: '. $order['presentations'][0]['code'] .' </p>';
                                    echo '</div>';
                                  echo '</div>';
                                echo '</td>';
                                echo '<td></td>';
                                echo '<td class="text-end"></td>';
                                echo '<td class="text-end"></td>';
                                echo '<td class="text-center">';
                                  echo '<i class="ph-duotone f-24"></i>';
                                echo '</td>';
                                echo '<td class="text-center">';
                                echo '</td>';
                              echo '</tr>';
                            // }
                          }
                        }
                      ?>
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