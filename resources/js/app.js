import './bootstrap';
import "bootstrap";

import { createApp } from 'vue';
import { Ziggy } from './ziggy';
import { ZiggyVue } from 'ziggy';
import NavBar from './components/NavBar.vue';
import MastHead from './components/MastHead.vue';
import About from './components/About.vue';
import Services from './components/Services.vue';
import Testimonials from './components/Testimonials.vue';
import Contact from './components/Contact.vue';
import AdminMastHead from './components/admin/MastHead.vue';
import AdminServices from './components/admin/Services.vue';
import AdminAbout from './components/admin/About.vue';
import Messages from './components/admin/Messages.vue';


createApp()
    .use(ZiggyVue, Ziggy)
    .component('nav-bar', NavBar)
    .component('mast-head', MastHead)
    .component('about', About)
    .component('services', Services)
    .component('testimonials', Testimonials)
    .component('contact', Contact)
    .component('admin-mast-head', AdminMastHead)
    .component('admin-services', AdminServices)
    .component('admin-about', AdminAbout)
    .component('messages', Messages)
    .mount('#app');
