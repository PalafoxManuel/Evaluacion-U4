  <?php 
    include_once "../../app/config.php";
    include_once "../../app/users/ClientsController.php";

    if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
      $controlador = new ClientsController();
      $response = json_decode(json_encode($controlador->get()));
      $clients = $response->data;
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
                          <form id="formCreate" method="POST">
                            <div class="modal-body">
                              <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                                >Proporcione la información requerida en el formulario.</small
                              >
                              <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input
                                  type="text"
                                  name="name"
                                  class="form-control"
                                  id="fname"
                                  aria-describedby="emailHelp"
                                  placeholder="Ingresa el nombre"
                                  required
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input
                                  type="email"
                                  name="email"
                                  class="form-control"
                                  id="emial"
                                  aria-describedby="emailHelp"
                                  placeholder="Ingresa el correo" 
                                  required
                                />
                              </div>
                              <div class="mb-3">
                              <label class="form-label">Número de teléfono</label>
                              <input
                                type="tel"
                                name="phone_number"
                                class="form-control"
                                id="phone"
                                placeholder="Ingresa el número de teléfono"
                                pattern="[0-9]{10}"
                                required
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Suscrito</label>
                              <select class="form-control" id="level" name="is_suscribed" required>
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nivel</label>
                              <select class="form-control" id="level" name="level_id" required>
                                <option value="1">Normal</option>
                                <option value="2">Premium</option>
                                <option value="3">VIP</option>
                                <option value="5">GOOD</option>
                              </select>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                              <button onclick="createClient()" type="button" class="btn btn-light-primary">Agregar cliente</button>
                              <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                              <input type="hidden" name="action" value="create_client">
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
                          <th class="border-top-0">Nombre</th>
                          <th class="border-top-0">Email</th>
                          <th class="border-top-0">Numero telefono</th>
                          <th class="border-top-0">Nivel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($clients as $client): ?>
                          <tr>
                            <td><?= $client->name ?? " " ?></td>
                            <td><?= $client->email ?? " " ?></td>
                            <td><?= $client->phone_number ?? " " ?></td>
                            <td><?= $client->level->name ?? " " ?></td>
                            <td>
                              <a href="<?= BASE_PATH ?>customer/<?= $client->id ?>" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                              <a href="<?= BASE_PATH ?>customer/edit_customer/<?= $client->id ?>" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                              <button onclick="deleteClient(<?= $client->id ?>,'<?= $client->name ?>')" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
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

      <form id="deleteForm" method="POST" action="<?= BASE_PATH ?>clients">
        <input type="hidden" name="action" value="delete_client">
        <input id="id_delete" type="hidden" name="client_id">
        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
      </form>

      <?php 

        include "../layouts/footer.php";

        ?>

      <?php 

        include "../layouts/scripts.php";

        ?>
      <!-- [Page Specific JS] start -->
      <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
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

        function createClient(){
          let formData = document.getElementById("formCreate");

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
                          sweetAlert("ÉXITO", "Se creo de forma correcta", "success");
                          window.location.href = response.url
                          return;
                      }else{
                          return response.text();
                      }
                  }else{
                      swal("Ocurrio un error", "No fue posible crear al nuevo cliente");
                      throw new Error('Error en el servidor: ' + response.status);
                  }
              })
              .then(data => {
                  if (data?.error) {
                      swal("Ocurrio un error", "No fue posible crear al nuevo cliente");
                      console.error(data.error);
                  }
              })
              .catch(error => {
                  console.error("Error: ",error);
              })
          }else{
              sweetAlert("Error al ingresador los datos", "Llene todos los campos y verifique que sean datos validos", "error");
          }
        }

        function deleteClient(id, name){
        swal({
          title: "¿Eliminar a "+name+"?",
          text: "Esta acción será permanente",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, eliminar!",
          closeOnConfirm: false
        },
        function(){
          document.getElementById("id_delete").value = id;

          let formData = document.getElementById("deleteForm");

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
                          sweetAlert("ÉXITO", "Se elimino de forma correcta", "success");
                          window.location.href = response.url
                          return;
                      }else{
                          return response.json();
                      }
                  }else{
                      throw new Error('Error en el servidor: ' + response.status);
                  }
              })
              .then(data => {
                  if (data?.success) {
                      swal("Ocurrio un error", "No fue posible eliminar al cliente");
                      console.error(data.error);
                  }
              })
              .catch(error => {
                  console.error("Error: ",error);
              })
            }else{
                sweetAlert("Error al ingresador los datos", "Llene todos los campos y verifique que sean datos validos", "error");
            }
        });
      }

      </script>
      
      <?php 

        include "../layouts/modals.php";

        ?>

    </body>
    <!-- [Body] end -->
  </html>