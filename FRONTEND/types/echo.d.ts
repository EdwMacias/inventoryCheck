// import Echo from 'laravel-echo';
import type Swal from 'sweetalert2';

declare module '#app' {
  interface NuxtApp {
    // $echo: Echo;
    $swal: Swal;
  }
}

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    // $echo: Echo;
    $swal: Swal;
  }
}