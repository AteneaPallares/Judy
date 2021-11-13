<template>
  <nav
    class="navbar navbar-dark ler align-items-start sidebar sidebar-z accordion bg-gradient-primary p-0"
  >
    <div class="container-fluid d-flex flex-column p-0">
      <div
        class="navbar-brand bg-red d-flex justify-content-center align-items-center sidebar-brand m-0"
      ></div>
      <hr class="sidebar-divider my-0" />
      <ul class="nav navbar-nav text-light" id="accordionSidebar">
        <li class="nav-item">
          <a class="nav-link" href="/dashboard/"
            ><i class="fas fa-chart-line"></i><span>Dashboard</span></a
          >
        </li>
        
        <li  class="nav-item">
            <a class="nav-link" href="/usuarios/"
              ><i class="fas fa-address-card"></i><span>Empleados</span></a
            >
        </li>
        
        
        <li class="nav-item">
          <a class="nav-link" href="/pacientes/"
            ><i class="el-icon-user-solid"></i><span>Clientes</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/historiales/"
            ><i class="el-icon-folder"></i><span>Ventas</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/areas/"
            ><i class="el-icon-map-location"></i><span>Proveedores</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/horarios/"
            ><i class="el-icon-takeaway-box"></i><span>Productos</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/inventario/"
            ><i class="el-icon-suitcase"></i><span>Pedidos</span></a
          >
        </li>
         <li class="nav-item">
          <a class="nav-link" href="/inventario/"
            ><i class="el-icon-date"></i><span>IVA</span></a
          >
        </li>
       <div class="text-center d-none d-md-inline">
      
        <button
          class="btn rounded-circle lerd border-0 text-white"
          id="sidebarToggle"
          type="button"
        ></button>
      </div>
      </ul>
      
    </div>
  </nav>
</template>
<style scoped>
.ler {
  background-color: #2E203E;
}
.lerd {
  background-color: #716189;
}
</style>


