<?php 
  include_once "../../app/config.php";

  include_once "../../app/products/PresentationsController.php";

  $product_id = $_POST['product_id'];

  $PresentationsController = new PresentationsController();
  $Presentations = $PresentationsController->getPresentationsByProductId($product_id);

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
                  <li class="breadcrumb-item" aria-current="page">Listado de presentaciones</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Listado de presentaciones</h2>
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
                <div class="text-end p-sm-4 pb-sm-2">
                  <form action="<?= BASE_PATH ?>products/add_presentation" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value=" <?= $product_id ?>">
                    <button type="submit" class="btn btn-primary"> <i class="ti ti-plus f-18"></i> Añadir presentación </button>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover tbl-product" id="pc-dt-simple">
                    <thead>
                      <tr>
                        <th>Detalle de la presentación</th>
                      </tr>
                    </thead>
                    <tbody>


                      <?php 
                        foreach ($Presentations['data'] as $presentation) {
                          echo '<tr>';
                            echo '<td>';
                              echo '<div class="row">';
                                echo '<div class="col">';
                                  echo '<h6 class="mb-1">' . $presentation['code'] . '</h6>';
                                  echo '<p class="text-muted f-12 mb-0">' . $presentation['description'] . '</p>';
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
                              echo '<div class="prod-action-links">';
                                echo '<ul class="list-inline me-auto mb-0">';
                                echo '<li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">';
                                echo '<form action="' . BASE_PATH . 'products/details" method="POST" enctype="multipart/form-data">';
                                  echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                                    echo '<button type="submit" class="avtar avtar-xs btn-link-success btn-pc-default">';
                                      echo '<i class="ti ti-eye f-18"></i>';
                                    echo '</button>';
                                  echo '</li>';

                                echo '</form>';

                                echo '<li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit">';

                                  echo '<form action="' . BASE_PATH . 'products/edit_product" method="POST" enctype="multipart/form-data">';
                                    echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                                    echo '<button type="submit" class="avtar avtar-xs btn-link-success btn-pc-default">';
                                      echo '<i class="ti ti-edit-circle f-18"></i>';
                                    echo '</a>';

                                  echo '</form>';

                                echo '</li>';
                                echo '<li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">';

                                  echo '<form action="' . BASE_PATH . 'products/" method="POST" enctype="multipart/form-data">';

                                    echo '<input type="hidden" name="action" value="delete_product">';
                                    echo '<input type="hidden" name="global_token" value="' . $_SESSION['global_token'] . '">';
                                    echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';

                                    echo '<button type="submit" class="avtar avtar-xs btn-link-danger btn-pc-default">';
                                      echo '<i class="ti ti-trash f-18"></i>';
                                    echo '</button>';
                                  echo '</form>';

                                echo '</li>';

                                echo '</ul>';
                              echo '</div>';
                            echo '</td>';
                          echo '</tr>';
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