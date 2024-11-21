<?php 
    include_once "../../app/config.php";

    $product_id = $_POST['product_id'];

    include_once '../../app/products/PresentationsController.php';

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
        <!-- [ Pre-loader ] start -->
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
                    <li class="breadcrumb-item" aria-current="page">Añadir presentación</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Añadir presentación</h2>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-xl-6">
                <form action="<?= BASE_PATH ?>presentation/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <p>holaaaa<?= $product_id ?></p>
                    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                    <input type="hidden" name="action" value="create_presentation">

                    <div class="card">
                        <div class="card-header">
                            <h5>Detalle de la presentación</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Descripcion de la presentación</label>
                                <input type="text" class="form-control" placeholder="Ingresa el nombre" name="description"/>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Código</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Ingrese el código" 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                name="code"
                                required 
                            />
                            <small class="text-muted">El código solo debe incluir números.</small>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Peso(en gramos)</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="gr" 
                            name="weight_in_grams"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                        />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-control" required name="status">
                                <option value="">Seleccione un estado</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                placeholder="Ingrese stock actual" 
                                min="0" 
                                name="stock"
                                required 
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock MIN</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                placeholder="Ingrese stock mínimo" 
                                min="0" 
                                name="stock_min"
                                required 
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock MAX</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                placeholder="Ingrese stock máximo" 
                                min="0" 
                                name="stock_max"
                                required 
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                placeholder="Ingrese la cantidad" 
                                min="0" 
                                name="price"
                                required 
                            />
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
            <div class="col-xl-6">
            </div>
            <div class="col-sm-12">
                <div class="card">
                <div class="card-body text-end btn-page">
                    <button type="submit" class="btn btn-primary mb-0">Añadir presentación</button>
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
        <!-- [ Main Content ] end -->
    <!-- Required Js -->
    </body>
    <!-- [Body] end -->
    </html>