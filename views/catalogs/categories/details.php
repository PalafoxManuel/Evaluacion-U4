    <?php 
    include_once "../../../app/config.php";
    include_once "../../../app/products/CategoriesController.php";

    if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $controlador = new CategoriesController();
            $response = json_decode(json_encode($controlador->getCategoriesById($id)));
            if ($response->success) {
                $category = $response->data;
                //var_dump($category);
            }else{
                header('Location: '. BASE_PATH);
            }
        }else{
            header('Location: '. BASE_PATH);
        }
    }else{
        header('Location: '. BASE_PATH);
    }

    ?>
    <!doctype html>
    <html lang="en">
    <!-- [Head] start -->

    <head>
    <?php 
        include "../../../views/layouts/head.php";
    ?>
    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        <?php 

        include "../../../views/layouts/sidebar.php";

        ?>

        <?php 

        include "../../../views/layouts/nav.php";

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
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>catalogs/categories">Categorías</a></li>
                    <li class="breadcrumb-item" aria-current="page">Detalles de categorías</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Detalles de categorías</h2>
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
                <div class="col-lg-5 col-xxl-3">
                    <div class="card overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="text-center mt-3">
                        <h5 class="mb-0"><?= $category->name ?></h5>
                        </div>
                    </div>
                    <div
                        class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                        id="user-set-tab"
                        role="tablist"
                        aria-orientation="vertical"
                    >
                        <a
                        class="nav-link list-group-item list-group-item-action active"
                        id="user-set-profile-tab"
                        data-bs-toggle="pill"
                        href="#user-set-profile"
                        role="tab"
                        aria-controls="user-set-profile"
                        aria-selected="true"
                        >
                        <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Visualización de categoría</span>
                        </a>
                    </div>
                    </div>
                    <div class="card">
                    <div class="card-header">
                        <h5>Detalles</h5>
                    </div>
                    <div class="card-body position-relative">
                        <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                            <p class="mb-0 text-muted me-1">Nombre de la categoría</p>
                            <p class="mb-0"><?= $category->name ?? "" ?></p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                            <p class="mb-0 text-muted me-1">Slug</p>
                            <p class="mb-0"><?= $category->slug ?? "" ?></p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xxl-9">
                    <div class="tab-content" id="user-set-tabContent">
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                        <div class="card">
                        <div class="card-header">
                            <h5>Detalles generales</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Nombre</p>
                                        <p class="mb-0"><?= $category->name ?? "" ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Slug</p>
                                        <p class="mb-0"><?= $category->slug ?? "" ?></p>
                                    </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted">Descripción</p>
                                        <p class="mb-0"><?= $category->description ?? "" ?></p>
                                    </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <p class="mb-1 text-muted">Productos asociados</p>
                                    </div>
                                    <table id="report-table" class="table table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Nombre producto</th>
                                            <th class="border-top-0">Slug</th>
                                        
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($category->products as $product): ?>
                                                <tr>
                                                    <td><?= $product->id ?? 0 ?></td>
                                                    <td><?= $product->name ?? "" ?></td>
                                                    <td><?= $product->slug ?? "" ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
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

        include "../../../views/layouts/footer.php";

        ?>
        <?php 

        include "../../../views/layouts/scripts.php";

        ?>
        <script>
        // scroll-block
        var tc = document.querySelectorAll('.scroll-block');
        for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
        }
        </script>
        <?php 

        include "../../../views/layouts/modals.php";

        ?>
    </body>
    </body>
    <!-- [Body] end -->
    </html>