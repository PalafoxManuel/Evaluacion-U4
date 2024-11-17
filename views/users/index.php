<?php 
  include_once "../../app/config.php";
  include_once "../../app/users/UsersController.php";

  if (isset($_SESSION["user_id"]) && $_SESSION['user_id']!=null) {
    $controlador = new UsersController();
    $response = json_decode(json_encode($controlador->get()));
    $users = $response->data;
  }else{
    header('Location: home/');
  }

  function fecha($date){
    $bruto = new DateTime($date);
    return $bruto->format('Y/m/d');
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

  <body>
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
                  <li class="breadcrumb-item" aria-current="page">Lista de usuarios</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Lista de usuarios</h2>
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
            <div class="card border-0 table-card user-profile-list">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="pc-dt-simple">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Posición</th>
                        <th>Edad</th>
                        <th>Start date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                        <tr>
                          <td>
                            <div class="d-inline-block align-middle">
                              <img
                                src="<?= $user->avatar ?>"
                                alt="user image"
                                class="img-radius align-top m-r-15"
                                style="width: 40px"
                                onerror="this.onerror=null; this.src='<?= BASE_PATH . "assets/images/user/avatar-2.jpg" ?>';"
                              />
                              <div class="d-inline-block">
                                <h6 class="m-b-0"><?= $user->name ?></h6>
                                <p class="m-b-0 text-primary"><?= $user->role ?? "User" ?></p>
                              </div>
                            </div>
                          </td>
                          <td><?= $user->role ?? "User" ?></td>
                          <td>21</td>
                          <td><?= fecha($user->created_at) ?></td>
                          <td>
                            <span class="badge bg-light-success">Active</span>
                            <div class="overlay-edit">
                              <ul class="list-inline mb-0">
                                <li class="list-inline-item m-0"
                                  ><a href="<?= BASE_PATH ?>users/edit_users" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                                ></li>
                                <li class="list-inline-item m-0"
                                  ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                                ></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <script src="../assets/js/plugins/simple-datatables.js"></script>
    <script>
      const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
        sortable: false,
        perPage: 5
      });
    </script>
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