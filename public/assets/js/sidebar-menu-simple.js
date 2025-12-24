// Simple sidebar menu implementation without eval()
// This replaces the complex sidebar-menu.js that uses eval()

(function() {
    'use strict';
    
    // Simple Helpers object
    window.Helpers = window.Helpers || {};
    
    // Scroll to active menu item
    window.Helpers.scrollToActive = function(animate) {
        const activeMenuItem = document.querySelector('.menu-item.active');
        if (activeMenuItem) {
            activeMenuItem.scrollIntoView({
                behavior: animate ? 'smooth' : 'auto',
                block: 'nearest'
            });
        }
    };
    
    // Menu functionality
    window.Helpers.mainMenu = {
        element: null,
        orientation: 'vertical',
        closeChildren: false
    };
    
    // Initialize menu when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        const layoutMenuEl = document.querySelectorAll('#layout-menu');
        layoutMenuEl.forEach(function(element) {
            window.Helpers.mainMenu.element = element;
            
            // Handle menu toggle clicks
            const menuToggles = element.querySelectorAll('.menu-toggle');
            menuToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.closest('.menu-item');
                    if (parent) {
                        parent.classList.toggle('open');
                    }
                });
            });
            
            // Handle menu link clicks
            const menuLinks = element.querySelectorAll('.menu-link:not(.menu-toggle)');
            menuLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Remove active class from all menu items
                    element.querySelectorAll('.menu-item').forEach(function(item) {
                        item.classList.remove('active');
                    });
                    
                    // Add active class to current item
                    this.closest('.menu-item').classList.add('active');
                    
                    // Close other menu items
                    const parent = this.closest('.menu-item');
                    if (parent) {
                        parent.classList.add('open');
                    }
                });
            });
        });
        
        // Initialize scroll to active
        window.Helpers.scrollToActive(false);
    });
    
})();
