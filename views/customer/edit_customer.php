  <?php 
    include_once "../../app/config.php";
    include_once "../../app/users/ClientsController.php";

    if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
      if (isset($_GET['id'])){
          $id = $_GET['id'];
          $controlador = new ClientsController();
          $response = json_decode(json_encode($controlador->getClientById($id)));
          if ($response->success) {
              $client = $response->data;
          }else{
              header('Location: '. BASE_PATH);
          }
      }else{
          header('Location: '. BASE_PATH);
      }
    }else{
      header('Location: ');
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
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>customer">Clientes</a></li>
                  <li class="breadcrumb-item" aria-current="page">Editar clientes</li>
                  </ul>
                </div>
                <div class="col-md-12">
                  <div class="page-header-title">
                  <h2 class="mb-0">Editar cliente</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- [ breadcrumb ] end -->
          <!-- [ Main Content ] start -->
          <div class="row">
          <div class="col-12">
              <form id="formUpdate" method="POST" class="card">
                <div class="card-header">
                <h5 class="mb-0">Información del cliente</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Primer nombre</label>
                        <input type="text" class="form-control" placeholder="Enter first name" name="name" value="<?= $client->name ?? " " ?>" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" placeholder="Enter last name" name="email" value="<?= $client->email ?? " " ?>" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Número teléfonico</label>
                        <input type="number" class="form-control" placeholder="Enter email" name="phone_number" value="<?= $client->phone_number ?? " " ?>" required />
                      </div>
                      </div>
                      <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Esta suscrito</label>
                        <select class="form-control" id="level" name="is_suscribed" required>
                          <?php if ($client->is_suscribed==0): ?>
                            <option selected value="0">No</option>
                            <option value="1">Sí</option>
                          <?php else: ?>
                            <option value="0">No</option>
                            <option selected value="1">Sí</option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>
                      <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Nivel</label>
                        <select class="form-control" id="level" name="level_id" required>
                          <?php if ($client->level_id==1): ?>
                            <option selected value="1">Normal</option>
                            <option value="2">Premium</option>
                            <option value="3">VIP</option>
                            <option value="5">GOOD</option>
                          <?php elseif ($client->level_id==2): ?>
                            <option value="1">Normal</option>
                            <option selected value="2">Premium</option>
                            <option value="3">VIP</option>
                            <option value="5">GOOD</option>
                          <?php elseif ($client->level_id==3): ?>
                            <option value="1">Normal</option>
                            <option value="2">Premium</option>
                            <option selected value="3">VIP</option>
                            <option value="5">GOOD</option>
                          <?php else: ?>
                            <option value="1">Normal</option>
                            <option value="2">Premium</option>
                            <option value="3">VIP</option>
                            <option selected value="5">GOOD</option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12 text-end">
                      <button onclick="updateClient()" class="btn btn-primary">Editar cliente</button>
                      <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                      <input type="hidden" name="action" value="update_client">
                      <input type="hidden" name="id" value="<?= $client->id ?>">
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

        function updateClient(){
          let formData = document.getElementById("formUpdate");

          if (formData.checkValidity()){
              let form = new FormData(formData);

              //form.submit();

              fetch('<?= BASE_PATH ?>clients', {
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
                      swal("Ocurrio un error", "No fue posible actualizar el cliente");
                      throw new Error('Error en el servidor: ' + response.status);
                  }
              })
              .then(data => {
                  if (data?.error) {
                      swal("Ocurrio un error", "No fue posible actualizar el cliente");
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