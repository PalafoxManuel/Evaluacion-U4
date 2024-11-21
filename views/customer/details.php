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
        header('Location: '. BASE_PATH);
    }

    function totalWidget($client){
      $totalWidget = 0;
      if ($client->orders){
        foreach ($client->orders as $order){
          if ($order->is_paid != 0){
            $totalWidget += $order->total;
          }
        }
      }
      return $totalWidget;
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
              <div
                class="modal fade"
                id="createModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"
                        ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Añadir una dirección</h5
                      >
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <form id="formCreate" method="POST">
                      <div class="modal-body">
                        <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                          >Completa la información solicitada en el formulario</small
                        >
                        <div class="mb-3">
                          <label class="form-label">Nombre</label>
                          <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            id="fname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese el nombre"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Apellidos</label>
                          <input
                            type="text"
                            name="last_name"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese los apellidos"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Calle y número</label>
                          <input
                            type="text"
                            name="street_and_use_number"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su calle y número residencial"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Código postal</label>
                          <input
                            type="number"
                            name="postal_code"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su código postal"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Ciudad</label>
                          <input
                            type="text"
                            name="city"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su ciudad"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Estado</label>
                          <input
                            type="text"
                            name="province"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su estado"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Número de teléfono</label>
                          <input
                            type="number"
                            name="phone_number"
                            class="form-control"
                            id="lname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su número teléfonico"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Es la dirección de factura</label>
                          <select class="form-control" id="level" name="is_billing_address" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button onclick="createAddress()" type="button" class="btn btn-light-primary">Añadir tag</button>
                        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                        <input type="hidden" name="action" value="create_address">
                        <input type="hidden" name="client_id" value="<?= $client->id ?>">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div
                class="modal fade"
                id="updateModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"
                        ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Editar una dirección</h5
                      >
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <form id="formUpdate" method="POST">
                      <div class="modal-body">
                        <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                          >Completa la información solicitada en el formulario</small
                        >
                        <div class="mb-3">
                          <label class="form-label">Nombre</label>
                          <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            id="UpdateName"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese el nombre"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Apellidos</label>
                          <input
                            type="text"
                            name="last_name"
                            class="form-control"
                            id="UpdateLastname"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese los apellidos"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Calle y número</label>
                          <input
                            type="text"
                            name="street_and_use_number"
                            class="form-control"
                            id="UpdateStreet_and_use_number"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su calle y número residencial"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Código postal</label>
                          <input
                            type="number"
                            name="postal_code"
                            class="form-control"
                            id="UpdatePostal_code"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su código postal"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Ciudad</label>
                          <input
                            type="text"
                            name="city"
                            class="form-control"
                            id="UpdateCity"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su ciudad"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Estado</label>
                          <input
                            type="text"
                            name="province"
                            class="form-control"
                            id="UpdateProvince"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su estado"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Número de teléfono</label>
                          <input
                            type="number"
                            name="phone_number"
                            class="form-control"
                            id="UpdatePhone_number"
                            aria-describedby="emailHelp"
                            placeholder="Ingrese su número teléfonico"
                            required
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Es la dirección de factura</label>
                          <select class="form-control" id="UpdateIs_billing_address" name="is_billing_address" required>
                            <option id="UpdateValue1" value="1">Sí</option>
                            <option id="UpdateValue0" value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button onclick="updateAddress()" type="button" class="btn btn-light-primary">Añadir tag</button>
                        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                        <input type="hidden" name="action" value="create_address">
                        <input type="hidden" name="client_id" value="<?= $client->id ?>">
                        <input type="hidden" name="id">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
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
                        <h5 class="mb-0"><?= $client->name ?? " " ?></h5>
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
                      <h3 class="f-w-300 d-flex align-items-center m-b-0">$<?= totalWidget($client) ?></h3>
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
                                <p class="mb-0"><?= $client->name ?? " " ?></p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de teléfono</p>
                                <p class="mb-0"><?= $client->phone_number ?? " " ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Email</p>
                                <p class="mb-0"><?= $client->email ?? " " ?></p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Nivel</p>
                                <p class="mb-0"><?= $client->level->name ?? " " ?></p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      </div>
                      </div>
                      </div>

                      <h5>Direcciones registradas</h5>
                      <div class="card">
                        <div class="card-body">
                          <?php foreach ($client->addresses as $address): ?>
                            <l class="list-group list-group-flush">
                              <li class="list-group-item px-0">
                                <div class="row">
                                  <div class="col-md-6">
                                    <p class="mb-1 text-muted">Calle</p>
                                    <p class="mb-0"><?= $address->street_and_use_number ?? " " ?></p>
                                  </div>
                                  <div class="col-md-6">
                                    <p class="mb-1 text-muted">Ciudad</p>
                                    <p class="mb-0"><?= $address->city ?? " " ?></p>
                                  </div>
                                </div>
                              </li>
                              <li class="list-group-item px-0">
                                <div class="row">
                                  <div class="col-md-6">
                                    <p class="mb-1 text-muted">Estado</p>
                                    <p class="mb-0"><?= $address->province ?? " " ?></p>
                                  </div>
                                  <div class="col-md-6">
                                    <p class="mb-1 text-muted">Código Postal</p>
                                    <p class="mb-0"><?= $address->postal_code ?? " " ?></p>
                                  </div>
                                </div>
                              </li>
                              <li class="list-group-item px-0">
                                <div class="row">
                                  <div class="col-md-4">
                                    <button onclick="getAddress(<?= $address->id ?>)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal">Editar Dirección</button>
                                    <button onclick="deleteAddress(<?= $address->id ?>,'<?= $address->street_and_use_number ?>')" class="btn btn-danger btn-sm">Eliminar Dirección</button>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          <?php endforeach; ?>
                          <div class="mt-3">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Añadir Dirección</button>
                          </div>
                        </div>
                      </div>

                      <h5>Lista de Órdenes</h5>
                      <div class="card">
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            <?php foreach ($client->orders as $order): ?>
                              <li class="list-group-item px-0">
                                <div class="row">
                                  <div class="col-md-4">
                                    <p class="mb-1 text-muted">Orden</p>
                                    <p class="mb-0">Folio: <?= $order->folio ?? " " ?></p>
                                  </div>
                                  <div class="col-md-4">
                                    <p class="mb-1 text-muted">Total</p>
                                    <p class="mb-0">$ <?= $order->total ?? " " ?></p>
                                  </div>
                                  <div class="col-md-4">
                                    <p class="mb-1 text-muted">Estado</p>
                                    <p class="mb-0 text-primary"><?= $order->order_status->name ?? "Desconocido" ?></p>
                                  </div>
                                </div>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>


            <!-- [ sample-page ] end -->
          </div>
          <!-- [ Main Content ] end -->
        </div>
      </div>

      <form id="deleteForm" method="POST" action="<?= BASE_PATH ?>app/users/AddressController.php">
        <input type="hidden" name="action" value="delete_address">
        <input id="id_delete" type="hidden" name="address_id">
        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
      </form>

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

      function createAddress(){
        let formData = document.getElementById("formCreate");

        if (formData.checkValidity()){
            let form = new FormData(formData);

            //form.submit();

            fetch('<?= BASE_PATH ?>app/users/AddressController.php', {
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
                        return response.json();
                    }
                }else{
                  console.log(response.text());
                    swal("Ocurrio un error", "No fue posible crear la nueva dirección");
                    throw new Error('Error en el servidor: ' + response.status);
                }
            })
            .then(data => {
                if (data?.error) {
                    swal("Ocurrio un error", "No fue posible crear la nueva dirección");
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
      
      function updateAddress(){
        //
      }

      function getAddress(id){
        swal("Ocurrio un error", "No fue posible editar");
        /*let form = new FormData();
        form.append('address_id', id);
        form.append('action', 'get_address_by_id');
        form.append('global_token', '<?= $_SESSION['global_token'] ?>');

        fetch('<?= BASE_PATH ?>app/users/AddressController.php', {
            method: 'POST',
            body: form,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status} ${response.statusText}`);
            }
            return response.text();
        })
        .then(text => {
            console.log('Respuesta del servidor:', text);
            try {
                const data = JSON.parse(text); // Intenta convertir el texto a JSON
                console.log('Datos JSON:', data);
            } catch (error) {
                throw new Error('La respuesta no es un JSON válido');
            }
        })
        .catch(error => {
            console.error(error);
        })*/
      }

      function deleteAddress(id, name){
        swal({
          title: "¿Eliminar a "+name+"?",
          text: "Esta acción sera permanente",
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

              fetch('<?= BASE_PATH ?>app/users/AddressController.php', {
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
                      swal("Ocurrio un error", "No fue posible eliminar la marca");
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

    </body>
    <!-- [Body] end -->
  </html>