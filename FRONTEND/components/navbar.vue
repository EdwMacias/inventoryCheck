<template>
<div class="navbar bg-base-100">
  <div class="navbar-start"> <!-- Navbar principal, sincronizar con navbar responsive-->
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><NuxtLink href="/registros/inventario">Inventario</NuxtLink></li>
         <li>
          <a>Cambiar tema</a>
          <ul class="p-2">
            <li><a>claro</a></li>
            <li><a>obscuro</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl"><NuxtLink href="/test"><img src="../public/LogooYellow.png" alt="" width="150"></NuxtLink></a>
  </div>
  <div class="navbar-center hidden lg:flex"> <!-- navbar responsive, verificar esquema navbar principal-->
    <ul class="menu menu-horizontal px-1">
      <li><NuxtLink href="/registros/inventario">Inventario</NuxtLink></li>
      <li>
        <ThemeController/>
      </li>
      <!-- <li>
        <details>
          <summary>Parent</summary>
          <ul class="p-2">
            <li><a>Submenu 1</a></li>
            <li><a>Submenu 2</a></li>
          </ul>
        </details>
      </li> -->
    </ul>
  </div>
  <div class="navbar-end">
    <NuxtLink class="btn" href="/login">Iniciar Sesión</NuxtLink>
  </div>
</div>
</template>

<script setup>

</script>

<style scoped></style>