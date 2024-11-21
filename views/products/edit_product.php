<?php 
    include_once "../../app/config.php";
    include_once "../../app/products/ProductsController.php";
    include_once "../../app/products/CategoriesController.php";

    $CategoriesController = new CategoriesController();
    $categories = $CategoriesController->getCategories();

    include_once "../../app/products/BrandsController.php";
    $BrandsController = new BrandsController();
    $brands = $BrandsController->getBrands();

    include_once "../../app/products/TagsController.php";
    $TagsController = new TagsController();
    $tags = $TagsController->getTags();

    $product_id = $_POST['product_id'];

    $ProductsController = new ProductsController();
    $product = $ProductsController->getProductById($product_id);
?>

<!doctype html>
<html lang="en">
<head>
    <?php include "../layouts/head.php"; ?>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <?php include "../layouts/sidebar.php"; ?>
    <?php include "../layouts/nav.php"; ?>

    <div class="pc-container">
        <form action="<?= BASE_PATH ?>products/" method="POST" enctype="multipart/form-data">
            <div class="pc-content">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>products">Productos</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Editar producto</li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0">Editar producto</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Descripción del producto</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nombre de producto</label>                
                                    <?php echo '<input name="name" type="text" class="form-control" placeholder="Enter Product Name" value="' . $product['name'] . '" />'; ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" placeholder="Introduce el slug" name="slug" value="<?= $product['slug'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <?php if (!empty($categories)) { ?>
                                    <label class="form-label">Categorías</label>
                                    <select class="form-select" name="category">
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <?php if (!empty($brands)) { ?>
                                    <label class="form-label">Marcas</label>
                                    <select class="form-select" name="brand_id">
                                        <?php foreach ($brands as $brand) { ?>
                                        <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <?php if (!empty($tags)) { ?>
                                    <label class="form-label">Etiquetas</label>
                                    <select class="form-select" name="tags">
                                        <?php foreach ($tags as $tag) { ?>
                                        <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } ?>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Detalle del producto</label>
                                    <textarea name="description" class="form-control" placeholder="Enter Product Description"><?= $product['description'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Precio</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-0">
                                            <label class="form-label d-flex align-items-center">
                                                Precio del producto
                                                <i class="ph-duotone ph-info ms-1" data-bs-toggle="tooltip" data-bs-title="Precio del producto general"></i>
                                            </label>
                                            <div class="input-group mb-0">
                                                <span class="input-group-text">$</span>
                                                <?php 
                                                    $price = "No disponible";
                                                    if (!empty($product['presentations']) && !empty($product['presentations'][0]['price'])) {
                                                        foreach ($product['presentations'][0]['price'] as $priceData) {
                                                            if ($priceData['is_current_price'] == 1) {
                                                                $price = '$' . number_format($priceData['amount'], 2);
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo '<input type="text" class="form-control" placeholder="Cost per items" value="'. $price .'" name="price" />'; 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Imagen del producto</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <p><span class="text-danger">*</span>Resolución sugerida: 645 x 645 para la imagen del producto</p>
                                    <label class="btn btn-outline-secondary" for="flupld"><i class="ti ti-upload me-2"></i>Haz click aqui para subir</label>
                                    <input type="file" id="flupld" class="d-none" name="cover"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-end btn-page">
                                <input type="hidden" name="action" value="update_product">
                                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                                <button type="submit" class="btn btn-primary mb-0">Modificar producto</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include "../layouts/footer.php"; ?>
    <?php include "../layouts/scripts.php"; ?>

    <script>
        var tc = document.querySelectorAll('.scroll-block');
        for (var t = 0; t < tc.length; t++) {
            new SimpleBar(tc[t]);
        }
    </script>

    <?php include "../layouts/modals.php"; ?>
</body>
</html>
