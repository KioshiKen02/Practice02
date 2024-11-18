import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue';
import App from './components/app.vue';
createApp(App).mount('#app');

import '@lottiefiles/lottie-player';
