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
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Clientes</a></li>
                    <li class="breadcrumb-item" aria-current="page">Detalles del cliente</li>
                  </ul>
                </div>
                <div class="col-md-12">
                  <div class="page-header-title">
                    <h2 class="mb-0">Detalles de clientes</h2>
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
                        <div class="chat-avtar d-inline-flex mx-auto">
                          <img
                            class="rounded-circle img-fluid wid-90 img-thumbnail"
                            src="../assets/images/user/avatar-1.jpg"
                            alt="User image"
                          />
                          <i class="chat-badge bg-success me-2 mb-2"></i>
                        </div>
                        <h5 class="mb-0">Rick</h5>
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
                        <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Vista del perfil</span>
                      </a>
                    </div>
                  </div>
                      <div class="card statistics-card-1 overflow-hidden">
                      <div class="card-body">
                      <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
                      <h5 class="mb-4">Widget total de compras</h5>
                      <div class="d-flex align-items-center mt-3">
                      <h3 class="f-w-300 d-flex align-items-center m-b-0">$199.99</h3>
                      <span class="badge bg-light-primary ms-2">25%</span>
                    </div>
                    <p class="text-muted mb-2 text-sm mt-3">Has gastado 320,45 este mes</p>
                        <div class="progress" style="height: 7px">
                          <div
                            class="progress-bar bg-brand-color-3"
                            role="progressbar"
                            style="width: 75%"
                            aria-valuenow="75"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-xxl-9">
                  <div class="tab-content" id="user-set-tabContent">
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                      <div class="card">
                        <div class="card-header">
                          <h5>Información personal</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 pt-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Nombre</p>
                                  <p class="mb-0">Rick</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Apellidos</p>
                                  <p class="mb-0">Luque Garayzar</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Número de telefono</p>
                                  <p class="mb-0">6151106899</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Género</p>
                                  <p class="mb-0">Masculino</p>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item px-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Email</p>
                                  <p class="mb-0">Ricky@gmail.com</p>
                                </div>
                                <div class="col-md-6">
                                  <p class="mb-1 text-muted">Nivel</p>
                                  <p class="mb-0">Principiante</p>
                                </div>
                              </div>
                            </li>
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

    </body>
    <!-- [Body] end -->
  </html>