/**
 * 公子鱼科技官网 - 表单处理
 */

(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    initContactForm();
    initFormValidation();
  });

  // ============================================
  // 联系表单
  // ============================================
  function initContactForm() {
    const form = document.querySelector('.contact-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (validateForm(form)) {
        submitForm(form);
      }
    });
  }

  // ============================================
  // 表单验证
  // ============================================
  function initFormValidation() {
    const inputs = document.querySelectorAll('.form-input, .form-textarea');
    
    inputs.forEach(function(input) {
      // 实时验证
      input.addEventListener('blur', function() {
        validateField(this);
      });

      // 输入时清除错误
      input.addEventListener('input', function() {
        clearFieldError(this);
      });
    });
  }

  function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';

    // 必填验证
    if (field.required && !value) {
      isValid = false;
      errorMessage = '此项为必填项';
    }

    // 邮箱验证
    if (fieldName === 'email' && value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(value)) {
        isValid = false;
        errorMessage = '请输入有效的邮箱地址';
      }
    }

    // 电话验证
    if (fieldName === 'phone' && value) {
      const phoneRegex = /^1[3-9]\d{9}$/;
      if (!phoneRegex.test(value)) {
        isValid = false;
        errorMessage = '请输入有效的手机号码';
      }
    }

    // 显示或清除错误
    if (!isValid) {
      showFieldError(field, errorMessage);
    } else {
      clearFieldError(field);
    }

    return isValid;
  }

  function validateForm(form) {
    const fields = form.querySelectorAll('.form-input, .form-textarea');
    let isFormValid = true;

    fields.forEach(function(field) {
      if (!validateField(field)) {
        isFormValid = false;
      }
    });

    return isFormValid;
  }

  function showFieldError(field, message) {
    clearFieldError(field);
    
    field.classList.add('error');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
  }

  function clearFieldError(field) {
    field.classList.remove('error');
    
    const existingError = field.parentNode.querySelector('.form-error');
    if (existingError) {
      existingError.remove();
    }
  }

  // ============================================
  // 表单提交
  // ============================================
  function submitForm(form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn ? submitBtn.textContent : '提交';
    
    // 禁用提交按钮
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = '提交中...';
    }

    // 收集表单数据
    const formData = new FormData(form);
    const data = {};
    formData.forEach(function(value, key) {
      data[key] = value;
    });

    // 模拟提交（实际项目中替换为真实API）
    setTimeout(function() {
      // 显示成功消息
      showNotification('success', '提交成功！我们会尽快与您联系。');
      
      // 重置表单
      form.reset();
      
      // 恢复按钮
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    }, 1500);

    // 实际API调用示例：
    /*
    fetch('/api/contact', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        showNotification('success', '提交成功！我们会尽快与您联系。');
        form.reset();
      } else {
        showNotification('error', result.message || '提交失败，请重试。');
      }
    })
    .catch(error => {
      showNotification('error', '网络错误，请稍后重试。');
    })
    .finally(() => {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    });
    */
  }

  // ============================================
  // 通知提示
  // ============================================
  function showNotification(type, message) {
    // 移除现有通知
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
      existingNotification.remove();
    }

    // 创建通知元素
    const notification = document.createElement('div');
    notification.className = 'notification notification-' + type;
    notification.innerHTML = `
      <div class="notification-content">
        <span class="notification-icon">${type === 'success' ? '✓' : '✕'}</span>
        <span class="notification-message">${message}</span>
      </div>
      <button class="notification-close">&times;</button>
    `;

    // 添加样式
    notification.style.cssText = `
      position: fixed;
      top: 100px;
      right: 20px;
      background: ${type === 'success' ? 'rgba(16, 185, 129, 0.95)' : 'rgba(239, 68, 68, 0.95)'};
      color: white;
      padding: 16px 24px;
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      display: flex;
      align-items: center;
      gap: 12px;
      z-index: 10000;
      transform: translateX(120%);
      transition: transform 0.3s ease;
      backdrop-filter: blur(10px);
    `;

    document.body.appendChild(notification);

    // 动画进入
    setTimeout(function() {
      notification.style.transform = 'translateX(0)';
    }, 100);

    // 关闭按钮
    notification.querySelector('.notification-close').addEventListener('click', function() {
      closeNotification(notification);
    });

    // 自动关闭
    setTimeout(function() {
      closeNotification(notification);
    }, 5000);
  }

  function closeNotification(notification) {
    notification.style.transform = 'translateX(120%)';
    setTimeout(function() {
      notification.remove();
    }, 300);
  }

  // 暴露到全局
  window.showNotification = showNotification;

})();
