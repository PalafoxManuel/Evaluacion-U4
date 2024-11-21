<?php
include_once "../../app/config.php";

$product_id = $_POST['product_id'];

include_once "../../app/products/ProductsController.php";

$ProductsController = new ProductsController();
$Product = $ProductsController->getProductById($product_id);

include_once "../../app/products/PresentationsController.php";

$PresentationsController = new PresentationsController();
$Presentations = $PresentationsController->getPresentationsByProductId($product_id);

$price = "No disponible";
if (!empty($Product['presentations']) && !empty($Product['presentations'][0]['price'])) {
    foreach ($Product['presentations'][0]['price'] as $priceData) {
        if ($priceData['is_current_price'] == 1) {
            $price = '$' . number_format($priceData['amount'], 2);
            break;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<!-- [Head] start -->
<head>
    <?php include "../layouts/head.php"; ?>
</head>
<!-- [Head] end -->

<!-- [Body] start -->
<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [Sidebar and Navigation] -->
    <?php 
        include "../layouts/sidebar.php";
        include "../layouts/nav.php"; 
    ?>

    <!-- [Main Content] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [Breadcrumb] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>products">Productos</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Breadcrumb] end -->

            <!-- [Main Product Content] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Product Images -->
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
                                                <div class="carousel-item active">
                                                    <img src="<?= htmlspecialchars($Product['cover']) ?>" class="d-block w-100" alt="Product image" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= htmlspecialchars($Product['cover']) ?>" class="d-block w-100" alt="Product image" />
                                                </div>
                                            </div>
                                            <ol class="list-inline carousel-indicators position-relative product-carousel-indicators my-sm-3 mx-0">
                                                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="list-inline-item w-25 h-auto active">
                                                    <img src="../../assets/images/application/img-prod-1.jpg" class="d-block wid-50 rounded" alt="Product images" />
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Details -->
                                <div class="col-md-6">
                                    <span class="badge bg-success f-14">Disponible</span>
                                    <h5 class="my-3"><?= $Product['name'] ?></h5>
                                    <h3 class="mb-4"><b><?= $price ?></b></h3>
                                    <p><?= $Product['description'] ?></p>

                                    <div class="offer-check-block">
                                       <?php 
                                            foreach ($Presentations['data'] as $Presentation) {

                                                echo '<div class="offer-check border rounded p-3">';
                                                    echo '<div class="form-check">';
                                                        echo '<input type="radio" name="radio1" class="form-check-input input-primary" id="customCheckdef1" checked="" />';
                                                        echo '<label class="form-check-label d-block" for="customCheckdef1">';
                                                            echo '<span class="h6 mb-0 d-block">' . $Presentation['code'] . '</span>';
                                                            echo '<span class="text-muted offer-details">' . $Presentation['description'] . '</span>';
                                                            echo '<span class="h6 mb-0 text-primary">1 Oferta <i class="ti ti-arrow-narrow-right"></i></span>';
                                                        echo '</label>';
                                                    echo '</div>';
                                                echo '</div>';
                                               
                                            }
                                       ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-primary">Haz tu pedido aquí</button>
                                            </div>
                                        </div>
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
            </div>
            <!-- [Main Product Content] end -->
        </div>
    </div>
    <!-- [Main Content] end -->

    <!-- [Footer and Scripts] -->
    <?php 
        include "../layouts/footer.php";
        include "../layouts/scripts.php";
        include "../layouts/modals.php"; 
    ?>

    <!-- [Page Specific JS] start -->
    <script>
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
    </script>
</body>
<!-- [Body] end -->
</html>
