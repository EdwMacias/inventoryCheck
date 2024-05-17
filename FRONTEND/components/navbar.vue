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
            <NuxtLink to="/">INICIO</NuxtLink>
          </li>
          <li>
            <details>
              <summary>USUARIOS</summary>
              <ul class="p-2">
                <li>
                  <NuxtLink to="/usuarios/">Usuarios</NuxtLink>
                </li>
                <!-- <li> -->
                <!-- <NuxtLink to="/usuarios/as">Asignar Rol Usuario</NuxtLink> -->
                <!-- </li> -->
              </ul>
            </details>
          </li>
          <li>
            <NuxtLink to="/inventario/items">INVENTARIO</NuxtLink>
          </li>
        </ul>
      </div>
      <NuxtLink to="/" class="flex items-center">
        <button class="btn btn-ghost rounded-md hover:bg-gray-200">
          <img src="~/public/images/LogoEmpresa.png" alt="inicio-logo" class="navbar-logo rounded-md">
        </button>
      </NuxtLink>

      <div class="hidden lg:flex">
        <ul class="menu menu-horizontal px-4" style="z-index: 1000;">
          <li>
            <NuxtLink to="/">INICIO</NuxtLink>
          </li>
          <li>
            <details>
              <summary>USUARIOS</summary>
              <ul class="p-2">
                <li>
                  <NuxtLink to="/usuarios/">Usuarios</NuxtLink>
                </li>
                <!-- <li>
                  <NuxtLink to="/usuarios/asignar/roles">Asignar Rol Usuario</NuxtLink>
                </li> -->
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
          <li><a @click="logoutUser">Cerrar Sesión</a></li>
        </ul>
      </button>
      <!-- <a class="btn">Button</a> -->
    </div>
  </div>
</template>

<script setup lang="ts">
import { UsuarioServices } from '~/domain/client/services/usuario.service';


const logoutUser = async () => {
  const spinnerStore = SpinnerStore();
  spinnerStore.activeOrInactiveSpinner(true);
  try {
    await UsuarioServices.Logout();
    spinnerStore.activeOrInactiveSpinner(false);
    return navigateTo("/login");
  } catch (error) {
    console.log(error);
  }
  spinnerStore.activeOrInactiveSpinner(false);
}

</script>

<style scoped>
.navbar-logo {
  @apply max-w-20 h-auto;
}

@screen sm {
  .navbar-logo {
    @apply w-20; /* Ajusta según el tamaño deseado para dispositivos pequeños */
  }
}
</style>