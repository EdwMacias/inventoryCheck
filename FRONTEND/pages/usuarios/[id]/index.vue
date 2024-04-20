<template>
  <div class="lg:container lg:mx-auto px-5 py-5 m-5 ">
    <FormularioRegistro></FormularioRegistro>
  </div>
</template>

<script lang="ts" setup>
import type { UsuarioEntity } from '~/domain/models/Entities/usuario';
import { UsuarioRepository } from '~/infrastructure/Repositories/Usuario/usuario.repository';
// const route = useRoute()


definePageMeta({
  middleware: ['actions-middleware']
})

// const usuarioFormulario: Ref<UsuarioEntity> = ref({});
// const route = useRoute()
onMounted(async () => {

  // if (route.params.id) {
    
  // }
  // usuarioFormulario.value = {

  // }
})


</script>

<style></style>