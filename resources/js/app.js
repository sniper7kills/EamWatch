/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';
window.Vue = Vue;

import VueRouter from "vue-router";
Vue.use(VueRouter);
import router from './routes';

window.Vapor = require('laravel-vapor');

import VueLoading from 'vue-loading-template'
Vue.use(VueLoading);

import LaravelVueValidator from 'laravel-vue2-validator'
Vue.use(LaravelVueValidator);

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if(error.response.status === 403) {
        if(error.response.data.message === "You are banned."){
            window.location.href = '/banned';
            window.location.assign("/banned");
            console.log("YOU ARE BANNED!");
        }
    }
    return Promise.reject(error);
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', () => import(/* webpackChunkName: "partials/pagination" */ './components/pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
