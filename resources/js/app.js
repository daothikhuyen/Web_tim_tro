/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import { createApp } from 'vue';


import app from './App.vue'
import router from './router/index.js';

const vueApp = createApp(app)


vueApp.use(router).mount('#app')

