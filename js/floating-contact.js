// Floating Contact Widget Script
(function () {
  'use strict';

  // Đợi DOM load xong và đảm bảo body đã sẵn sàng
  function initFloatingWidget() {
    // Kiểm tra xem widget đã tồn tại chưa
    const existingWidget = document.querySelector('.floating-contact-widget');
    if (existingWidget) {
      // Nếu đã tồn tại nhưng không phải trong body, di chuyển nó
      if (existingWidget.parentElement !== document.body) {
        document.body.appendChild(existingWidget);
      }
      // Đảm bảo style được áp dụng
      applyWidgetStyles(existingWidget);
      return;
    }

    // Kiểm tra body đã sẵn sàng chưa
    if (!document.body) {
      setTimeout(initFloatingWidget, 50);
      return;
    }

    // Lấy dữ liệu từ PHP (sẽ được inject vào)
    const contactData = window.floatingContactData || {
      phone: '+914298300',
      facebook: 'https://www.facebook.com/DaiHocNguyenTatThanh',
      zalo: 'https://zalo.me/914298300'
    };

    // Tạo widget HTML
    const widgetHTML = `
      <div class="floating-contact-widget">
        <!-- Call Button -->
        <div class="floating-btn-wrapper call-btn-wrapper">
          <a href="tel:${contactData.phone.replace(/\s/g, '')}" 
             class="floating-btn call-btn" 
             aria-label="Gọi điện thoại">
            <i class="bi bi-telephone-fill"></i>
          </a>
          <div class="phone-number-tooltip">
            <span class="phone-number-text">${contactData.phone}</span>
          </div>
        </div>

        <!-- Facebook Button -->
        <div class="floating-btn-wrapper fb-btn-wrapper">
          <a href="${contactData.facebook}" 
             target="_blank" 
             rel="noopener noreferrer"
             class="floating-btn fb-btn" 
             aria-label="Liên hệ qua Facebook">
            <i class="bi bi-facebook"></i>
          </a>
        </div>

        <!-- Zalo Button -->
        <div class="floating-btn-wrapper zalo-btn-wrapper">
          <a href="${contactData.zalo}" 
             target="_blank" 
             rel="noopener noreferrer"
             class="floating-btn zalo-btn" 
             aria-label="Liên hệ qua Zalo">
            <i class="bi bi-chat-dots-fill"></i>
          </a>
        </div>
      </div>
    `;

    // Tạo element từ HTML
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = widgetHTML;
    const widget = tempDiv.firstElementChild;

    // Áp dụng styles cho widget và các phần tử con
    applyWidgetStyles(widget);

    // Chèn vào body (luôn ở cuối body)
    document.body.appendChild(widget);

    // Đảm bảo CSS được áp dụng bằng cách force reflow
    void widget.offsetHeight;
  }

  // Hàm áp dụng styles cho widget và các phần tử con
  function applyWidgetStyles(widget) {
    // Styles cho widget chính
    widget.style.position = 'fixed';
    widget.style.bottom = '30px';
    widget.style.right = '30px';
    widget.style.left = 'auto';
    widget.style.top = 'auto';
    widget.style.zIndex = '9999';
    widget.style.display = 'flex';
    widget.style.flexDirection = 'column';
    widget.style.gap = '15px';
    widget.style.margin = '0';
    widget.style.padding = '0';
    widget.style.width = 'auto';
    widget.style.height = 'auto';
    widget.style.transform = 'none';

    // Áp dụng styles cho các button wrappers
    const wrappers = widget.querySelectorAll('.floating-btn-wrapper');
    wrappers.forEach((wrapper, index) => {
      wrapper.style.position = 'relative';
      wrapper.style.display = 'flex';
      wrapper.style.alignItems = 'center';
      // Animation delay
      wrapper.style.animation = `fadeInUp 0.6s ease-out ${0.1 * (index + 1)}s backwards`;
    });

    // Áp dụng styles cho các buttons
    const buttons = widget.querySelectorAll('.floating-btn');
    buttons.forEach((btn, index) => {
      btn.style.width = '60px';
      btn.style.height = '60px';
      btn.style.borderRadius = '50%';
      btn.style.display = 'flex';
      btn.style.alignItems = 'center';
      btn.style.justifyContent = 'center';
      btn.style.fontSize = '24px';
      btn.style.color = 'white';
      btn.style.textDecoration = 'none';
      btn.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2), 0 2px 5px rgba(0, 0, 0, 0.1)';
      btn.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
      btn.style.position = 'relative';
      btn.style.zIndex = '2';
      btn.style.overflow = 'hidden';
      btn.style.cursor = 'pointer';
      btn.style.border = 'none';
      btn.style.outline = 'none';

      // Background gradient cho từng button
      if (btn.classList.contains('call-btn')) {
        btn.style.background = 'linear-gradient(135deg, #25D366 0%, #128C7E 100%)';
      } else if (btn.classList.contains('fb-btn')) {
        btn.style.background = 'linear-gradient(135deg, #1877F2 0%, #0C63D4 100%)';
      } else if (btn.classList.contains('zalo-btn')) {
        btn.style.background = 'linear-gradient(135deg, #0068FF 0%, #0052CC 100%)';
      }

      // Thêm pulse effect cho call button
      if (btn.classList.contains('call-btn')) {
        const pulse = document.createElement('div');
        pulse.style.position = 'absolute';
        pulse.style.width = '100%';
        pulse.style.height = '100%';
        pulse.style.borderRadius = '50%';
        pulse.style.background = 'rgba(37, 211, 102, 0.4)';
        pulse.style.animation = 'pulse 2s infinite';
        pulse.style.zIndex = '-1';
        pulse.style.pointerEvents = 'none';
        btn.appendChild(pulse);
      }

      // Hover effect
      btn.addEventListener('mouseenter', function () {
        this.style.transform = 'translateY(-5px) scale(1.05)';
        this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.3), 0 4px 10px rgba(0, 0, 0, 0.15)';
      });

      btn.addEventListener('mouseleave', function () {
        this.style.transform = 'translateY(0) scale(1)';
        this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2), 0 2px 5px rgba(0, 0, 0, 0.1)';
      });
    });

    // Áp dụng styles cho tooltip
    const tooltip = widget.querySelector('.phone-number-tooltip');
    if (tooltip) {
      tooltip.style.position = 'absolute';
      tooltip.style.right = '70px';
      tooltip.style.top = '50%';
      tooltip.style.transform = 'translateY(-50%) translateX(10px)';
      tooltip.style.background = 'linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%)';
      tooltip.style.padding = '12px 24px';
      tooltip.style.borderRadius = '30px';
      tooltip.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1)';
      tooltip.style.whiteSpace = 'nowrap';
      tooltip.style.opacity = '0';
      tooltip.style.visibility = 'hidden';
      tooltip.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
      tooltip.style.pointerEvents = 'none';
      tooltip.style.zIndex = '1';
      tooltip.style.border = '1px solid rgba(45, 106, 79, 0.1)';

      // Tạo arrow cho tooltip
      const arrow = document.createElement('div');
      arrow.style.position = 'absolute';
      arrow.style.right = '-10px';
      arrow.style.top = '50%';
      arrow.style.transform = 'translateY(-50%)';
      arrow.style.width = '0';
      arrow.style.height = '0';
      arrow.style.borderTop = '10px solid transparent';
      arrow.style.borderBottom = '10px solid transparent';
      arrow.style.borderLeft = '10px solid #ffffff';
      arrow.style.filter = 'drop-shadow(2px 0 2px rgba(0, 0, 0, 0.1))';
      tooltip.appendChild(arrow);

      // Tooltip text styles
      const tooltipText = tooltip.querySelector('.phone-number-text');
      if (tooltipText) {
        tooltipText.style.color = '#2D6A4F';
        tooltipText.style.fontWeight = '700';
        tooltipText.style.fontSize = '16px';
        tooltipText.style.letterSpacing = '0.5px';
        tooltipText.style.display = 'flex';
        tooltipText.style.alignItems = 'center';
        tooltipText.style.gap = '8px';
      }

      // Hover effect cho call button wrapper để hiện tooltip
      const callWrapper = widget.querySelector('.call-btn-wrapper');
      if (callWrapper) {
        callWrapper.addEventListener('mouseenter', function () {
          tooltip.style.opacity = '1';
          tooltip.style.visibility = 'visible';
          tooltip.style.transform = 'translateY(-50%) translateX(0)';
          tooltip.style.right = '75px';
        });

        callWrapper.addEventListener('mouseleave', function () {
          tooltip.style.opacity = '0';
          tooltip.style.visibility = 'hidden';
          tooltip.style.transform = 'translateY(-50%) translateX(10px)';
          tooltip.style.right = '70px';
        });
      }
    }
  }

  // Đảm bảo CSS đã được load
  function ensureCSSLoaded() {
    // Kiểm tra xem CSS đã load chưa bằng cách kiểm tra computed style
    const testEl = document.createElement('div');
    testEl.className = 'floating-contact-widget';
    testEl.style.display = 'none';
    document.body.appendChild(testEl);
    const styles = window.getComputedStyle(testEl);
    const cssLoaded = styles.position !== '' || document.querySelector('link[href*="common.css"]');
    document.body.removeChild(testEl);
    return cssLoaded;
  }

  // Chạy khi DOM ready hoặc ngay lập tức nếu đã ready
  function init() {
    // Đợi CSS load xong
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
          if (ensureCSSLoaded() || document.readyState === 'complete') {
            initFloatingWidget();
          } else {
            setTimeout(initFloatingWidget, 200);
          }
        }, 100);
      });
    } else {
      // Nếu DOM đã ready, đợi một chút để đảm bảo CSS và body đã render
      setTimeout(function () {
        if (ensureCSSLoaded() || document.readyState === 'complete') {
          initFloatingWidget();
        } else {
          setTimeout(initFloatingWidget, 200);
        }
      }, 100);
    }
  }

  init();

  // Fallback: chạy lại sau khi window load hoàn toàn
  window.addEventListener('load', function () {
    setTimeout(function () {
      if (!document.querySelector('.floating-contact-widget')) {
        initFloatingWidget();
      }
    }, 100);
  });
})();
