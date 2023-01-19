// import './bootstrap';
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();
//


require('./bootstrap');

import { createApp } from 'vue'
import TestVue from './components/TestVue.vue';
import DrawTool from './components/DrawTool.vue';

const app = createApp({})
app.component('draw-tool', DrawTool);
app.mount('#app')