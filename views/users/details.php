<?php 
  include_once "../../app/config.php";
  include_once "../../app/users/UsersController.php";

  if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      $controlador = new UsersController();
      $response = json_decode(json_encode($controlador->getUserById($id)));
      $user = $response->data;
    }else{
      header('Location: '. BASE_PATH);
    }
  }else{
    header('Location: '. BASE_PATH);
  }

  function fecha($date){
    $fecha = new DateTime($date);
    return $fecha->format('Y/m/d');
  }

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
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Incio</a></li>
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>users">Usuarios</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalles de usuario</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalles de usuario</h2>
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
                          id="image"
                          class="rounded-circle img-fluid wid-90 img-thumbnail"
                          src="<?= $user->avatar ?>"
                          alt="User image"
                          onerror="this.onerror=null; this.src='<?= BASE_PATH ?>assets/images/user/avatar-2.jpg';"
                        /> <!-- mod con ID -->
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                      </div>
                      <h5 id="port_name" class="mb-0"><?= $user->name ?? "" ?></h5> <!-- mod con ID -->
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
                <div class="card">
                  <div class="card-header">
                    <h5>Información personal</h5>
                  </div>
                  <div class="card-body position-relative">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <p class="mb-0 text-muted me-1">Email</p>
                      <p id="inf_pers_email" class="mb-0"><?= $user->name ?? "" ?></p> <!-- mod con ID -->
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <p class="mb-0 text-muted me-1">Número de telefono</p>
                      <p id="inf_pers_phone" class="mb-0"><?= $user->phone_number ?? "" ?></p> <!-- mod con ID -->
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
                                <p id="name" class="mb-0"><?= $user->name ?? "" ?></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Apellidos</p>
                                <p id="lastname" class="mb-0"><?= $user->lastname ?? "" ?></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de telefono</p>
                                <p id="phone_number" class="mb-0"><?= $user->phone_number ?? "" ?></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Creado por</p>
                                <p id="phone_number" class="mb-0"><?= $user->created_by ?? "" ?></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Email</p>
                                <p id="email" class="mb-0"><?= $user->email ?? "" ?></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Rol</p>
                                <p id="email" class="mb-0"><?= $user->role ?? "" ?></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pb-0">
                            <p class="mb-1 text-muted">Fecha de ingreso a la empresa</p>
                            <p id="date" class="mb-0"><?= fecha($user->created_at) ?></p> <!-- mod con ID -->
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

    function fecha(fecha){
      let fechaMod = new Date(fecha);
      const day = String(fechaMod.getDate()).padStart(2, '0');
      const month = String(fechaMod.getMonth() + 1).padStart(2, '0');
      const year = fechaMod.getFullYear();
      return `${day}/${month}/${year}`;
    }

    </script>
    <?php 

    include "../layouts/modals.php";

    ?>
  </body>

  </body>
  <!-- [Body] end -->
</html>