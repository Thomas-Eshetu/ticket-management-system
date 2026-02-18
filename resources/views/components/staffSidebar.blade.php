  <div class="sideBar">
      <div class="sidebarLinkContainer">
          <div class="sidebarLink">
              <a href="{{ route('staffDashboard') }}"><i class="fa-solid fa-dashboard me-2"></i> Dashboard</a>
          </div>
          <div class="sidebarLink">
              <a href="{{ route('createTicket') }}"><i class="fa-solid fa-plus me-2"></i> Create Ticket</a>
          </div>
          <div class="sidebarLink">
              <a href="{{ route('viewTicket') }}"><i class="fa-solid fa-ticket me-2"></i> View Ticket</a>
          </div>
      </div>

      <div class="logoutLink">
          <a href="{{ route('logout') }}"> Logout <i class="fa-solid fa-arrow-right-from-bracket text-danger ms-5"></i></a>
      </div>
  </div>
