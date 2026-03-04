/**
 * Sidebar Toggle Functionality
 * Handles sidebar open/close on desktop and mobile
 */

(function() {
  'use strict';

  const sidebar = document.getElementById('dashboard-menu');
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
  const closeSidebarMobile = document.getElementById('closeSidebarMobile');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const mainContent = document.getElementById('main-content');
  const adminDropdown = document.getElementById('adminDropdown');

  // Check localStorage for sidebar state
  const sidebarState = localStorage.getItem('sidebarCollapsed');
  const isCollapsed = sidebarState === 'true';

  // Initialize sidebar state
  function initSidebar() {
    if (window.innerWidth >= 992) {
      // Desktop
      if (sidebarToggle) {
        sidebarToggle.style.display = 'flex';
        if (isCollapsed) {
          sidebarToggle.classList.add('collapsed');
          sidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
        } else {
          sidebarToggle.classList.remove('collapsed');
          sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
        }
      }
      if (sidebarToggleMobile) {
        sidebarToggleMobile.style.display = 'none';
      }
      
      // Set initial state for mainTopbar
      if (mainTopbar) {
        if (isCollapsed) {
          mainTopbar.classList.add('sidebar-collapsed');
        } else {
          mainTopbar.classList.remove('sidebar-collapsed');
        }
      }
      
      if (isCollapsed) {
        collapseSidebar();
      } else {
        expandSidebar();
      }
    } else {
      // Mobile - always collapsed by default
      if (sidebarToggle) {
        sidebarToggle.style.display = 'none';
      }
      if (sidebarToggleMobile) {
        sidebarToggleMobile.style.display = 'flex';
      }
      if (mainTopbar) {
        mainTopbar.classList.remove('sidebar-collapsed');
      }
      collapseSidebarMobile();
    }
  }

  const mainTopbar = document.getElementById('mainTopbar');

  // Collapse sidebar (Desktop)
  function collapseSidebar() {
    if (!sidebar || window.innerWidth < 992) return;
    
    sidebar.classList.add('collapsed');
    if (mainContent) {
      mainContent.classList.add('sidebar-collapsed');
    }
    if (mainTopbar) {
      mainTopbar.classList.add('sidebar-collapsed');
    }
    if (sidebarToggle) {
      sidebarToggle.classList.add('collapsed');
      sidebarToggle.innerHTML = '<i class="bi bi-list"></i>';
    }
    localStorage.setItem('sidebarCollapsed', 'true');
  }

  // Expand sidebar (Desktop)
  function expandSidebar() {
    if (!sidebar || window.innerWidth < 992) return;
    
    sidebar.classList.remove('collapsed');
    if (mainContent) {
      mainContent.classList.remove('sidebar-collapsed');
    }
    if (mainTopbar) {
      mainTopbar.classList.remove('sidebar-collapsed');
    }
    if (sidebarToggle) {
      sidebarToggle.classList.remove('collapsed');
      sidebarToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
    }
    localStorage.setItem('sidebarCollapsed', 'false');
  }

  // Show sidebar (Mobile)
  function expandSidebarMobile() {
    if (!sidebar || window.innerWidth >= 992) return;
    
    sidebar.classList.add('show-mobile');
    if (sidebarOverlay) {
      sidebarOverlay.classList.add('show');
    }
    document.body.style.overflow = 'hidden';
    
    // Ensure Bootstrap collapse is shown
    if (adminDropdown) {
      const bsCollapse = new bootstrap.Collapse(adminDropdown, {
        toggle: false,
        show: true
      });
    }
  }

  // Hide sidebar (Mobile)
  function collapseSidebarMobile() {
    if (!sidebar || window.innerWidth >= 992) return;
    
    sidebar.classList.remove('show-mobile');
    if (sidebarOverlay) {
      sidebarOverlay.classList.remove('show');
    }
    document.body.style.overflow = '';
  }

  // Toggle sidebar (Desktop)
  function toggleSidebar() {
    if (window.innerWidth < 992) return;
    
    if (sidebar.classList.contains('collapsed')) {
      expandSidebar();
    } else {
      collapseSidebar();
    }
  }

  // Toggle sidebar (Mobile)
  function toggleSidebarMobile() {
    if (window.innerWidth >= 992) return;
    
    if (sidebar.classList.contains('show-mobile')) {
      collapseSidebarMobile();
    } else {
      expandSidebarMobile();
    }
  }

  // Event Listeners
  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function(e) {
      e.preventDefault();
      toggleSidebar();
    });
  }

  if (sidebarToggleMobile) {
    sidebarToggleMobile.addEventListener('click', function(e) {
      e.preventDefault();
      toggleSidebarMobile();
    });
  }

  if (closeSidebarMobile) {
    closeSidebarMobile.addEventListener('click', function(e) {
      e.preventDefault();
      collapseSidebarMobile();
    });
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function() {
      collapseSidebarMobile();
    });
  }

  // Handle window resize
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      if (window.innerWidth >= 992) {
        // Desktop
        collapseSidebarMobile();
        // Update toggle button visibility
        if (sidebarToggle) {
          sidebarToggle.style.display = 'flex';
        }
        if (sidebarToggleMobile) {
          sidebarToggleMobile.style.display = 'none';
        }
        // Restore sidebar state
        if (isCollapsed) {
          if (mainTopbar) {
            mainTopbar.classList.add('sidebar-collapsed');
          }
          collapseSidebar();
        } else {
          if (mainTopbar) {
            mainTopbar.classList.remove('sidebar-collapsed');
          }
          expandSidebar();
        }
      } else {
        // Mobile
        if (sidebar) {
          sidebar.classList.remove('collapsed');
        }
        if (mainContent) {
          mainContent.classList.remove('sidebar-collapsed');
        }
        if (mainTopbar) {
          mainTopbar.classList.remove('sidebar-collapsed');
        }
        // Update toggle button visibility
        if (sidebarToggle) {
          sidebarToggle.style.display = 'none';
        }
        if (sidebarToggleMobile) {
          sidebarToggleMobile.style.display = 'flex';
        }
        collapseSidebarMobile();
      }
    }, 250);
  });

  // Close mobile sidebar when clicking on a link
  const sidebarLinks = sidebar?.querySelectorAll('.nav-link');
  if (sidebarLinks) {
    sidebarLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        if (window.innerWidth < 992) {
          setTimeout(function() {
            collapseSidebarMobile();
          }, 300);
        }
      });
    });
  }

  // Initialize on page load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSidebar);
  } else {
    initSidebar();
  }

})();
