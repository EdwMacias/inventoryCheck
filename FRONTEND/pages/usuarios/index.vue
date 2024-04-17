<template>
  <div>
    <NuxtLink class="btn btn-primary" to="crear">Crear</NuxtLink>
    <div class="mt-20 container mx-auto bg-white rounded p-2 shadow" style="z-index: 0;">
      <Table url="http://localhost:8000/api/user/get"></Table>
    </div>
  </div>
</template>

<script lang="ts" setup>

</script>

<style></style>