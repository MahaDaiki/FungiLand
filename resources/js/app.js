import './bootstrap';

import { createApp } from 'vue';
import test from "./components/first.vue"

const app = createApp({
    components:{
        test,
    },
})
app.mount('#app')
