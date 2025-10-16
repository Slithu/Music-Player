import axios from 'axios';
window.axios = axios;

// Domyślny nagłówek dla AJAX
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Dodaj nagłówek Authorization jeśli token jest w localStorage
const token = localStorage.getItem('token');
if (token) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}
