<template>
  <div class="navbar bg-white">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
          <li>
            <NuxtLink to="/">HOME</NuxtLink>
          </li>
          <li>
            <details>
              <summary>USUARIOS</summary>
              <ul class="p-2">
                <li>
                  <NuxtLink to="/usuarios/crear">Crear Usuario</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/usuarios/asignar/roles">Asignar Rol Usuario</NuxtLink>
                </li>
              </ul>
            </details>
          </li>
          <li>
                  <NuxtLink to="/inventario/items">INVENTARIO</NuxtLink>
                </li>
        </ul>
      </div>
      <NuxtLink to="/" class="btn btn-ghost text-xl">CEDAC</NuxtLink>

      <div class="hidden lg:flex">
        <ul class="menu menu-horizontal px-4" style="z-index: 1000;">
          <li>
            <NuxtLink to="/">HOME</NuxtLink>
          </li>
          <li>
            <details>
              <summary>USUARIOS</summary>
              <ul class="p-2">
                <li>
                  <NuxtLink to="/usuarios/crear">Crear Usuario</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/usuarios/asignar/roles">Asignar Rol Usuario</NuxtLink>
                </li>

              </ul>
            </details>
          </li>
          <li>
            <NuxtLink to="/inventario/items">INVENTARIO</NuxtLink>
          </li>
          <!-- <li><a>Item 3</a></li> -->
        </ul>
      </div>
    </div>
    <!-- <div class="navbar-center hidden lg:flex"> -->
    <!-- </div> -->
    <div class="navbar-end">
      <button class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img alt="Tailwind CSS Navbar component"
              src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
          </div>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
          <li>
            <a class="justify-between">
              Perfil
              <span class="badge">New</span>
            </a>
          </li>
          <li><a>Configuración</a></li>
          <li><a>Cerrar Sesión</a></li>
        </ul>
      </button>
      <!-- <a class="btn">Button</a> -->
    </div>
  </div>
</template>

<script setup>

</script>

<style scoped></style>