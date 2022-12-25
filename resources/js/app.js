import './bootstrap';
import { createApp } from 'vue';
import store from './store/store';
import axios from 'axios'
import "flowbite";

axios.defaults.baseURL = "http://127.0.0.1:8000/"


const app = createApp({});

import App from './App.vue';
import router from './router/index.js';


app.use(router)
app.use(store)

app.component('app-component', App);

app.mount('#app');
