/**
 * Admin Sidebar Toggle Functionality
 * Handles show/hide sidebar for all admin pages
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebarToggle);
    } else {
        initSidebarToggle();
    }

    function initSidebarToggle() {
        const body = document.body;
        const toggleButton = document.querySelector('.app-sidebar__toggle');
        const overlay = document.querySelector('.app-sidebar__overlay');
        const sidebar = document.querySelector('.app-sidebar');

        if (!toggleButton || !overlay || !sidebar) {
            return; // Exit if elements don't exist
        }

        // Toggle sidebar function
        function toggleSidebar() {
            body.classList.toggle('sidenav-toggled');
            
            // Update overlay display
            updateOverlay();
        }
        
        // Update overlay display based on screen size and toggle state
        function updateOverlay() {
            if (window.innerWidth <= 767) {
                // On mobile: show overlay when sidebar is visible (not toggled)
                if (body.classList.contains('sidenav-toggled')) {
                    overlay.style.display = 'none';
                } else {
                    overlay.style.display = 'block';
                }
            } else {
                // On desktop: no overlay
                overlay.style.display = 'none';
            }
        }

        // Handle toggle button click
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });

        // Handle overlay click (close sidebar)
        overlay.addEventListener('click', function(e) {
            e.preventDefault();
            // On mobile, clicking overlay should hide sidebar
            if (window.innerWidth <= 767) {
                body.classList.add('sidenav-toggled');
            }
            updateOverlay();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            updateOverlay();
        });

        // Initialize: On mobile, sidebar is hidden by default (add toggled class)
        if (window.innerWidth <= 767) {
            body.classList.add('sidenav-toggled');
        }
        updateOverlay();
    }

})();

