import './bootstrap';
import Swal from 'sweetalert2';
import '@fortawesome/fontawesome-free/js/all.js';
window.Swal = Swal;

// --- DASHBOARD (Protegido con ?) ---
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('open-sidebar');
const closeBtn = document.getElementById('close-sidebar');
const overlay = document.getElementById('sidebar-overlay');

function toggleSidebar() {
    if (sidebar && overlay) { // Validación extra
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
}

// El signo "?" evita que JS explote si el botón no existe
openBtn?.addEventListener('click', toggleSidebar);
closeBtn?.addEventListener('click', toggleSidebar);
overlay?.addEventListener('click', toggleSidebar);


// --- DARK MODE (Protegido con ?) ---
const themeToggleBtn = document.getElementById('theme-toggle');
const darkIcon = document.getElementById('theme-toggle-dark-icon');
const lightIcon = document.getElementById('theme-toggle-light-icon');

function updateIcons() {
    // Si los iconos no existen en esta página, salimos de la función
    if (!lightIcon || !darkIcon) return;

    if (document.documentElement.classList.contains('dark')) {
        lightIcon.classList.remove('hidden');
        darkIcon.classList.add('hidden');
    } else {
        lightIcon.classList.add('hidden');
        darkIcon.classList.remove('hidden');
    }
}

function loadTheme() {
    const savedTheme = localStorage.getItem('color-theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    updateIcons();
}

loadTheme();

themeToggleBtn?.addEventListener('click', function() {
    document.documentElement.classList.toggle('dark');
    
    if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('color-theme', 'dark');
    } else {
        localStorage.setItem('color-theme', 'light');
    }
    updateIcons();
});

// --- SWEETALERT2 (Ahora sí se ejecutará siempre) ---
window.addEventListener('notify', event => {
    // En Livewire 3 los datos suelen venir en event.detail[0]
    // Si usas Livewire 2, es event.detail directamente
    const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;

    const isDark = document.documentElement.classList.contains('dark');

    Swal.fire({
        title: data.title || 'Notificación',
        text: data.message || data.text, // Acepta 'message' o 'text'
        icon: data.icon || 'info',
        toast: true,
        //position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: isDark ? '#1f2937' : '#ffffff',
        color: isDark ? '#ffffff' : '#1f2937',
    });
});