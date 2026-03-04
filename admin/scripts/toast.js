/**
 * Modern Toast Notification System
 * Provides smooth animations and professional styling
 */

class ToastNotification {
  constructor() {
    this.container = document.getElementById('toastContainer');
    if (!this.container) {
      this.container = document.createElement('div');
      this.container.className = 'toast-container';
      this.container.id = 'toastContainer';
      document.body.appendChild(this.container);
    }
  }

  /**
   * Show a toast notification
   * @param {string} message - The message to display
   * @param {string} type - Type of toast: 'success', 'error', 'info', 'warning'
   * @param {number} duration - Duration in milliseconds (default: 3000)
   */
  show(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    
    const iconMap = {
      success: 'bi-check-circle-fill',
      error: 'bi-x-circle-fill',
      info: 'bi-info-circle-fill',
      warning: 'bi-exclamation-triangle-fill'
    };

    const colorMap = {
      success: '#10b981',
      error: '#ef4444',
      info: '#2563eb',
      warning: '#f59e0b'
    };

    toast.innerHTML = `
      <div class="toast-icon" style="color: ${colorMap[type]}">
        <i class="bi ${iconMap[type]}"></i>
      </div>
      <div class="toast-content">
        <div class="toast-message">${message}</div>
      </div>
      <button class="toast-close" onclick="this.parentElement.remove()">
        <i class="bi bi-x"></i>
      </button>
    `;

    this.container.appendChild(toast);

    // Auto remove after duration
    if (duration > 0) {
      setTimeout(() => {
        this.remove(toast);
      }, duration);
    }

    return toast;
  }

  /**
   * Remove a toast notification with animation
   * @param {HTMLElement} toast - The toast element to remove
   */
  remove(toast) {
    if (toast && toast.parentElement) {
      toast.classList.add('hiding');
      setTimeout(() => {
        if (toast.parentElement) {
          toast.remove();
        }
      }, 300);
    }
  }

  /**
   * Show success toast
   */
  success(message, duration = 3000) {
    return this.show(message, 'success', duration);
  }

  /**
   * Show error toast
   */
  error(message, duration = 4000) {
    return this.show(message, 'error', duration);
  }

  /**
   * Show info toast
   */
  info(message, duration = 3000) {
    return this.show(message, 'info', duration);
  }

  /**
   * Show warning toast
   */
  warning(message, duration = 3000) {
    return this.show(message, 'warning', duration);
  }
}

// Create global instance
const toast = new ToastNotification();

// Override legacy alert function for backward compatibility
function alert(type, msg, position = 'body') {
  if (type === 'success') {
    toast.success(msg);
  } else {
    toast.error(msg);
  }
}
