
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('batches', require('./components/Batches.vue'));
Vue.component('batch-samples', require('./components/BatchSamples.vue'));

Vue.component('projects', require('./components/Projects.vue'));
Vue.component('project-tasks', require('./components/ProjectTasks.vue'));
Vue.component('roadmaps', require('./components/Roadmaps.vue'));

Vue.component('procedures', require('./components/Procedures.vue'));
Vue.component('results', require('./components/Results.vue'));



const app = new Vue({
    el: '#app'
});
