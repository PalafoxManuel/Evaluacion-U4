    <?php 
    include_once "../../app/config.php";

    include_once "../../app/sales/OrdersController.php";

    $OrdersController = new OrdersController();
    $Orders = $OrdersController->get();

    // var_dump($Orders);  

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
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>orders">Ordenes</a></li>
                    <li class="breadcrumb-item" aria-current="page">Todas las ordenes</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Ordenes</h2>
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
                    <h5>Ordenes</h5>
                    <div class="card-header-right d-flex align-items-center">
                    <button type="button" class="btn btn-primary m-0 me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Añadir ordenes
                    </button>

                    <form action="<?= BASE_PATH ?>orders/" method="POST" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-secondary m-0 me-2">
                            Buscar por fechas
                        </button>
                        <input type="date" class="form-control w-auto" id="dateOne" name="start_date" required/>
                        <input type="date" class="form-control w-auto" id="dateTwo" name="end_date" required/>
                        <input type="hidden" name="action" value="get_order_dates">
                        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                    </form>

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
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Añadir ordenes</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>
                            <form>
                            <div class="modal-body">
                                <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Completa la información solicitada en el formulario</small
                                >
                                <div class="mb-3">
                                <label class="form-label">Folio</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingresa el folio"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Total</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="lname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingrese total"
                                />
                                </div>
                                <div class="mb-3">
                              <label class="form-label">Nombre</label>
                              <input
                                type="email"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingresa el nombre"
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Direcciones</label>
                              <input
                                type="email"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingresa Direcciones"
                                />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-light-primary">Añadir orden</button>
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
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Editar orden</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>
                            <form>
                            <div class="modal-body">
                                <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Completa la información solicitada en el formulario</small
                                >
                                <div class="mb-3">
                                <label class="form-label">Folio</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingresa el folio"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Total</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="lname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingrese total"
                                />
                                </div>
                                <div class="mb-3">
                              <label class="form-label">Nombre</label>
                              <input
                                type="email"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingresa el nombre"
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Direcciones</label>
                              <input
                                type="email"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingresa Direcciones"
                              />
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-light-primary">Editar orden</button>
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
                        <th class="border-top-0">Folio</th>
                        <th class="border-top-0">Total</th>
                        <th class="border-top-0">Cliente</th>
                        <th class="border-top-0">Correo</th>
                        <th class="border-top-0">Fecha de inicio</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($Orders['data'] as $order) {
                                $client = "Sin nombre";
                                if ($order['client']['name'] != null) {
                                    $client = $order['client']['name'];
                                }

                                $email = "Sin correo";
                                if ($order['client']['email'] != null) {
                                    $email = $order['client']['email'];
                                }

                                echo '<tr>';
                                echo '<td>' . $order['folio'] . '</td>';
                                echo '<td><a href="#" class="link-secondary">' . $order['total'] . '</a></td>';
                                echo '<td>' . $client . '</td>';
                                echo '<td>' . $email . '</td>';
                                echo '<td>' . $order['coupon']['start_date'] . '</td>';
                                echo '<td>';
                                echo '<a href="<?= BASE_PATH ?>orders/details" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>';
                                echo '<button type="button" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#editModal">';
                                    echo '<i class="feather icon-edit"></i>';
                                echo '</button>';
                                echo '<a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>';
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