// Dashboard Custom JavaScript
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeDashboard);
    } else {
        initializeDashboard();
    }
    
    function initializeDashboard() {
        console.log('Dashboard initialized successfully');
        
        // Initialize all dashboard components
        initializeTooltips();
        initializeDropdowns();
        initializeSidebar();
        initializeThemeToggle();
        
        // Initialize charts after a short delay to ensure DOM is ready
        setTimeout(initializeCharts, 100);
    }
    
    function initializeCharts() {
        // Wait for ApexCharts to be available
        if (typeof ApexCharts === 'undefined') {
            console.warn('ApexCharts not loaded, retrying in 500ms...');
            setTimeout(initializeCharts, 500);
            return;
        }
        
        try {
            // New Members Chart
            const newMembersOptions = {
                series: [{
                    data: [15, 20, 18, 25, 22, 30, 25]
                }],
                chart: {
                    type: 'line',
                    width: 80,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 2,
                    colors: ['#28a745']
                },
                tooltip: {
                    enabled: false
                }
            };
            
            const newMembersChart = new ApexCharts(document.querySelector("#new_members_chart"), newMembersOptions);
            newMembersChart.render();
            
            // Active Members Chart
            const activeMembersOptions = {
                series: [{
                    data: [400, 420, 435, 445, 450, 448, 450]
                }],
                chart: {
                    type: 'line',
                    width: 80,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 2,
                    colors: ['#007bff']
                },
                tooltip: {
                    enabled: false
                }
            };
            
            const activeMembersChart = new ApexCharts(document.querySelector("#active_members_chart"), activeMembersOptions);
            activeMembersChart.render();
            
            // Events Chart
            const eventsOptions = {
                series: [{
                    data: [5, 8, 6, 9, 7, 8, 8]
                }],
                chart: {
                    type: 'line',
                    width: 80,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 2,
                    colors: ['#ffc107']
                },
                tooltip: {
                    enabled: false
                }
            };
            
            const eventsChart = new ApexCharts(document.querySelector("#events_chart"), eventsOptions);
            eventsChart.render();
            
            // Donations Chart
            const donationsOptions = {
                series: [{
                    data: [12000, 13500, 14200, 15000, 14800, 15750, 15750]
                }],
                chart: {
                    type: 'line',
                    width: 80,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 2,
                    colors: ['#28a745']
                },
                tooltip: {
                    enabled: false
                }
            };
            
            const donationsChart = new ApexCharts(document.querySelector("#donations_chart"), donationsOptions);
            donationsChart.render();
            
            // Ministries Pie Chart
            const ministriesOptions = {
                series: [35, 25, 22, 18],
                chart: {
                    type: 'pie',
                    width: 305
                },
                labels: ['Coral', 'Pastoral', 'Catequese', 'Outros'],
                colors: ['#007bff', '#17a2b8', '#6f42c1', '#ffc107'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                }
            };
            
            const ministriesChart = new ApexCharts(document.querySelector("#ministries_chart"), ministriesOptions);
            ministriesChart.render();
            
            // Weekly Activities Chart
            const weeklyActivitiesOptions = {
                series: [{
                    name: 'Atividades',
                    data: [2, 4, 3, 5, 6, 4, 3]
                }],
                chart: {
                    type: 'area',
                    height: 180,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#ffffff'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3
                    }
                },
                stroke: {
                    width: 2,
                    colors: ['#ffffff']
                },
                grid: {
                    show: false
                },
                xaxis: {
                    categories: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                    labels: {
                        style: {
                            colors: '#ffffff'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#ffffff'
                        }
                    }
                }
            };
            
            const weeklyActivitiesChart = new ApexCharts(document.querySelector("#weekly_activities_chart"), weeklyActivitiesOptions);
            weeklyActivitiesChart.render();
            
            // Financial Chart
            const financialOptions = {
                series: [{
                    name: 'Entradas',
                    data: [3000, 4000, 3500, 5000, 4200, 4800, 5200]
                }, {
                    name: 'Saídas',
                    data: [2000, 2500, 2200, 3000, 2800, 3200, 3500]
                }],
                chart: {
                    type: 'area',
                    height: 180,
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#28a745', '#dc3545'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3
                    }
                },
                stroke: {
                    width: 2
                },
                grid: {
                    borderColor: '#e9ecef'
                },
                xaxis: {
                    categories: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7']
                },
                legend: {
                    position: 'top'
                }
            };
            
            const financialChart = new ApexCharts(document.querySelector("#financial_chart"), financialOptions);
            financialChart.render();
            
            console.log('All charts initialized successfully');
            
        } catch (error) {
            console.error('Error initializing charts:', error);
        }
    }
    
    function initializeTooltips() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    }
    
    function initializeDropdowns() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
            const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        }
    }
    
    function initializeSidebar() {
        // Wait a bit to ensure other scripts have loaded
        setTimeout(() => {
            // Sidebar toggle functionality
            const sidebarBurgerMenu = document.getElementById('sidebar-burger-menu');
            const sidebarBurgerMenuClose = document.getElementById('sidebar-burger-menu-close');
            const sidebarArea = document.getElementById('sidebar-area');
            const headerBurgerMenu = document.getElementById('header-burger-menu');
            const sidebarBurgerMenuMobile = document.getElementById('sidebar-burger-menu-mobile');
            
            if (sidebarBurgerMenu && sidebarArea) {
                sidebarBurgerMenu.addEventListener('click', function() {
                    sidebarArea.classList.toggle('active');
                });
            }
            
            if (sidebarBurgerMenuClose && sidebarArea) {
                sidebarBurgerMenuClose.addEventListener('click', function() {
                    sidebarArea.classList.remove('active');
                });
            }
            
            if (headerBurgerMenu && sidebarArea) {
                headerBurgerMenu.addEventListener('click', function() {
                    sidebarArea.classList.toggle('active');
                });
            }
            
            if (sidebarBurgerMenuMobile && sidebarArea) {
                sidebarBurgerMenuMobile.addEventListener('click', function() {
                    sidebarArea.classList.toggle('active');
                });
            }
            
            // Menu toggle functionality - only if not already handled by custom.js
            const menuToggles = document.querySelectorAll('.menu-toggle');
            menuToggles.forEach(function(toggle) {
                // Check if event listener is already attached
                if (!toggle.hasAttribute('data-listener-attached')) {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        const parent = this.closest('.menu-item');
                        if (parent) {
                            parent.classList.toggle('open');
                        }
                    });
                    toggle.setAttribute('data-listener-attached', 'true');
                }
            });
        }, 100);
    }
    
    function initializeThemeToggle() {
        const switchToggle = document.getElementById('switch-toggle');
        
        if (switchToggle) {
            switchToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-theme');
                
                // Save theme preference
                const isDark = document.body.classList.contains('dark-theme');
                localStorage.setItem('dark-theme', isDark);
            });
            
            // Load saved theme preference
            const savedTheme = localStorage.getItem('dark-theme');
            if (savedTheme === 'true') {
                document.body.classList.add('dark-theme');
            }
        }
    }
    
    // Utility functions
    function formatCurrency(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    }
    
    function formatNumber(value) {
        return new Intl.NumberFormat('pt-BR').format(value);
    }
    
    function formatDate(date) {
        return new Intl.DateTimeFormat('pt-BR').format(new Date(date));
    }
    
    // Make functions globally available
    window.DashboardCustom = {
        initializeDashboard: initializeDashboard,
        initializeCharts: initializeCharts,
        initializeTooltips: initializeTooltips,
        initializeDropdowns: initializeDropdowns,
        initializeSidebar: initializeSidebar,
        initializeThemeToggle: initializeThemeToggle,
        formatCurrency: formatCurrency,
        formatNumber: formatNumber,
        formatDate: formatDate
    };
})();