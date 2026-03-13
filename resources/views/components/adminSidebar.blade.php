  <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
              <div class="nav">
                  <div class="sb-sidenav-menu-heading">Dashboard</div>
                  <a class="nav-link" href="{{ url('/admin-dashboard') }}">
                      <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      Dashboard
                  </a>
                  <div class="sb-sidenav-menu-heading">Management</div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                      data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                      User Management
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                      data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ url('/add-user') }}">Add User<i class="fa-solid fa-user-plus"></i></a>
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ url('/view-user') }}">View Users<i class="fas fa-eye"></i></a>
                      </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                      aria-expanded="false" aria-controls="collapsePages">
                      <div class="sb-nav-link-icon"><i class="fas fa-ticket"></i></div>
                      Ticket Management
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                      data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                              data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                              aria-controls="pagesCollapseAuth">
                              View Tickets
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuth" data-bs-parent="#sidenavAccordionPages">

                              <nav class="sb-sidenav-menu-nested nav">

                                  <a class="nav-link d-flex justify-content-between align-items-center"
                                      href="{{ route('admin.viewTicket', ['status' => 'active']) }}">
                                      Active<i class="fa-solid fa-circle-dot"></i>
                                  </a>

                                  <a class="nav-link d-flex justify-content-between align-items-center"
                                      href="{{ route('admin.viewTicket', ['status' => 'pending']) }}">
                                      Pending<i class="fa-regular fa-hourglass-half"></i>
                                  </a>

                                  <a class="nav-link d-flex justify-content-between align-items-center"
                                      href="{{ route('admin.viewTicket', ['status' => 'delayed']) }}">
                                      Delayed<i class="fa-solid fa-clock"></i>
                                  </a>

                                  <a class="nav-link d-flex justify-content-between align-items-center"
                                      href="{{ route('admin.viewTicket', ['status' => 'resolved']) }}">
                                      Resolved<i class="fa-solid fa-circle-check"></i>
                                  </a>

                              </nav>
                          </div>
                      </nav>
                  </div>

                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#purchasing"
                      aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                      Purchasing Mgt
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="purchasing" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ route('view.purchaser') }}">
                              Purchaser <i class="fa-regular fa-user"></i>
                          </a>
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ route('view.supplier') }}">
                              Supplier <i class="fa-regular fa-building"></i>
                          </a>
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ route('view.product') }}">
                              Product <i class="fa-brands fa-product-hunt"></i>
                          </a>
                          <a class="nav-link d-flex justify-content-between align-items-center"
                              href="{{ route('view.purchase') }}">
                              Purchase <i class="fa-solid fa-cart-plus"></i>
                          </a>
                      </nav>
                  </div>

                  <div class="sb-sidenav-menu-heading">Statistics</div>
                  <a class="nav-link" href="charts.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                      Charts
                  </a>
                  <a class="nav-link" href="tables.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Tables
                  </a>
              </div>
          </div>
          <div class="sb-sidenav-footer">
              <div class="small">Logged in as:</div>
              Administrator
          </div>
      </nav>
  </div>
