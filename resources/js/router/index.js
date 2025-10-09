import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Songs from '../components/Songs.vue';
import Playlists from '../components/Playlists.vue';

const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/songs', component: Songs, name: 'songs' },
    { path: '/playlists', component: Playlists, name: 'playlists' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
