
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

(window as any).Pusher = Pusher;


export default defineNuxtPlugin((nuxtApp) => {

    const echo = new Echo({
        broadcaster: 'pusher',
        key: "app-key",
        wsHost: "localhost",
        wsPort: 6001,
        wssPort: 6001,
        forceTLS: false,
        encrypted: true,
        disableStats: true,
        cluster: 'mt1',
        enabledTransports: ['ws','wss'],
    });

    // Hacer que echo esté disponible globalmente
    nuxtApp.provide('echo', echo);

})
