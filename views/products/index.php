<?php 
    include_once "../../app/config.php";
    include_once "../../app/products/ProductsController.php";

    session_start();

    $ProductsController = new ProductsController();
    $products = $ProductsController->get();
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
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>products">Products</a></li>
                    <li class="breadcrumb-item" aria-current="page">Listado de productos</li>
                  </ul>
                </div>
                <div class="col-md-12">
                  <div class="page-header-title">
                    <h2 class="mb-0">Listado de productos</h2>
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
                    <a href="<?= BASE_PATH ?>products/add_product" class="btn btn-primary"> <i class="ti ti-plus f-18"></i>Añadir producto</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover tbl-product" id="pc-dt-simple">
                      <thead>
                        <tr>
                          <th>Descripción del producto</th>
                          <th>Categorias</th>
                          <th class="text-end">Precio</th>
                          <th class="text-end">Cantidad</th>
                          <th class="text-center">Marca</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          foreach ($products as $product) {
                            echo '<tr>';
                              echo '<td>';
                                echo '<div class="row">';
                                  echo '<div class="col-auto pe-0">';

                                  $cover = "https://wilsonartshop.decorlam.com.mx/wp-content/uploads/2020/12/3192-Gris-mate-swatch.jpg";

                                  if (!empty($product['cover'])) {
                                    $cover = $product['cover'];
                                  }

                                  echo '<img src="' . $cover . '" class="wid-40 rounded" onerror="this.src=\'https://wilsonartshop.decorlam.com.mx/wp-content/uploads/2020/12/3192-Gris-mate-swatch.jpg\'" />';
                                  echo '</div>';
                                  echo '<div class="col">';
                                    echo '<h6 class="mb-1"> ' . $product['name'] . ' </h6>';
                                    echo '<p class="text-muted f-12 mb-0"> ' . substr($product['description'], 0, 50) . '...'. ' </p>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</td>';

                              $categoryGlobal = "";

                              foreach ($product['categories'] as $category) {
                                if ($categoryGlobal == ""){
                                  $categoryGlobal = $category['name'];
                                } else {
                                  $categoryGlobal = $categoryGlobal . ', ' . $category['name'];
                                }
                              }                
                              
                              echo '<td>' . substr($categoryGlobal, 0, 40) . '...'. '</td>';

                              $price = "No disponible";

                              if (!empty($product['presentations']) && !empty($product['presentations'][0]['price'])) {
                                  foreach ($product['presentations'][0]['price'] as $priceData) {
                                      if ($priceData['is_current_price'] == 1) { 
                                          $price = '$' . number_format($priceData['amount'], 2); 
                                          break; 
                                      }
                                  }
                              }

                              echo '<td class="text-end">'. $price .'</td>';

                              $stock = "Sin stock";

                              if (!empty($product['presentations']) && isset($product['presentations'][0]['stock'])) {
                                  $stock = $product['presentations'][0]['stock'];
                              }

                              echo '<td class="text-center">' . $stock . '</td>';                              
                              echo '<td class="text-center">';

                                $brand;

                                if (!empty($product['brand'])) {
                                  $brand = $product['brand']['name'];
                                }
                              
                                echo '<p class= "text-center">' . $brand . '</p>';
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
                            echo '</tr>     ';
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
