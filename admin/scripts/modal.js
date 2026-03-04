/**
 * Enhanced Modal Utilities
 * Provides smooth animations and modern styling for Bootstrap modals
 */

document.addEventListener('DOMContentLoaded', function() {
  // Enhance all modals with smooth animations
  const modals = document.querySelectorAll('.modal');
  
  modals.forEach(function(modal) {
    // Add fade-in animation when modal is shown
    modal.addEventListener('show.bs.modal', function() {
      this.style.opacity = '0';
      setTimeout(() => {
        this.style.transition = 'opacity 0.3s ease-in-out';
        this.style.opacity = '1';
      }, 10);
    });

    // Add fade-out animation when modal is hidden
    modal.addEventListener('hide.bs.modal', function() {
      this.style.transition = 'opacity 0.2s ease-in-out';
      this.style.opacity = '0';
    });

    // Enhance modal backdrop
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
      backdrop.style.transition = 'opacity 0.3s ease-in-out';
    }
  });

  // Enhance form inputs in modals
  const modalInputs = document.querySelectorAll('.modal input, .modal textarea, .modal select');
  modalInputs.forEach(function(input) {
    input.addEventListener('focus', function() {
      this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.classList.remove('focused');
    });
  });

  // Add loading state to submit buttons
  const modalForms = document.querySelectorAll('.modal form');
  modalForms.forEach(function(form) {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn && !submitBtn.disabled) {
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...';
        
        // Reset after 5 seconds if form doesn't submit (fallback)
        setTimeout(() => {
          if (submitBtn.disabled) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
          }
        }, 5000);
      }
    });
  });
});

/**
 * Show modal with enhanced animation
 * @param {string} modalId - ID of the modal to show
 */
function showModal(modalId) {
  const modalElement = document.getElementById(modalId);
  if (modalElement) {
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
  }
}

/**
 * Hide modal with enhanced animation
 * @param {string} modalId - ID of the modal to hide
 */
function hideModal(modalId) {
  const modalElement = document.getElementById(modalId);
  if (modalElement) {
    const modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) {
      modal.hide();
    }
  }
}

/**
 * Reset modal form and hide modal
 * @param {string} modalId - ID of the modal
 */
function resetAndHideModal(modalId) {
  const modalElement = document.getElementById(modalId);
  if (modalElement) {
    const form = modalElement.querySelector('form');
    if (form) {
      form.reset();
    }
    hideModal(modalId);
  }
}
