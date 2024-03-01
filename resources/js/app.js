import './bootstrap';
import "primevue/resources/themes/saga-green/theme.css";
import 'primeicons/primeicons.css';
import 'sweetalert2/dist/sweetalert2.min.css';

import VueSweetalert2 from 'vue-sweetalert2';
import PrimeVue from "primevue/config";
import Tooltip from 'primevue/tooltip';

import Main from './components/Main.vue';
import Stats from  './components/Stats.vue';

import { createApp } from "vue";


const app = createApp(Main);
const stts = createApp(Stats);

app
    .use(PrimeVue, { ripple: true })
    .use(VueSweetalert2)
    .directive('tooltip', Tooltip);

stts
    .use(PrimeVue, { ripple: true })
    .use(VueSweetalert2)
    .directive('tooltip', Tooltip);

app.mount(`#app`); 
stts.mount(`#stats`); 

