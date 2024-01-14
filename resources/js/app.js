// resources/js/app.js
import 'bootstrap/dist/css/bootstrap.css';
import { createApp } from 'vue';
import App from './App.vue';
import './bootstrap.js';

// Create a Vue app instance
const app = createApp({});

// Register components
app.component('App', App);

// Mount the app to the DOM
app.mount("#app");