<template>
  <div class="drawer">
    <input id="navbarDraw" type="checkbox" class="drawer-toggle" ref="navbarDraw" />

    <div class="drawer-content flex flex-col">
      <div class="navbar bg-base-100 sticky shadow w-full">
        <div class="flex-none ">
          <label for="navbarDraw" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              class="inline-block h-6 w-6 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </label>
        </div>
        <div class="mx-2 flex-1 px-2">
          <NuxtLink to="/" class="flex items-center">
            <button class="btn btn-ghost rounded-md hover:bg-gray-200">
              <img src="~/public/images/LogoEmpresa.webp" alt="inicio-logo" class="navbar-logo rounded-md">
            </button>
          </NuxtLink>
        </div>
        <div class="hidden flex-none lg:block">
          <ul class="menu menu-horizontal">
            <li>
              <Tema />
            </li>
          </ul>
        </div>
      </div>

      <slot></slot>
    </div>

    <div class="drawer-side">
      <label for="navbarDraw" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu bg-base-100 min-h-full w-80 p-4 text-lg">
        <li @click="closeDrawer">
          <img src="~/public/images/LogoEmpresa.webp" alt="inicio-logo" class="rounded-md">
        </li>
        <div class="divider"></div>
        <li>
          <NuxtLink to="/" @click="closeDrawer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Inicio
          </NuxtLink>
        </li>
        <li>
          <details>
            <summary><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-people h-5 w-5 " viewBox="0 0 16 16">
                <path
                  d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
              </svg> Usuarios</summary>
            <ul>
              <li>
                <NuxtLink to="/usuarios/" @click="closeDrawer">Usuarios</NuxtLink>
              </li>
              <li>
                <NuxtLink to="/usuarios/asignar/roles" @click="closeDrawer">Asignación De Roles</NuxtLink>
              </li>
            </ul>
          </details>
        </li>
        <li>
          <NuxtLink to="/inventario/items" @click="closeDrawer">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box h-5 w-5"
              viewBox="0 0 16 16">
              <path
                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
            </svg>
            Inventario
          </NuxtLink>
        </li>
        <li>
          <details>
            <summary>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="h-5 w-5 bi bi-gear" viewBox="0 0 16 16">
                <path
                  d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                <path
                  d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
              </svg>
              Configuración
            </summary>
            <ul>
              <li><a @click="logoutUser">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-right h-5 w-5" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd"
                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                  </svg>
                  Cerrar Sesión</a></li>
            </ul>
          </details>
        </li>

      </ul>
    </div>

  </div>
</template>

<script setup lang="ts">
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
const permisos = ref(true);

const navbarDraw = ref();

const closeDrawer = () => {
  if (navbarDraw.value) {
    navbarDraw.value.checked = false;
  }
};

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

<style scoped lang="scss">
.navbar-logo {
  @apply max-w-20 h-auto;
}

@screen sm {
  .navbar-logo {
    @apply w-20;
    /* Ajusta según el tamaño deseado para dispositivos pequeños */
  }
}
</style>
