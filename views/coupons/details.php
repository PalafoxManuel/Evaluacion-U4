<?php 
  include_once "../../app/config.php";

?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
  <?php 
    include "../../views/layouts/head.php";
  ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <?php 

      include "../../views/layouts/sidebar.php";

    ?>

    <?php 

      include "../../views/layouts/nav.php";

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
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>views/coupons/coupons">Cupon</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalles de cupon</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalles de cupon</h2>
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
                          class="rounded-circle img-fluid wid-90 img-thumbnail"
                          src="../assets/images/user/avatar-1.jpg"
                          alt="User image"
                        />
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                      </div>
                      <h5 class="mb-0">Rick G</h5>
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
                      <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Visualización de cupon</span>
                    </a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                  <h5>Detalles personales</h5>
                  </div>
                  <div class="card-body position-relative">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <p class="mb-0 text-muted me-1">Correo electrónico</p>
                      <p class="mb-0">Garay2026@gmail.com</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <p class="mb-0 text-muted me-1">Número de telefono</p>
                      <p class="mb-0">(+52) 613 118 6794</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-xxl-9">
                <div class="tab-content" id="user-set-tabContent">
                  <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                    <div class="card">
                      <div class="card-header">
                        <h5>Detalles personales</h5>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre</p>
                                <p class="mb-0">Rick</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Apellidos</p>
                                <p class="mb-0">Garay</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de telefono</p>
                                <p class="mb-0">(+52) 613 118 6794</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Género</p>
                                <p class="mb-0">Masculino</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p<p class="mb-1 text-muted">Correo electrónico</p>
                                <p class="mb-0">Garay2026@gmail.com</p>
                              </div>
                              <div class="col-md-6">
                               <p class="mb-1 text-muted">Fecha de nacimiento</p>
                               <p class="mb-0">21/10/1985</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pb-0">
                            <p class="mb-1 text-muted">Fecha de inicio en la empresa</p>
                            <p class="mb-0">22/03/2026</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card statistics-card-1 overflow-hidden">
                    <div class="card-body">
                        <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
                        <h5 class="mb-4">Descuento aplicado</h5>
                        <div class="d-flex align-items-center mt-3">
                            <h3 class="f-w-300 d-flex align-items-center m-b-0">$199.99</h3>
                            <span class="badge bg-light-success ms-2">36%</span>
                        </div>
                        <p class="text-muted mb-2 text-sm mt-3">Has ahorrado 45,000 pesos con un descuento del 20%</p>

                        <div class="progress" style="height: 7px">
                        <div
                            class="progress-bar bg-brand-color-3"
                            role="progressbar"
                            style="width: 75%"
                            aria-valuenow="75"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        ></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                <div class="card-header">
                <h5>Listado de órdenes con cupón aplicado</h5>
                <small>
                    Los eventos asignados a la tabla pueden ser de gran utilidad para la interacción del usuario; 
                    sin embargo, es importante tener en cuenta que DataTables añadirá y eliminará filas del DOM.
                </small>

                    >
                </div>
                <div class="card-body">
                    <div class="dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Sucursal</th>
                        <th>Edad</th>
                        <th>Fecha de inicio</th>
                        <th>Salario</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Marcos Rivera</td>
                        <td>Desarrollador Full Stack</td>
                        <td>México</td>
                        <td>28</td>
                        <td>2020/05/11</td>
                        <td>$120,500</td>
                    </tr>
                    <tr>
                        <td>Sofía Vargas</td>
                        <td>Analista de Datos</td>
                        <td>Buenos Aires</td>
                        <td>34</td>
                        <td>2019/08/07</td>
                        <td>$98,300</td>
                    </tr>
                    <tr>
                        <td>Diego Hernández</td>
                        <td>Ingeniero de Software</td>
                        <td>Bogotá</td>
                        <td>30</td>
                        <td>2018/03/22</td>
                        <td>$110,800</td>
                    </tr>
                    <tr>
                        <td>Carla Moreno</td>
                        <td>Gerente de Producto</td>
                        <td>Lima</td>
                        <td>42</td>
                        <td>2015/07/14</td>
                        <td>$150,000</td>
                    </tr>
                    <tr>
                        <td>Jorge Pérez</td>
                        <td>Especialista en Seguridad</td>
                        <td>Santiago</td>
                        <td>37</td>
                        <td>2016/11/03</td>
                        <td>$105,500</td>
                    </tr>
                    <tr>
                        <td>Lucía Martínez</td>
                        <td>Consultora de Negocios</td>
                        <td>Madrid</td>
                        <td>46</td>
                        <td>2017/04/18</td>
                        <td>$135,200</td>
                    </tr>
                    <tr>
                        <td>Fernando Gómez</td>
                        <td>Desarrollador Front-End</td>
                        <td>Barcelona</td>
                        <td>26</td>
                        <td>2021/09/30</td>
                        <td>$78,600</td>
                    </tr>
                    <tr>
                        <td>Camila Torres</td>
                        <td>Diseñadora UX/UI</td>
                        <td>Lisboa</td>
                        <td>32</td>
                        <td>2018/01/20</td>
                        <td>$115,000</td>
                    </tr>
                    <tr>
                        <td>Juan López</td>
                        <td>Administrador de Redes</td>
                        <td>Montevideo</td>
                        <td>29</td>
                        <td>2020/12/12</td>
                        <td>$92,700</td>
                    </tr>
                    <tr>
                        <td>Claudia Rojas</td>
                        <td>Directora de Marketing</td>
                        <td>Buenos Aires</td>
                        <td>39</td>
                        <td>2014/05/25</td>
                        <td>$200,400</td>
                    </tr>
                    <tr>
                        <td>Manuel Silva</td>
                        <td>Desarrollador Back-End</td>
                        <td>Caracas</td>
                        <td>27</td>
                        <td>2019/11/19</td>
                        <td>$82,400</td>
                    </tr>
                    <tr>
                        <td>Laura Fuentes</td>
                        <td>Directora Regional</td>
                        <td>Santiago</td>
                        <td>50</td>
                        <td>2010/02/10</td>
                        <td>$260,000</td>
                    </tr>
                    <tr>
                        <td>Eduardo García</td>
                        <td>Ingeniero de Datos</td>
                        <td>Madrid</td>
                        <td>44</td>
                        <td>2012/06/17</td>
                        <td>$190,900</td>
                    </tr>
                    <tr>
                        <td>Beatriz Jiménez</td>
                        <td>Consultora de TI</td>
                        <td>Lima</td>
                        <td>41</td>
                        <td>2016/10/05</td>
                        <td>$128,750</td>
                    </tr>
                    <tr>
                        <td>Ricardo Sánchez</td>
                        <td>Jefe de Proyectos</td>
                        <td>Guayaquil</td>
                        <td>36</td>
                        <td>2013/03/29</td>
                        <td>$145,000</td>
                    </tr>
                    <tr>
                        <td>Valeria Castillo</td>
                        <td>Especialista en Inteligencia de Negocios</td>
                        <td>Quito</td>
                        <td>48</td>
                        <td>2011/09/15</td>
                        <td>$215,800</td>
                    </tr>
                    <tr>
                        <td>Gabriel Muñoz</td>
                        <td>Desarrollador de Apps</td>
                        <td>Santiago</td>
                        <td>25</td>
                        <td>2021/08/06</td>
                        <td>$95,600</td>
                    </tr>
                    <tr>
                        <td>Sandra Ortiz</td>
                        <td>Analista de Sistemas</td>
                        <td>Montevideo</td>
                        <td>34</td>
                        <td>2013/02/14</td>
                        <td>$88,900</td>
                    </tr>
                    <tr>
                        <td>Miguel Romero</td>
                        <td>Director Financiero (CFO)</td>
                        <td>São Paulo</td>
                        <td>56</td>
                        <td>2010/07/19</td>
                        <td>$325,000</td>
                    </tr>
                    <tr>
                        <td>Catalina Delgado</td>
                        <td>Jefa de Recursos Humanos</td>
                        <td>Bogotá</td>
                        <td>47</td>
                        <td>2012/10/22</td>
                        <td>$148,200</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Sucursal</th>
                        <th>Edad</th>
                        <th>Fecha de inicio</th>
                        <th>Salario</th>
                    </tr>

                        </tfoot>
                    </table>
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

    include "../../views/layouts/footer.php";

    ?>
    <?php 

    include "../../views/layouts/scripts.php";

    ?>
    <script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }
    </script>
    <?php 

    include "../../views/layouts/modals.php";

    ?>
  </body>

  </body>
  <!-- [Body] end -->
</html>