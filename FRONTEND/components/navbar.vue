<template>
  <div class="drawer">
    <input id="navbarDraw" type="checkbox" class="drawer-toggle" ref="navbarDraw" />
    <div class="drawer-content  ">
      <div class="navbar bg-base-100 shadow w-full fixed z-20">
        <div class=" ">
          <label for="navbarDraw" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              class="inline-block h-6 w-6 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </label>
        </div>
        <div class=" ">
          <NuxtLink to="/" class="flex items-center">
            <button class="btn btn-ghost rounded-md hover:bg-gray-200">
              <img src="~/public/images/LogoEmpresa.webp" alt="inicio-logo" class="navbar-logo rounded-md">
            </button>
          </NuxtLink>
        </div>

      </div>
      <div class="mt-20">
          <slot></slot>
      </div>
    </div>
    <div class="drawer-side  z-20">
      <label for="navbarDraw" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu bg-base-100 min-h-full w-80 p-4 text-lg">
        <li @click="closeDrawer">
          <img src="~/public/images/LogoEmpresa.webp" alt="inicio-logo" class="rounded-md">
        </li>
        <div class="divider"></div>
        <li>
          <Tema />
        </li>
        <li>
          <NuxtLink to="/" @click="closeDrawer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path
                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
              <path
                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
            </svg>
            Inicio
          </NuxtLink>
        </li>
        <li v-if="userRole === 'SUPERADMINISTRADOR'">
          <NuxtLink :to="INDEX_USUARIOS" @click="closeDrawer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path
                d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
            </svg>
            Gestión Usuarios
          </NuxtLink>
        </li>
        <li>
          <NuxtLink :to="INDEX_PAGE_INVENTARIO" @click="closeDrawer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd"
                d="M1.5 9.832v1.793c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875V9.832a3 3 0 0 0-.722-1.952l-3.285-3.832A3 3 0 0 0 16.215 3h-8.43a3 3 0 0 0-2.278 1.048L2.222 7.88A3 3 0 0 0 1.5 9.832ZM7.785 4.5a1.5 1.5 0 0 0-1.139.524L3.881 8.25h3.165a3 3 0 0 1 2.496 1.336l.164.246a1.5 1.5 0 0 0 1.248.668h2.092a1.5 1.5 0 0 0 1.248-.668l.164-.246a3 3 0 0 1 2.496-1.336h3.165l-2.765-3.226a1.5 1.5 0 0 0-1.139-.524h-8.43Z"
                clip-rule="evenodd" />
              <path
                d="M2.813 15c-.725 0-1.313.588-1.313 1.313V18a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-1.688c0-.724-.588-1.312-1.313-1.312h-4.233a3 3 0 0 0-2.496 1.336l-.164.246a1.5 1.5 0 0 1-1.248.668h-2.092a1.5 1.5 0 0 1-1.248-.668l-.164-.246A3 3 0 0 0 7.046 15H2.812Z" />
            </svg>

            Inventario
          </NuxtLink>
        </li>
        <li>
          <a @click.prevent="logoutUser">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd"
                d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6Zm-5.03 4.72a.75.75 0 0 0 0 1.06l1.72 1.72H2.25a.75.75 0 0 0 0 1.5h10.94l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 0 0-1.06 0Z"
                clip-rule="evenodd" />
            </svg>
            Cerrar Sesión
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { UsuarioServices } from '~/Domain/Client/Services/usuario.service';
import { INDEX_PAGE_INVENTARIO, INDEX_USUARIOS } from '~/Infrastructure/Paths/Paths';
import { UsuarioStore } from '~/stores/UsuarioStore';
const usuarioStore = UsuarioStore();
const userRole = usuarioStore.userRole;
const { width } = useWindowSize();
const router = useRouter();

const screenSm = computed(() => {
  return width.value >= 640;
});

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
    spinnerStore.status = false;
    // return navigateTo("/login");
    spinnerStore.activeOrInactiveSpinner(false);
  } catch (error) {
    console.log(error);
  }
  router.push('/login')

  spinnerStore.activeOrInactiveSpinner(false);
}
</script>

<style scoped>
.navbar-logo {
  @apply max-w-20 h-auto;
}

@screen md {
  .navbar-logo {
    @apply w-20;
  }
}
</style>
