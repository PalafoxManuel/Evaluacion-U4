    <?php 
    include_once "../../../app/config.php";

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
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>catalogs/brands">Marcas</a></li>
                    <li class="breadcrumb-item" aria-current="page">Todas los marcas</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Marcas</h2>
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
                    <h5>Marcas</h5>
                    <div class="card-header-right">
                    <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Añadir marcas
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
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Añadir marcas</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>
                            <form>
                            <div class="modal-body">
                                <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Completa la información solicitada en el formulario.</small
                                >
                                <div class="mb-3">
                                <label class="form-label">Nombre de la marca</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingresa el nombre de la marca"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="lname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingrese la descripción de la marca"
                                    />
                                    </div>
                                    <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="lname"
                                    aria-describedby="emailHelp"
                                    placeholder="Slug"
                                />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-light-primary">Añadir marca</button>
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
                                ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Editar marca</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                            </div>
                            <form>
                            <div class="modal-body">
                                <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Completa la información solicitada en el formulario.</small
                                >
                                <div class="mb-3">
                                <label class="form-label">Nombre de la marca</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingresa el nombre de la marca"
                                />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Descripción de la marca</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="lname"
                                    aria-describedby="emailHelp"
                                    placeholder="Ingresa la descripción de la marca"
                                />
                                </div>
                                <div class="mb-3">
                              <label class="form-label">Slug</label>
                              <input
                                type="email"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Slug"
                              />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-light-primary">Editar marca</button>
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
                            <th class="border-top-0">Nombre brand</th>
                            <th class="border-top-0">Descripcion</th>
                            <th class="border-top-0">Slug</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Emily Carter</td>
                            <td><a href="#" class="link-secondary">emily@carter.com</a></td>
                            <td>N/A</td>
                            <td>March 15, 2020 at 10:25 AM</td>
                            <td>
                            <a href="<?= BASE_PATH ?>catalogs/brands/details" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <button type="button" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="feather icon-edit"></i>
                            </button>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Michael Davis</td>
                            <td><a href="#" class="link-secondary">michael.davis@email.com</a></td>
                            <td>N/A</td>
                            <td>June 22, 2019 at 08:10 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Sophia Brown</td>
                            <td><a href="#" class="link-secondary">sophia.brown@mail.com</a></td>
                            <td>N/A</td>
                            <td>April 10, 2021 at 02:45 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>James Wilson</td>
                            <td><a href="#" class="link-secondary">james.wilson@domain.com</a></td>
                            <td>N/A</td>
                            <td>August 30, 2022 at 11:20 AM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Ava Johnson</td>
                            <td><a href="#" class="link-secondary">ava.johnson@mailbox.com</a></td>
                            <td>N/A</td>
                            <td>October 07, 2018 at 04:55 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>William Garcia</td>
                            <td><a href="#" class="link-secondary">william.garcia@webmail.com</a></td>
                            <td>N/A</td>
                            <td>May 18, 2023 at 09:30 AM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Olivia Martinez</td>
                            <td><a href="#" class="link-secondary">olivia.martinez@mailservice.com</a></td>
                            <td>N/A</td>
                            <td>December 25, 2020 at 07:00 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Benjamin Lee</td>
                            <td><a href="#" class="link-secondary">benjamin.lee@inbox.com</a></td>
                            <td>N/A</td>
                            <td>February 13, 2019 at 06:40 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Isabella Smith</td>
                            <td><a href="#" class="link-secondary">isabella.smith@webmail.com</a></td>
                            <td>N/A</td>
                            <td>July 04, 2021 at 03:05 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Lucas Taylor</td>
                            <td><a href="#" class="link-secondary">lucas.taylor@domain.com</a></td>
                            <td>N/A</td>
                            <td>September 19, 2022 at 05:15 PM</td>
                            <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
                         </tr>
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

        include "../../../views/layouts/footer.php";

        ?>

        <?php 

        include "../../../views/layouts/scripts.php";

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

        include "../../../views/layouts/modals.php";


        ?>

    </body>
    <!-- [Body] end -->
    </html>