/**
 * Sidebar — HaLong24h Admin
 * ─────────────────────────
 * Desktop : collapse ↔ expand (width: 260px ↔ 80px)
 * Mobile  : slide in ↔ out    (transform: translateX)
 * State   : localStorage key "sidebarCollapsed"
 * Anti-flash: header.php sets data-sidebar on <html> before first paint;
 *             this script removes it immediately after applying the state.
 */
(function () {
  'use strict';

  /* ── DOM refs ── */
  var sidebar     = document.getElementById('dashboard-menu');
  var mainContent = document.getElementById('main-content');
  var topbar      = document.getElementById('mainTopbar');
  var btnDesktop  = document.getElementById('sidebarToggle');
  var btnMobile   = document.getElementById('sidebarToggleMobile');
  var btnClose    = document.getElementById('closeSidebarMobile');
  var overlay     = document.getElementById('sidebarOverlay');

  if (!sidebar) return; // login page — nothing to do

  /* ── Constants ── */
  var BREAKPOINT    = 992;
  var LS_KEY        = 'sidebarCollapsed';
  var ICON_EXPAND   = '<i class="bi bi-layout-sidebar-reverse"></i>';
  var ICON_COLLAPSE = '<i class="bi bi-layout-sidebar"></i>';

  /* ── State helpers ── */
  function isCollapsed() { return localStorage.getItem(LS_KEY) === 'true'; }
  function saveState(val) { localStorage.setItem(LS_KEY, val ? 'true' : 'false'); }
  function isMobile() { return window.innerWidth < BREAKPOINT; }

  /* ── Remove anti-flash attribute (frees CSS transitions) ── */
  function clearAntiFlash() {
    document.documentElement.removeAttribute('data-sidebar');
  }

  /* ── Apply desktop collapsed / expanded state ── */
  function applyDesktop(collapsed) {
    clearAntiFlash();
    if (collapsed) {
      sidebar.classList.add('collapsed');
      if (mainContent) mainContent.classList.add('sidebar-collapsed');
      if (topbar)      topbar.classList.add('sidebar-collapsed');
      if (btnDesktop)  btnDesktop.innerHTML = ICON_EXPAND;
    } else {
      sidebar.classList.remove('collapsed');
      if (mainContent) mainContent.classList.remove('sidebar-collapsed');
      if (topbar)      topbar.classList.remove('sidebar-collapsed');
      if (btnDesktop)  btnDesktop.innerHTML = ICON_COLLAPSE;
    }
  }

  /* ── Toggle desktop (with animation) ── */
  function toggleDesktop() {
    var next = !isCollapsed();
    saveState(next);
    applyDesktop(next);
  }

  /* ── Mobile panel ── */
  function openMobile() {
    sidebar.classList.add('show-mobile');
    if (overlay) overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeMobile() {
    sidebar.classList.remove('show-mobile');
    if (overlay) overlay.classList.remove('show');
    document.body.style.overflow = '';
  }

  function toggleMobile() {
    if (sidebar.classList.contains('show-mobile')) { closeMobile(); }
    else { openMobile(); }
  }

  /* ────────────────────────────────────────────────────────────
     INIT — apply stored state WITHOUT animation (no flash)
  ──────────────────────────────────────────────────────────── */
  function init() {
    document.documentElement.classList.add('no-anim');

    if (!isMobile()) {
      /* Desktop: restore persisted collapse state */
      applyDesktop(isCollapsed());
      closeMobile(); // clean any leftover mobile state
    } else {
      /* Mobile: sidebar always starts hidden */
      clearAntiFlash();
      sidebar.classList.remove('collapsed');
      if (mainContent) mainContent.classList.remove('sidebar-collapsed');
      if (topbar)      topbar.classList.remove('sidebar-collapsed');
      closeMobile();
    }

    /* Re-enable transitions after two animation frames */
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        document.documentElement.classList.remove('no-anim');
      });
    });
  }

  /* ────────────────────────────────────────────────────────────
     EVENT LISTENERS
  ──────────────────────────────────────────────────────────── */

  if (btnDesktop) {
    btnDesktop.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if (!isMobile()) {
        toggleDesktop();
      }
    });
  }

  if (btnMobile) {
    btnMobile.addEventListener('click', function (e) {
      e.preventDefault();
      if (isMobile()) toggleMobile();
    });
  }

  if (btnClose) {
    btnClose.addEventListener('click', function (e) {
      e.preventDefault();
      closeMobile();
    });
  }

  if (overlay) {
    overlay.addEventListener('click', closeMobile);
  }

  /* Close sidebar when a nav link is tapped on mobile */
  sidebar.querySelectorAll('.nav-link').forEach(function (link) {
    link.addEventListener('click', function () {
      if (isMobile()) setTimeout(closeMobile, 200);
    });
  });

  /* Resize: reinitialise for the new viewport mode */
  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(init, 150);
  });

  /* ────────────────────────────────────────────────────────────
     ACTIVE LINK + BREADCRUMB
  ──────────────────────────────────────────────────────────── */
  function setActive() {
    var breadcrumb = document.getElementById('topbarBreadcrumb');
    var page = window.location.pathname.split('/').pop().replace(/\.[^.]+$/, '');

    sidebar.querySelectorAll('.nav-link').forEach(function (link) {
      var href = (link.getAttribute('href') || '').split('/').pop().replace(/\.[^.]+$/, '');
      if (!href || !page) return;

      if (page === href) {
        link.classList.add('active');

        if (breadcrumb) {
          var label = link.querySelector('span');
          if (label && label.textContent.trim()) {
            breadcrumb.textContent = label.textContent.trim();
          }
        }

        /* Auto-expand parent submenu */
        var submenu = link.closest('.submenu');
        if (submenu) {
          submenu.classList.add('show');
          var toggle = sidebar.querySelector('[data-bs-target="#' + submenu.id + '"]');
          if (toggle) toggle.setAttribute('aria-expanded', 'true');
        }
      }
    });
  }

  /* ── Run ── */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { init(); setActive(); });
  } else {
    init();
    setActive();
  }

})();
