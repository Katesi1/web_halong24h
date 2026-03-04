/**
 * Dashboard Analytics with Chart.js Integration
 * Modern charts and smooth animations
 */

let bookingChart = null;
let userChart = null;

function booking_analytics(period = 1) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/dashboard.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
    if (this.status === 200) {
      try {
        let data = JSON.parse(this.responseText);
        
        // Update statistics cards
        document.getElementById('total_bookings').textContent = data.total_bookings || 0;
        document.getElementById('total_amt').textContent = formatCurrency(data.total_amt || 0) + ' VND';

        document.getElementById('active_bookings').textContent = data.active_bookings || 0;
        document.getElementById('active_amt').textContent = formatCurrency(data.active_amt || 0) + ' VND';
        
        document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings || 0;
        document.getElementById('cancelled_amt').textContent = formatCurrency(data.cancelled_amt || 0) + ' VND';

        // Update chart
        updateBookingChart(data);
      } catch (e) {
        console.error('Error parsing booking analytics:', e);
        if (typeof toast !== 'undefined') {
          toast.error('Lỗi khi tải dữ liệu phân tích đặt phòng');
        }
      }
    }
  };

  xhr.onerror = function() {
    if (typeof toast !== 'undefined') {
      toast.error('Lỗi kết nối khi tải dữ liệu');
    }
  };

  xhr.send('booking_analytics&period=' + period);
}

function user_analytics(period = 1) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/dashboard.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
    if (this.status === 200) {
      try {
        let data = JSON.parse(this.responseText);

        document.getElementById('total_new_reg').textContent = data.total_new_reg || 0;
        document.getElementById('total_queries').textContent = data.total_queries || 0;
        document.getElementById('total_reviews').textContent = data.total_reviews || 0;

        // Update chart
        updateUserChart(data);
      } catch (e) {
        console.error('Error parsing user analytics:', e);
        if (typeof toast !== 'undefined') {
          toast.error('Lỗi khi tải dữ liệu phân tích người dùng');
        }
      }
    }
  };

  xhr.onerror = function() {
    if (typeof toast !== 'undefined') {
      toast.error('Lỗi kết nối khi tải dữ liệu');
    }
  };

  xhr.send('user_analytics&period=' + period);
}

function updateBookingChart(data) {
  const ctx = document.getElementById('bookingChart');
  if (!ctx) return;

  if (bookingChart) {
    bookingChart.destroy();
  }

  bookingChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Tổng đặt phòng', 'Đặt phòng đang hoạt động', 'Đặt phòng đã hủy'],
      datasets: [{
        label: 'Số lượng',
        data: [
          parseInt(data.total_bookings) || 0,
          parseInt(data.active_bookings) || 0,
          parseInt(data.cancelled_bookings) || 0
        ],
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37, 99, 235, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#2563eb',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 2,
        pointRadius: 6,
        pointHoverRadius: 8
      }, {
        label: 'Doanh thu (VND)',
        data: [
          parseFloat(data.total_amt) || 0,
          parseFloat(data.active_amt) || 0,
          parseFloat(data.cancelled_amt) || 0
        ],
        borderColor: '#10b981',
        backgroundColor: 'rgba(16, 185, 129, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#10b981',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 2,
        pointRadius: 6,
        pointHoverRadius: 8,
        yAxisID: 'y1'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: true,
          position: 'top',
          labels: {
            usePointStyle: true,
            padding: 15,
            font: {
              size: 13,
              weight: '500'
            }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          padding: 12,
          titleFont: {
            size: 14,
            weight: '600'
          },
          bodyFont: {
            size: 13
          },
          borderColor: 'rgba(255, 255, 255, 0.1)',
          borderWidth: 1,
          cornerRadius: 8,
          displayColors: true,
          callbacks: {
            label: function(context) {
              if (context.datasetIndex === 1) {
                return context.dataset.label + ': ' + formatCurrency(context.parsed.y) + ' VND';
              }
              return context.dataset.label + ': ' + context.parsed.y;
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            font: {
              size: 12
            },
            color: '#64748b'
          },
          grid: {
            color: 'rgba(226, 232, 240, 0.5)'
          }
        },
        y1: {
          type: 'linear',
          display: true,
          position: 'right',
          beginAtZero: true,
          ticks: {
            font: {
              size: 12
            },
            color: '#64748b',
            callback: function(value) {
              return formatCurrency(value) + ' VND';
            }
          },
          grid: {
            drawOnChartArea: false
          }
        },
        x: {
          ticks: {
            font: {
              size: 12
            },
            color: '#64748b'
          },
          grid: {
            color: 'rgba(226, 232, 240, 0.5)'
          }
        }
      },
      animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
      },
      interaction: {
        intersect: false,
        mode: 'index'
      }
    }
  });
}

function updateUserChart(data) {
  const ctx = document.getElementById('userChart');
  if (!ctx) return;

  if (userChart) {
    userChart.destroy();
  }

  userChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Đăng ký mới', 'Tin nhắn', 'Đánh giá'],
      datasets: [{
        label: 'Số lượng',
        data: [
          parseInt(data.total_new_reg) || 0,
          parseInt(data.total_queries) || 0,
          parseInt(data.total_reviews) || 0
        ],
        backgroundColor: [
          'rgba(16, 185, 129, 0.8)',
          'rgba(59, 130, 246, 0.8)',
          'rgba(139, 92, 246, 0.8)'
        ],
        borderColor: [
          '#10b981',
          '#3b82f6',
          '#8b5cf6'
        ],
        borderWidth: 2,
        borderRadius: 8,
        borderSkipped: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          padding: 12,
          titleFont: {
            size: 14,
            weight: '600'
          },
          bodyFont: {
            size: 13
          },
          borderColor: 'rgba(255, 255, 255, 0.1)',
          borderWidth: 1,
          cornerRadius: 8,
          displayColors: true
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            font: {
              size: 12
            },
            color: '#64748b',
            stepSize: 1
          },
          grid: {
            color: 'rgba(226, 232, 240, 0.5)'
          }
        },
        x: {
          ticks: {
            font: {
              size: 12
            },
            color: '#64748b'
          },
          grid: {
            display: false
          }
        }
      },
      animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
      }
    }
  });
}

function formatCurrency(value) {
  return parseFloat(value || 0).toLocaleString('vi-VN');
}

// Initialize charts on page load
window.onload = function() {
  booking_analytics();
  user_analytics();
  
  // Add smooth scroll behavior
  document.documentElement.style.scrollBehavior = 'smooth';
  
  // Add loading states to stat cards
  const statCards = document.querySelectorAll('.stat-card');
  statCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transition = 'all 0.3s ease';
    });
  });
};
