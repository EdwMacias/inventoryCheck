import VueBarcode from '@chenfengyuan/vue-barcode';

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.component('VueBarcode', VueBarcode);
})
