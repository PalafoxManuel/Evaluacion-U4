  <?php 
    include_once "../../app/config.php";

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
                    <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>customer">Clientes</a></li>
                    <li class="breadcrumb-item" aria-current="page">Todos los clientes</li>
                  </ul>
                </div>
                <div class="col-md-12">
                  <div class="page-header-title">
                    <h2 class="mb-0">Clientes</h2>
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
                  <h5>Clientes</h5>
                  <div class="card-header-right">
                    <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Agregar cliente
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
                              ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar cliente</h5
                            >
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                          </div>
                          <form>
                            <div class="modal-body">
                              <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Proporcione la información requerida en el formulario.</small
                              >
                              <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  id="fname"
                                  aria-describedby="emailHelp"
                                  placeholder="Ingresa el nombre"
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input
                                  type="email"
                                  class="form-control"
                                  id="lname"
                                  aria-describedby="emailHelp"
                                  placeholder="Ingresa el apellido"
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="emial" aria-describedby="emailHelp" placeholder="Ingresa el correo" />
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-light-primary">Agregar cliente</button>
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
                          <th class="border-top-0">Nombre completo</th>
                          <th class="border-top-0">Email</th>
                          <th class="border-top-0">Cuenta</th>
                          <th class="border-top-0">Fecha nacimiento</th>
                          <th class="border-top-0">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <td>Daniel Castro</td>
                        <td><a href="#" class="link-secondary">daniel.castro@example.com</a></td>
                        <td>N/A</td>
                        <td>May 9, 2023 at 10:50 AM</td>
                          <td>
                            <a href="<?= BASE_PATH ?>customer/details" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <a href="<?= BASE_PATH ?>customer/edit_customer" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Mateo Ruiz</td>
                        <td><a href="#" class="link-secondary">mateo.ruiz@example.com</a></td>
                        <td>N/A</td>
                        <td>September 5, 2021 at 08:55 AM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Lucas Pérez</td>
                        <td><a href="#" class="link-secondary">lucas.perez@example.com</a></td>
                        <td>N/A</td>
                        <td>March 14, 2020 at 02:10 PM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Sofía Ramírez</td>
                        <td><a href="#" class="link-secondary">sofia.ramirez@example.com</a></td>
                        <td>N/A</td>
                        <td>June 08, 2021 at 11:30 AM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Diego Fernández</td>
                        <td><a href="#" class="link-secondary">diego.fernandez@example.com</a></td>
                        <td>N/A</td>
                        <td>August 15, 2021 at 05:20 PM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Camila Torres</td>
                        <td><a href="#" class="link-secondary">camila.torres@example.com</a></td>
                        <td>N/A</td>
                        <td>November 03, 2022 at 10:45 AM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Emilio Cruz</td>
                        <td><a href="#" class="link-secondary">emilio.cruz@example.com</a></td>
                        <td>N/A</td>
                        <td>September 10, 2022 at 07:00 PM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Daniela Ortiz</td>
                        <td><a href="#" class="link-secondary">daniela.ortiz@example.com</a></td>
                        <td>N/A</td>
                        <td>May 28, 2023 at 03:10 PM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Ángel Gutiérrez</td>
                        <td><a href="#" class="link-secondary">angel.gutierrez@example.com</a></td>
                        <td>N/A</td>
                        <td>October 12, 2022 at 09:25 AM</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td>Isabella Rodríguez</td>
                        <td><a href="#" class="link-secondary">isabella.rodriguez@example.com</a></td>
                        <td>N/A</td>
                        <td>December 25, 2018 at 03:25 PM</td>
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