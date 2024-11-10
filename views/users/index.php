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
                      <tr>
                        <td>
                          <a href="<?= BASE_PATH ?>users/details" style="text-decoration: none; color: inherit;">
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-1.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Taylor Morgan</h6>
                              <p class="m-b-0 text-primary">Full Stack developer</p>
                            </div>
                          </div>
                        </td>
                        <td>Project manager</td>
                        <td>34</td>
                        <td>2015/08/19</td>
                        <td>
                          <span class="badge bg-light-success">Active</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="<?= BASE_PATH ?>users/edit-users" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-2.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Alex Rivera</h6>
                              <p class="m-b-0 text-primary">Data analyst</p>
                            </div>
                          </div>
                        </td>
                        <td>Team leader</td>
                        <td>29</td>
                        <td>2018/03/14</td>
                        <td>
                          <span class="badge bg-light-danger">Disabled</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="<?= BASE_PATH ?>users/edit-users" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-3.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Jordan Lee</h6>
                              <p class="m-b-0 text-primary">UI/UX Designer</p>
                            </div>
                          </div>
                        </td>
                        <td>Product designer</td>
                        <td>45</td>
                        <td>2010/12/05</td>
                        <td>
                          <span class="badge bg-light-danger">Disabled</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-4.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Sydney Wong</h6>
                              <p class="m-b-0 text-primary">Frontend Engineer</p>
                            </div>
                          </div>
                        </td>
                        <td>Senior Developer</td>
                        <td>30</td>
                        <td>2017/09/21</td>
                        <td>
                          <span class="badge bg-light-success">Active</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-4.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Chris Parker</h6>
                              <p class="m-b-0 text-primary">DevOps Specialist</p>
                            </div>
                          </div>
                        </td>
                        <td>Infrastructure Lead</td>
                        <td>33</td>
                        <td>2012/06/11</td>
                        <td>
                          <span class="badge bg-light-success">Active</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img
                              src="../assets/images/user/avatar-5.jpg"
                              alt="user image"
                              class="img-radius align-top m-r-15"
                              style="width: 40px"
                            />
                            <div class="d-inline-block">
                              <h6 class="m-b-0">Riley Smith</h6>
                              <p class="m-b-0 text-primary">Machine Learning Engineer</p>
                            </div>
                          </div>
                        </td>
                        <td>Data Science Lead</td>
                        <td>35</td>
                        <td>2013/10/14</td>
                        <td>
                          <span class="badge bg-light-danger">Disabled</span>
                          <div class="overlay-edit">
                            <ul class="list-inline mb-0">
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a
                              ></li>
                              <li class="list-inline-item m-0"
                                ><a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a
                              ></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
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