<?php 
    include_once "../../app/config.php";

    $product_id = $_POST['product_id'];

    include_once "../../app/products/PresentationsController.php";

    $PresentationsController = new PresentationsController();
    $Presentation = $PresentationsController->getPresentationById($product_id);
    $Presentation = $Presentation['data'];

    // var_dump('------------------------------------------------------------' . $product_id );
    // var_dump('------------------------------------------------------------' . $Presentation['data']['id'] );


    $price = "No disponible";
   
    $price = '$' . number_format($Presentation['current_price']['amount'], 2);

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
                    <li class="breadcrumb-item" aria-current="page">Detalle de presentación</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Detalle de presentación</h2>
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
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="sticky-md-top product-sticky">
                        <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light rounded position-relative">
                            <div class="card-body position-absolute end-0 top-0">
                                <div class="form-check prod-likes">
                                <input type="checkbox" class="form-check-input" />
                                <i data-feather="heart" class="prod-likes-icon"></i>
                                </div>
                            </div>
                            <div class="card-body position-absolute bottom-0 end-0">
                                <ul class="list-inline ms-auto mb-0 prod-likes">
                                <li class="list-inline-item m-0">
                                    <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                    <i class="ti ti-zoom-in f-18"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item m-0">
                                    <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                    <i class="ti ti-zoom-out f-18"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item m-0">
                                    <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                    <i class="ti ti-rotate-clockwise f-18"></i>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            <div class="carousel-item active">
                            <img src="<?= htmlspecialchars($Presentation['cover']) ?>" class="d-block w-100" alt="Product image" />
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                            if (($Presentation['status']) == "activo") {
                                echo '<span class="badge bg-success f-14">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger f-14">Inactivo</span>';
                            }
                        ?>
                        <h5 class="my-3"><?= $Presentation['code'] ?></h5>
                        
                        <h5 class="mt-4 mb-sm-3 mb-2 f-w-500">Descripción de la presentacion</h5>
                        <p><?= $Presentation['description'] ?></p>
                        <h5 class="mt-4 mb-sm-3 mb-2 f-w-500">Cantidad</h5>
                        <label><?= $Presentation['stock'] ?></label>
                        <h3 class="mt-4 mb-sm-3 mb-2 f-w-500"
                        ><b><?= $price ?></b></h3>
                        <div class="row">

                        <div class="col-6"></div>

                            <form class="d-grid" action="<?=  BASE_PATH ?>products/edit_presentation" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="presentation_id" value="<?= $Presentation['id'] ?>">
                                <button type="submit" class="btn btn-primary">Editar</but>
                            </form>

                        </div>
                        <h3 class="mt-4 mb-sm-3 mb-2 f-w-500"></h3>
                        <div class="col-6">
                            <div class="d-grid">
                                <form action="<?= BASE_PATH ?>products/presentation" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                    <button type="submit" class="btn btn-outline-secondary">Presentaciones</button>
                                </form>
                            </div>
                        </div>
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

        include "../layouts/footer.php";

        ?>

    <?php 

        include "../layouts/scripts.php";

        ?>

        <!-- [Page Specific JS] start -->
        <script>
        // scroll-block
        var tc = document.querySelectorAll('.scroll-block');
        for (var t = 0; t < tc.length; t++) {
            new SimpleBar(tc[t]);
        }
        // quantity start
        function increaseValue(temp) {
            var value = parseInt(document.getElementById(temp).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById(temp).value = value;
        }

        function decreaseValue(temp) {
            var value = parseInt(document.getElementById(temp).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? (value = 1) : '';
            value--;
            document.getElementById(temp).value = value;
        }
        // quantity end
        </script>
        
        <?php 

        include "../layouts/modals.php";

        ?>

    </body>
    <!-- [Body] end -->
    </html>