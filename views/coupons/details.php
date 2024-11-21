<?php 
  include_once "../../app/config.php";

  include_once "../../app/sales/CouponsController.php";

  $CouponsController = new CouponsController();
  $Coupons = $CouponsController->get();

  $coupon_id = $_POST['coupon_id'];
  // var_dump($coupon_id);

?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
  <?php 
    include "../../views/layouts/head.php";
  ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <?php 

      include "../../views/layouts/sidebar.php";

    ?>

    <?php 

      include "../../views/layouts/nav.php";

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
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>views/coupons/coupons">Cupon</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalles de cupon</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalles de cupon</h2>
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
            <div class="row">
                <div class="card">
                <div class="card-header">
                <h5>Listado de órdenes con cupón aplicado</h5>
                <small>
                    Los eventos asignados a la tabla pueden ser de gran utilidad para la interacción del usuario; 
                    sin embargo, es importante tener en cuenta que DataTables añadirá y eliminará filas del DOM.
                </small>

                    >
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Widgets descontados</th>
                                    <th>Folio de orden</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>%</th>
                                    <th>Vencimiento</th>
                                    <th>Uso máximo</th>
                                    <th>Pago mínimo</th>
                                    <th>Compra mínima</th>
                                    <th>Tipo</th>
                                    <th>Total</th>
                                    <th>Con descuento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = 1;
                                foreach ($Coupons['data'] as $coupon) {
                                    foreach($coupon['orders'] as $orders) {
                                        if($coupon['id'] == $coupon_id) {
                                            echo '<tr>';
                                            echo '<td>'. $count++ .'</td>';
                                            echo '<td>'. $orders['id'] .'</td>';
                                            echo '<td>'. $coupon['name'] .'</td>';
                                            echo '<td>'. $coupon['code'] .'</td>';
                                            echo '<td>'. $coupon['percentage_discount'] .'%</td>';
                                            echo '<td>'. $coupon['end_date'] .'</td>';
                                            echo '<td>'. $coupon['max_uses'] .'</td>';
                                            echo '<td>'. $coupon['min_amount_required'] .'</td>';
                                            echo '<td>'. $coupon['min_product_required'] .'</td>';
                                            echo '<td>'. $coupon['couponable_type'] .'</td>';
                                            echo '<td>'. number_format($orders['total'], 2) .'</td>';
                                            echo '<td>'. number_format((($orders['total']) - ((($orders['total'])*(($coupon['percentage_discount'])/(100))))), 2) .'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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

    include "../../views/layouts/footer.php";

    ?>
    <?php 

    include "../../views/layouts/scripts.php";

    ?>
    <script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }
    </script>
    <?php 

    include "../../views/layouts/modals.php";

    ?>
  </body>

  </body>
  <!-- [Body] end -->
</html>