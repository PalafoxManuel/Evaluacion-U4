<!-- [ Pre-loader ] start -->
<div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->
     <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
      <div class="navbar-wrapper">
        <div class="m-header">
          <a href="<?= BASE_PATH ?>home" class="b-brand text-primary">
            <!-- ========   Change your logo from here   ============ -->
            <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
            <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">Team Ivan Guapo Rios</span>
          </a>
        </div>
        <div class="navbar-content">
          <ul class="pc-navbar">
            <li class="pc-item pc-caption">
              <label>Gestion de usuarios</label>
              <i class="ph-duotone ph-chart-pie"></i>
            </li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Usuarios</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>users/add_users">Alta de usuarios</a></li>
                <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>users">Todos los usuarios</a></li>
              </ul>
            </li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-user-circle"></i>
                </span>
                <span class="pc-mtext">Clientes</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>customer">Lista clientes</a></li>
              </ul>
            </li>
            <li class="pc-item pc-caption">
              <label>Gestion de productos</label>
              <i class="ph-duotone ph-buildings"></i>
            </li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-shopping-cart"></i>
                </span>
                <span class="pc-mtext">Productos</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>products">Productos</a></li>
                <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>products/add_product">Alta de producto</a></li>
              </ul>
            </li>
             <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-books"></i>
                </span>
                <span class="pc-mtext">Cátalogos</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>catalogs/categories">CRUD de Categorías</a></li>
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>catalogs/brands">CRUD de Marcas</a></li>
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>catalogs/tags">CRUD de Tags</a></li>
              </ul>
            </li>
            </li>
             <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-tag"></i>
                </span>
                <span class="pc-mtext">Cupones</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>coupons">Todos los cupones</a></li>
              </ul>
            </li>
            </li>
             <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-basket  "></i>
                </span>
                <span class="pc-mtext">Ordenes</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>orders">Todas las ordenes</a></li>
              </ul>
            </li>
            <li class="pc-item pc-caption">
              <label>Pages</label>
              <i class="ph-duotone ph-devices"></i>
            </li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-shield-checkered"></i>
                </span>
                <span class="pc-mtext">Authentication</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
              ></a>
              <ul class="pc-submenu">
                <li class="pc-item pc-hasmenu">
                  <a href="#!" class="pc-link"
                    >Authentication 1<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                  ></a>
                  <ul class="pc-submenu">
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/login-v1.html">Login</a></li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/register-v1.html">Register</a></li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/forgot-password-v1.html">Forgot Password</a></li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/reset-password-v1.html">reset password</a> </li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/code-verification-v1.html">code verification</a></li>
                  </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                  <a href="#!" class="pc-link"
                    >Authentication 2<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                  ></a>
                  <ul class="pc-submenu">
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/login-v2.html">Login</a></li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/register-v2.html">Register</a></li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/forgot-password-v2.html">Forgot password</a> </li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/reset-password-v2.html">reset password</a> </li>
                    <li class="pc-item"><a class="pc-link" target="_blank" href="../pages/code-verification-v2.html">code verification</a></li>
                  </ul>
                </li>
                <li class="pc-item"><a class="pc-link" href="../pages/login-modal.html">Login Modal</a></li>
              </ul>
            </li>
        </div>
        <div class="card pc-user-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <img
                  src="<?= $_SESSION['user_data']->avatar ?>"
                  alt="user-image"
                  class="user-avtar wid-45 rounded-circle"
                  onerror="this.onerror=null; this.src='<?= BASE_PATH . "assets/images/user/avatar-2.jpg" ?>';"
                />
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="dropdown">
                  <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1 me-2">
                        <h6 class="mb-0"><?= $_SESSION['user_data']->name ?? "" ?></h6>
                        <small></small>
                      </div>
                      <div class="flex-shrink-0">
                        <div class="btn btn-icon btn-link-secondary avtar">
                          <i class="ph-duotone ph-windows-logo"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu">
                    <ul>
                      <li>
                        <a href="<?= BASE_PATH ?>users/<?= $_SESSION['user_id'] ?>" class="pc-user-links">
                          <i class="ph-duotone ph-user"></i>
                          <span>My Account</span>
                        </a>
                      </li>
                      <li>
                        <a class="pc-user-links">
                          <i class="ph-duotone ph-gear"></i>
                          <span>Settings</span>
                        </a>
                      </li>
                      <li>
                        <a class="pc-user-links">
                          <i class="ph-duotone ph-lock-key"></i>
                          <span>Lock Screen</span>
                        </a>
                      </li>
                      <li>
                        <button onclick="Logout()" type="button" class="pc-user-links">
                          <i class="ph-duotone ph-power"></i>
                          <span>Logout</span>
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <form id="logout" method="POST" action="<?= BASE_PATH ?>auth">
      <input type="hidden" name="action" value="logout">
    </form>
    <script>
      function Logout(){
        document.getElementById("logout").submit();
      };
    </script>
    <!-- [ Sidebar Menu ] end -->