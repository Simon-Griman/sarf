import './bootstrap';

//DASHBOARD
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('open-sidebar');
const closeBtn = document.getElementById('close-sidebar');
const overlay = document.getElementById('sidebar-overlay');

function toggleSidebar() {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

openBtn.addEventListener('click', toggleSidebar);
closeBtn.addEventListener('click', toggleSidebar);
overlay.addEventListener('click', toggleSidebar);


//DARK MODE
const themeToggleBtn = document.getElementById('theme-toggle');
const darkIcon = document.getElementById('theme-toggle-dark-icon');
const lightIcon = document.getElementById('theme-toggle-light-icon');

// 1. FUNCIÓN PARA ACTUALIZAR ICONOS
function updateIcons() {
    if (document.documentElement.classList.contains('dark')) {
        lightIcon.classList.remove('hidden');
        darkIcon.classList.add('hidden');
    } else {
        lightIcon.classList.add('hidden');
        darkIcon.classList.remove('hidden');
    }
}

// 2. LÓGICA DE CARGA INICIAL (Prioriza LocalStorage, luego Sistema)
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

// Ejecutar al cargar la página
loadTheme();

// 3. EVENTO DE CLIC
themeToggleBtn.addEventListener('click', function() {
    // Alternar clase dark
    document.documentElement.classList.toggle('dark');
    
    // Guardar la elección explícita del usuario
    if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('color-theme', 'dark');
    } else {
        localStorage.setItem('color-theme', 'light');
    }
    
    updateIcons();
});

//SWEETALERT2
window.addEventListener('notify', event => {

    const data = event.detail;

    // Detectamos si el sistema está en modo oscuro
    const isDark = document.documentElement.classList.contains('dark');

    Swal.fire({
        title: data.title || 'Notificación',
        text: data.message, 
        icon: data.icon || 'info',
        toast: true,
        //position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,

        // --- ADAPTACIÓN DE COLORES ---
        background: isDark ? '#1f2937' : '#ffffff', // bg-gray-800 o blanco
        color: isDark ? '#ffffff' : '#1f2937',      // texto blanco o gris oscuro
        iconColor: data.icon === 'success' ? '#10b981' : undefined, // verde tailwind opcional
    });
});