<template>
  <nav
    class="
      navbar navbar-light navbar-expand
      bg-red
      shadow
      mb-4
      topbar
      static-top
    "
  >
    <div class="container-fluid">
      <button
        class="btn btn-side-bar d-md-none rounded-circle mr-3"
        id="sidebarToggleTop"
        type="button"
      >
        <i class="fas fa-bars"></i>
      </button>
      <ul class="nav navbar-nav flex-nowrap ml-auto">
        <div class="d-none d-sm-block topbar-divider"></div>
        <li class="nav-item dropdown no-arrow">
          <div class="nav-item dropdown no-arrow">
            <a
              class="dropdown-toggle nav-link"
              data-toggle="dropdown"
              aria-expanded="false"
              href="#"
              ><span class="d-none d-lg-inline text-black-50 mr-2">usuairo</span
              ><img class="border rounded-circle img-profile"
            /></a>
            <div
              class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
            >
              <a class="dropdown-item" href="#" v-on:click="logout">
                <i
                  class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                ></i
                >&nbsp;Logout</a
              >
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</template>

