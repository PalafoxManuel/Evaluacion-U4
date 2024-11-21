<?php 
  include_once "../../../app/config.php";
  include_once "../../../app/products/TagsController.php";

  if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
      $controlador = new TagsController();
      $tags = $controlador->getTags();
  }else{
      header('Location: '. BASE_PATH);
  }

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
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>catalogs/tags">Tags</a></li>
                  <li class="breadcrumb-item" aria-current="page">Todos los tags</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Tags</h2>
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
                <h5>Tags</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Añadir tags
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
                            ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Añadir tags</h5
                          >
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form id="formCreate" method="POST">
                          <div class="modal-body">
                            <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                              >Completa la información solicitada en el formulario</small
                            >
                            <div class="mb-3">
                              <label class="form-label">Nombre de tag</label>
                              <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="fname"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese el nombre de tag"
                                required
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Descripción del tag</label>
                              <input
                                type="text"
                                name="description"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese la descripción del tag"
                                required
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Slug</label>
                              <input
                                type="text"
                                name="slug"
                                class="form-control"
                                id="lname"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese el slug"
                                required
                              />
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button onclick="createTag()" type="button" class="btn btn-light-primary">Añadir tag</button>
                            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                            <input type="hidden" name="action" value="create_tag">
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
                            ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Editar tag</h5
                          >
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form id="formUpdate" method="POST">
                          <div class="modal-body">
                            <small id="emailHelp" class="form-text text-muted mb-2 mt-0"
                              >Completa la información solicitada en el formulario</small
                            >
                            <div class="mb-3">
                              <label class="form-label">Nombre del tag</label>
                              <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="UpdateName"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese el nombre del tag"
                                required
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Descripción del tag</label>
                              <input
                                type="text"
                                name="description"
                                class="form-control"
                                id="UpdateDescription"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese la descripción del tag"
                                required
                              />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Slug</label>
                              <input
                                type="text"
                                name="slug"
                                class="form-control"
                                id="UpdateSlug"
                                aria-describedby="emailHelp"
                                placeholder="Ingrese el slug"
                                required
                              />
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button onclick="updateTag()" type="button" class="btn btn-light-primary">Editar tag</button>
                            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
                            <input type="hidden" name="action" value="update_tag">
                            <input id="UpdateId" type="hidden" name="id">
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
                        <th class="border-top-0">Nombre tag </th>
                        <th class="border-top-0">Descripción</th>
                        <th class="border-top-0">Slug</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tags as $tag): ?>
                        <tr>
                          <td><?= $tag->name ?></td>
                          <td><?= $tag->description ?></td>
                          <td><?= $tag->slug ?></td>
                          <td>
                            <a href="<?= BASE_PATH ?>catalogs/tags/details/<?= $tag->id ?>" class="btn btn-sm btn-light-primary"><i class="feather icon-eye"></i></a>
                            <button onclick="getTag(<?= $tag->id ?>)" type="button" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#editModal">
                              <i class="feather icon-edit"></i>
                            </button>
                            <button onclick="deleteTag(<?= $tag->id ?>,'<?= $tag->name ?>')" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></button>
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

    <form id="deleteForm" method="POST" action="<?= BASE_PATH ?>brands">
      <input type="hidden" name="action" value="delete_tag">
      <input id="id_delete" type="hidden" name="id">
      <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
    </form>

    <?php 

      include "../../../views/layouts/footer.php";

      ?>

    <?php 

      include "../../../views/layouts/scripts.php";

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

      function createTag(){
        let formData = document.getElementById("formCreate");

        if (formData.checkValidity()){
            let form = new FormData(formData);

            //form.submit();

            fetch('<?= BASE_PATH ?>tags', {
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
                    swal("Ocurrio un error", "No fue posible crear el nuevo tag");
                    throw new Error('Error en el servidor: ' + response.status);
                }
            })
            .then(data => {
                if (data?.error) {
                    swal("Ocurrio un error", "No fue posible crear el nuevo tag");
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

      function updateTag(){
        let formData = document.getElementById("formUpdate");

        if (formData.checkValidity()){
            let form = new FormData(formData);

            //form.submit();

            fetch('<?= BASE_PATH ?>tags', {
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
                    swal("Ocurrio un error", "No fue posible actualizar el tag");
                    throw new Error('Error en el servidor: ' + response.status);
                }
            })
            .then(data => {
                if (data?.error) {
                    swal("Ocurrio un error", "No fue posible actualizar el tag");
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

      function deleteTag(id, name){
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

              fetch('<?= BASE_PATH ?>tags', {
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

      function getTag(id){
        let form = new FormData();
        form.append('id', id);
        form.append('action', 'get_tag_by_id');
        form.append('global_token', '<?= $_SESSION['global_token'] ?>');
        fetch('<?= BASE_PATH ?>tags', {
            method: 'POST',
            body: form,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            let datos = data.data.data;
            if (data.success){
                document.getElementById("UpdateName").value = (datos.name!=undefined)? datos.name : " " ;
                document.getElementById("UpdateDescription").value = (datos.description!=undefined)? datos.description : " " ;
                document.getElementById("UpdateSlug").value = (datos.slug!=undefined)? datos.slug : " " ;
                document.getElementById("UpdateId").value = (datos.id!=undefined)? datos.id : 0 ;
            }else{
                swal("Error", "No se pudo obtener la información solicitada", "error")
            }
        })
        .catch(error => {
            console.error(error);
        }) 
      }

    </script>
    
    <?php 

      include "../../../views/layouts/modals.php";


      ?>

  </body>
  <!-- [Body] end -->
</html>