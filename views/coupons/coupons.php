<?php 
    include_once "../../app/config.php";

    include_once "../../app/sales/CouponsController.php";

    $CouponsController = new CouponsController();
    $Coupons = $CouponsController->get();

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
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>views/coupons">Cupones</a></li>
                    <li class="breadcrumb-item" aria-current="page">Todos los cupones</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Cupones</h2>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-none">
                <div class="card-header">
                    <h5>Cupones</h5>
                    <div class="card-header-right">
                    <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Añadir cupones
                    </button>
                    <div
                        class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Añadir cupones</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>

                            <form action="<?= BASE_PATH ?>coupons/" method="POST" enctype="multipart/form-data"> 
                            <input type="hidden" name="action" value="create_coupon">
                            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                            <div class="modal-body">
                            <small id="emailHelp" class="form-text text-muted mb-2 mt-0">
                              Completa la información para agregar un nuevo cupón.
                            </small>
                            <!-- Nombre cupón -->
                            <div class="mb-3">
                              <label class="form-label">Nombre del cupón</label>
                              <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Ingresa el nombre del cupón"
                              />
                            </div>
                            <!-- Descuento porcentual% -->
                                <div class="mb-3">
                                <label class="form-label">Codigo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Ingresa el código del cupón"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Porcentaje de descuento</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="percentage_discount"
                                    name="percentage_discount"
                                    placeholder="Ingrese el porcentaje de descuento"
                                />
                                </div>
                                 <!-- Monto mínimo necesario -->
                            <div class="mb-3">
                              <label class="form-label">Monto mínimo necesario</label>
                              <input
                                type="number"
                                class="form-control"
                                id="min_amount_required"
                                name="min_amount_required"
                                placeholder="Ingrese el monto mínimo necesario"
                              />
                            </div>
                            <!-- Productos mínimos necesarios -->
                            <div class="mb-3">
                              <label class="form-label">Productos mínimos necesarios</label>
                              <input
                                type="number"
                                class="form-control"
                                id="min_product_required"
                                name="min_product_required"
                                placeholder="Ingrese la cantidad mínima de productos necesarios"
                              />
                            </div>
                            <!-- Fecha inicio -->
                            <div class="mb-3">
                              <label class="form-label">Fecha de inicio</label>
                              <input
                                type="date"
                                class="form-control"
                                id="start_date"
                                name="start_date"
                              />
                            </div>
                            <!-- Fecha de finalización -->
                            <div class="mb-3">
                              <label class="form-label">Fecha de finalización</label>
                              <input
                                type="date"
                                class="form-control"
                                id="end_date"
                                name="end_date"
                              />
                            </div>
                            <!-- count uses -->
                            <div class="mb-3">
                              <label class="form-label">Conteo de usos</label>
                              <input
                                type="number"
                                class="form-control"
                                id="count_uses"
                                name="count_uses"
                                placeholder="Ingrese el número limite de usos"
                              />
                            </div>
                            <!-- Máximo de usos -->
                            <div class="mb-3">
                              <label class="form-label">Límite de usos</label>
                              <input
                                type="number"
                                class="form-control"
                                id="max_uses"
                                name="max_uses"
                                placeholder="Ingrese el número limite de usos"
                              />
                            </div>
                            <!-- Cantidad de descuento -->
                            <div class="mb-3">
                              <label class="form-label">Cantidad de descuentos</label>
                              <input
                                type="number"
                                class="form-control"
                                id="amount_discount"
                                name="amount_discount"
                                placeholder="Ingrese la cantidad de descuentos"
                              />
                            </div>
                            <!-- Válido para la primera compra -->
                            <div class="mb-3">
                              <label class="form-label">Solo aplicable a la primera compra</label>
                              <select class="form-control" id="valid_only_first_purchase" name="valid_only_first_purchase">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                            <!-- Estado -->
                            <div class="mb-3">
                              <label class="form-label">Estado actual</label>
                              <select class="form-control" id="status" name="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                              </select>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-light-primary">Añadir cupon</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-header-right">
                    <div
                        class="modal fade"
                        id="editModal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="tituloModal"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="tituloModal"
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Editar cupon</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>
                            <form>
                            <div class="modal-body">
                                <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                Completa la información para agregar un nuevo cupón.
                            </small>
                            <!-- Nombre cupón -->
                            <div class="mb-3">
                              <label class="form-label">Nombre del cupón</label>
                              <input
                                type="text"
                                class="form-control"
                                id="name"
                                placeholder="Ingresa el nombre del cupón"
                              />
                            </div>
                            <!-- Descuento porcentual% -->
                                <div class="mb-3">
                                <label class="form-label">Codigo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    placeholder="Ingresa el código del cupón"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Porcentaje de descuento</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="percentage_discount"
                                    placeholder="Ingrese el porcentaje de descuento"
                                />
                                </div>
                                 <!-- Monto mínimo necesario -->
                            <div class="mb-3">
                              <label class="form-label">Monto mínimo necesario</label>
                              <input
                                type="number"
                                class="form-control"
                                id="min_amount_required"
                                placeholder="Ingrese el monto mínimo necesario"
                              />
                            </div>
                            <!-- Productos mínimos necesarios -->
                            <div class="mb-3">
                              <label class="form-label">Productos mínimos necesarios</label>
                              <input
                                type="number"
                                class="form-control"
                                id="min_product_required"
                                placeholder="Ingrese la cantidad mínima de productos necesarios"
                              />
                            </div>
                            <!-- Fecha inicio -->
                            <div class="mb-3">
                              <label class="form-label">Fecha de inicio</label>
                              <input
                                type="date"
                                class="form-control"
                                id="start_date"
                              />
                            </div>
                            <!-- Fecha de finalización -->
                            <div class="mb-3">
                              <label class="form-label">Fecha de finalización</label>
                              <input
                                type="date"
                                class="form-control"
                                id="end_date"
                              />
                            </div>
                            <!-- Máximo de usos -->
                            <div class="mb-3">
                              <label class="form-label">Límite de usos</label>
                              <input
                                type="number"
                                class="form-control"
                                id="max_uses"
                                placeholder="Ingrese el número limite de usos"
                              />
                            </div>
                            <!-- Válido para la primera compra -->
                            <div class="mb-3">
                              <label class="form-label">Solo aplicable a la primera compra</label>
                              <select class="form-control" id="valid_only_first_purchase">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                            <!-- Estado -->
                            <div class="mb-3">
                              <label class="form-label">Estado actual</label>
                              <select class="form-control" id="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                              </select>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-light-primary">Editar cupon</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body shadow border-0">
                    <div class="table-responsive">
                    <table id="report-table" class="table table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="border-top-0">Porcentaje</th>
                            <th class="border-top-0">Inicio</th>
                            <th class="border-top-0">Vencimiento</th>
                            <th class="border-top-0">Codigo</th>
                            <th class="border-top-0">Usos Maximos</th>
                            <th class="border-top-0">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php

                          foreach ($Coupons['data'] as $coupon) {
                            echo '<tr>';
                            echo '<td>' . $coupon['percentage_discount'] . '%</td>';
                            echo '<td><a href="#" class="link-secondary">' . $coupon['start_date'] . '</a></td>';
                            echo '<td>' . $coupon['end_date'] . '</td>';
                            echo '<td>' . $coupon['code'] . '</td>';
                            echo '<td>' . $coupon['max_uses'] . '</td>';
                            echo '<td>';

                            echo '<form action="' . BASE_PATH . 'coupons/details" method="POST" enctype="multipart/form-data">';
                            echo '<input type="hidden" name="coupon_id" value="' . $coupon['id'] . '">';
                            echo '<button type="submit" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>';
                            echo '</form>';

                            echo '<button type="submit" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#editModal">';
                                echo '<i class="feather icon-edit"></i>';
                            echo '</button>';

                            echo '<form action="' . BASE_PATH . 'coupons/" method="POST" enctype="multipart/form-data">';
                            echo '<input type="hidden" name="action" value="delete_coupon">';
                            echo '<input type="hidden" name="global_token" value="' . $_SESSION['global_token'] . '">';
                            echo '<input type="hidden" name="id" value="' . $coupon['id'] . '">';
                            echo '<button type="submit" class="avtar avtar-xs btn-link-danger btn-pc-default">';
                            echo '<i class="ti ti-trash f-18"></i>';
                            echo '</button>';
                            echo '</form>';
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

        include "../layouts/modals.php"


        ?>

    </body>
    <!-- [Body] end -->
    </html>