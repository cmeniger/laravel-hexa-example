import "./bootstrap";
import { createApp } from 'vue';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import "@mdi/font/css/materialdesignicons.css";

// Pinia
import { createPinia } from 'pinia';

// Components
import App from './components/App.vue';
import router from './router';

const vuetify = createVuetify({
    components,
    directives,
})

const pinia = createPinia()

createApp(App)
.use(router)
.use(vuetify)
.use(pinia)
.mount('#app');