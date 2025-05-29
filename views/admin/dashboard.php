<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmaster - Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include_once 'partials/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="flex-1 p-4 overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="w-1/2">
                    <div class="relative">
                        <input type="text" class="w-full bg-gray-200 rounded-lg pl-10 pr-4 py-2 focus:outline-none" placeholder="Buscar elemento">
                        <div class="absolute left-3 top-2 text-gray-500">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <span id="section-title" class="font-semibold">Libros</span>
                </div>
            </div>
            
            <!-- Content Sections -->
            <?php include_once 'partials/content_books.php'; ?>
            <?php include_once 'partials/content_add.php'; ?>
            <?php include_once 'partials/content_catalogs.php'; ?>
            <?php include_once 'partials/content_loans.php'; ?>
            <?php include_once 'partials/content_settings.php'; ?>
        </div>
    </div>

    <!-- JavaScript for dynamic content switching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all menu items
            const menuItems = {
                add: document.getElementById('menu-add'),
                books: document.getElementById('menu-books'),
                catalogs: document.getElementById('menu-catalogs'),
                loans: document.getElementById('menu-loans'),
                settings: document.getElementById('menu-settings'),
                logout: document.getElementById('menu-logout')
            };

            // Get all content sections
            const contentSections = {
                add: document.getElementById('content-add'),
                books: document.getElementById('content-books'),
                catalogs: document.getElementById('content-catalogs'),
                loans: document.getElementById('content-loans'),
                settings: document.getElementById('content-settings')
            };

            // Get section title element
            const sectionTitle = document.getElementById('section-title');

            // Function to show selected content and hide others
            function showContent(section) {
                // Hide all content sections
                Object.values(contentSections).forEach(content => {
                    if (content) content.classList.add('hidden');
                });

                // Show selected section
                if (contentSections[section]) {
                    contentSections[section].classList.remove('hidden');
                }

                // Update section title
                updateSectionTitle(section);
                
                // Update active menu item styling
                updateActiveMenuItem(section);
            }

            // Function to update section title
            function updateSectionTitle(section) {
                const titles = {
                    add: 'Añadir Libro',
                    books: 'Libros',
                    catalogs: 'Catálogos',
                    loans: 'Préstamos',
                    settings: 'Configuración'
                };
                sectionTitle.textContent = titles[section] || 'Dashboard';
            }

            // Function to update active menu item styling
            function updateActiveMenuItem(activeSection) {
                // Remove active class from all menu items
                Object.entries(menuItems).forEach(([key, item]) => {
                    if (item) {
                        item.classList.remove('bg-gray-100');
                        item.classList.add('hover:bg-gray-100');
                    }
                });

                // Add active class to selected menu item
                if (menuItems[activeSection]) {
                    menuItems[activeSection].classList.add('bg-gray-100');
                    menuItems[activeSection].classList.remove('hover:bg-gray-100');
                }
            }

            // Add click event listeners to menu items
            Object.entries(menuItems).forEach(([section, item]) => {
                if (item && section !== 'logout') {
                    item.addEventListener('click', function() {
                        showContent(section);
                    });
                }
            });

            // Handle logout separately
            if (menuItems.logout) {
                menuItems.logout.addEventListener('click', function() {
                    // You can implement a confirmation dialog here
                    if (confirm('¿Estás seguro que deseas cerrar sesión?')) {
                        window.location.href = '<?= base_url('auth/logout') ?>';
                    }
                });
            }

            // Initialize with books view (default)
            showContent('books');
        });
    </script>
</body>
</html>
