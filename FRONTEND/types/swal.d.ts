import swal from 'sweetalert2';

declare module '#app' {
  interface NuxtApp {
    $swal: typeof swal;
  }
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $swal: typeof swal;
  }
}
