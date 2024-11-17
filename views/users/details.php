<?php 
  session_start();
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
                          src=""
                          alt="User image"
                        /> <!-- mod con ID -->
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                      </div>
                      <h5 id="port_name" class="mb-0"></h5> <!-- mod con ID -->
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
                      <p id="inf_pers_email" class="mb-0"></p> <!-- mod con ID -->
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <p class="mb-0 text-muted me-1">Número de telefono</p>
                      <p id="inf_pers_phone" class="mb-0"></p> <!-- mod con ID -->
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
                                <p id="name" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Apellidos</p>
                                <p id="lastname" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de telefono</p>
                                <p id="phone_number" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Género</p> 
                                <p id="gender" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Email</p>
                                <p id="email" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de nacimiento</p>
                                <p id="birthday" class="mb-0"></p> <!-- mod con ID -->
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pb-0">
                            <p class="mb-1 text-muted">Fecha de ingreso a la empresa</p>
                            <p id="date" class="mb-0"></p> <!-- mod con ID -->
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

    // get usuario
    let token = "<?= $_SESSION['global_token'] ?>";
    let idU = "<?= $_GET['id'] ?>";
    if (idU != 'profile'){
      idU = parseInt(idU);
      getUser(idU);
    }

    function getUser(){
      let formulario = new URLSearchParams();
      formulario.append("action", "detail_user");
      formulario.append("user_id", idU);
      formulario.append("global_token", token);

      fetch('../app/users/UsersController.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: formulario.toString()
      })
      .then(response => response.json())
      .then(data => {
        if (data.success){
          let datos = data.data;
          document.getElementById("name").innerText = (datos.name!=null&&datos.name!=undefined)? datos.name : "";
          document.getElementById("port_name").innerText = (datos.name!=null&&datos.name!=undefined)? datos.name : "";
          document.getElementById("lastname").innerText = (datos.lastname!=null&&datos.lastname!=undefined)? datos.lastname : "";
          document.getElementById("phone_number").innerText = (datos.phone_number!=null&&datos.phone_number!=undefined)? datos.phone_number : "";
          document.getElementById("inf_pers_phone").innerText = (datos.phone_number!=null&&datos.phone_number!=undefined)? datos.phone_number : "";
          document.getElementById("gender").innerText = (datos.gender!=null&&datos.gender!=undefined)? datos.gender : "";
          document.getElementById("email").innerText = (datos.email!=null&&datos.email!=undefined)? datos.email : "";
          document.getElementById("inf_pers_email").innerText = (datos.email!=null&&datos.email!=undefined)? datos.email : "";
          document.getElementById("date").innerText = (datos.created_at!=null&&datos.created_at!=undefined)? fecha(datos.created_at) : "";
          document.getElementById("image").src = (datos.avatar!=null&&datos.avatar!=undefined)? datos.avatar : "";
        }
      })
      .catch(error => console.error('Error:', error));
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