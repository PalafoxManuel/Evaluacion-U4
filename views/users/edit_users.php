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
      header('Location: home/');
    }
  }else{
    header('Location: home/');
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
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Usuarios</a></li>
                  <li class="breadcrumb-item" aria-current="page">Editar usuario</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Editar usuario</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <div class="col-12">
            <form id="formGeneral" method="POST" enctype="multipart/form-data" class="card">
              <div class="card-header">
                <h5 class="mb-0">Información del usuario</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Primer nombre</label>
                      <input name="name" type="text" class="form-control" placeholder="Enter first name" value="<?= $user->name ?>" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Apellido</label>
                      <input name="lastname" type="text" class="form-control" placeholder="Enter last name" value="<?= $user->lastname ?>" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" placeholder="Enter email" value="<?= $user->email ?>" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Número de telefono</label>
                      <input name="phone_number" type="number" class="form-control" placeholder="Enter Mobile number" value="<?= $user->phone_number ?>" required/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div method="post" enctype="multipart/form-data" action="<?= BASE_PATH ?>users" class="mb-3">
                      <input class="form-control" type="file" id="imagen" accept="image/png, image/jpeg" />
                    </div>
                  </div>
                  <div class="col-md-12 text-end">
                    <button id="sub" name="action" type="button" class="btn btn-primary">Editar usuario</button>
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" name="role" value="Administrador">
                    <input type="hidden" name="password" value="123456789">
                    <input type="hidden" name="created_by" value="<?= $_SESSION['user_data']->name ?>">
                    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                  </div>
                </div>
              </div>
            </form>
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
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }

    document.getElementById("sub").addEventListener("click", function (e) {
      e.preventDefault();

      let imagenAvatar = document.getElementById("imagen");
      let imagen = imagenAvatar.files[0];
      if (imagen){
        let formAvatar = new FormData();
        formAvatar.append('profile_photo_file', imagen);
        formAvatar.append('id', <?= $user->id ?>);
        formAvatar.append('action', 'update_avatar');
        formAvatar.append('global_token', "<?= $_SESSION['global_token'] ?>");
        console.log("hay imagen")

        fetch("<?= BASE_PATH ?>users/", {
        method: 'post',
        body: formAvatar,
        })
        .then(response => response.json())
        .then(data => {
        })
        .catch(error => console.error("Error: ",error))
        
      }
      updateUser();
    })

    function updateUser(){
      let formData = document.getElementById("formGeneral");

      if (formData.checkValidity()){
          let form = new FormData(formData);

          fetch('<?= BASE_PATH ?>users', {
              method: 'POST',
              body: form,
          })
          .then(response => {
              if (response.ok) {
                  if (response.redirected){
                      sweetAlert("ÉXITO", "Se actualizo de forma correcta", "success");
                      window.location.href = response.url
                      return;
                  }else{
                      return response.json();
                  }
              }else{
                  swal("Ocurrio un error", "No fue posible actualizar al usuario");
                  throw new Error('Error en el servidor: ' + response.status);
              }
          })
          .then(data => {
              if (data?.error) {
                  swal("Ocurrio un error", "No fue posible actualizar al usuario");
                  console.error("Error en data: ",data.error);
              }
          })
          .catch(error => {
              console.error("Error: ",error);
          })
      }else{
          sweetAlert("Error al ingresador los datos", "Llene todos los campos y verifique que sean datos validos", "error");
      }
    }

    </script>
    <?php 

    include "../layouts/modals.php";

    ?>
  </body>
  <!-- [Body] end -->
</html>