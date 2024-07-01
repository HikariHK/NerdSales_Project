function toggleMenu() {
    const mainContent = document.getElementById('main-content');
    const submenu = document.getElementById('submenu');
    
    if (submenu.style.display === 'block') {
        // Se o submenu está visível, ajusta a posição do conteúdo principal
        mainContent.style.marginTop = '85px'; // Ajuste conforme necessário
    } else {
        // Se o submenu está oculto, restaura a posição padrão do conteúdo principal
        mainContent.style.marginTop = '0';
    }
}

function toggleSubMenu() {
    const submenu = document.getElementById('submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';

    // Chama a função para ajustar o conteúdo principal ao estado do submenu
    toggleMenu();
}