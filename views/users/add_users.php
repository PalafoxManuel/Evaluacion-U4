<?php
    session_start(); 
    include_once "../../app/config.php";

    if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
        //no hace nada
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
                    <li class="breadcrumb-item" aria-current="page">Alta de usuario</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                    <h2 class="mb-0">Alta de usuario</h2>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
            <div class="col-12">
                <form id="formCreate" enctype="multipart/form-data" class="card" method="POST">
                <div class="card-header">
                    <h5 class="mb-0">Información del usuario</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label">Primer nombre</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter first name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input name="lastname" type="text" class="form-control" placeholder="Enter last name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="form-label">Número de telefono</label>
                        <input name="phone_number" type="number" class="form-control" placeholder="Enter Mobile number" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                        <input type="file" name="profile_photo_file" accept="image/png, image/jpeg" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-md-12 text-end">
                        <button onclick="createUser()" type="button" name="action" class="btn btn-primary">Crear usuario</button>
                        <input type="hidden" name="action" value="create_user">
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


        function createUser(){
            let formData = document.getElementById("formCreate");

            if (formData.checkValidity()){
                let form = new FormData(formData);

                //form.submit();

                fetch('<?= BASE_PATH ?>users', {
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
                        swal("Ocurrio un error", "No fue posible crear al usuario");
                        throw new Error('Error en el servidor: ' + response.status);
                    }
                })
                .then(data => {
                    if (data?.error) {
                        swal("Ocurrio un error", "No fue posible crear al usuario");
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
        </script>
        <?php 

        include "../layouts/modals.php";

        ?>
    </body>
    <!-- [Body] end -->
    </html>