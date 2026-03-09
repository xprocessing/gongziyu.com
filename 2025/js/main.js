/**
 * 公子鱼科技官网 - 核心JavaScript
 * 包含导航、滚动、交互等核心功能
 */

(function() {
  'use strict';

  // ============================================
  // DOM Ready
  // ============================================
  document.addEventListener('DOMContentLoaded', function() {
    initNavigation();
    initScrollEffects();
    initRevealAnimations();
    initSmoothScroll();
    initCounters();
    initPageLoader();
  });

  // ============================================
  // 页面加载动画
  // ============================================
  function initPageLoader() {
    const loader = document.querySelector('.page-loader');
    if (!loader) return;

    window.addEventListener('load', function() {
      setTimeout(function() {
        loader.classList.add('hidden');
      }, 300);
    });
  }

  // ============================================
  // 导航功能
  // ============================================
  function initNavigation() {
    const navbar = document.querySelector('.navbar');
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    if (!navbar) return;

    // 滚动时改变导航栏样式
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
      const currentScroll = window.pageYOffset;
      
      if (currentScroll > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }

      lastScroll = currentScroll;
    }, { passive: true });

    // 移动端菜单切换
    if (menuToggle && navMenu) {
      menuToggle.addEventListener('click', function() {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.classList.toggle('menu-open');
      });

      // 点击导航链接后关闭菜单
      navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          menuToggle.classList.remove('active');
          navMenu.classList.remove('active');
          document.body.classList.remove('menu-open');
        });
      });
    }

    // 高亮当前页面导航
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    navLinks.forEach(function(link) {
      const href = link.getAttribute('href');
      if (href === currentPage || (currentPage === '' && href === 'index.html')) {
        link.classList.add('active');
      }
    });
  }

  // ============================================
  // 滚动效果
  // ============================================
  function initScrollEffects() {
    // 返回顶部按钮
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      window.addEventListener('scroll', function() {
        if (window.pageYOffset > 500) {
          backToTop.classList.add('visible');
        } else {
          backToTop.classList.remove('visible');
        }
      }, { passive: true });

      backToTop.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }
  }

  // ============================================
  // 滚动触发动画
  // ============================================
  function initRevealAnimations() {
    const revealElements = document.querySelectorAll('.reveal, .stagger-children');
    
    if (!revealElements.length) return;

    const revealObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
          
          // 触发子元素动画
          if (entry.target.classList.contains('stagger-children')) {
            entry.target.classList.add('active');
          }
          
          // 可选：只触发一次
          // revealObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(function(el) {
      revealObserver.observe(el);
    });
  }

  // ============================================
  // 平滑滚动
  // ============================================
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
      anchor.addEventListener('click', function(e) {
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          e.preventDefault();
          
          const headerHeight = document.querySelector('.navbar')?.offsetHeight || 0;
          const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
          
          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  // ============================================
  // 数字计数器动画
  // ============================================
  function initCounters() {
    const counters = document.querySelectorAll('[data-count]');
    
    if (!counters.length) return;

    const counterObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const target = parseInt(counter.getAttribute('data-count'));
          const duration = parseInt(counter.getAttribute('data-duration')) || 2000;
          const suffix = counter.getAttribute('data-suffix') || '';
          
          animateCounter(counter, target, duration, suffix);
          counterObserver.unobserve(counter);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(function(counter) {
      counterObserver.observe(counter);
    });
  }

  function animateCounter(element, target, duration, suffix) {
    const startTime = performance.now();
    const startValue = 0;

    function updateCounter(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      
      // 缓动函数
      const easeOutQuart = 1 - Math.pow(1 - progress, 4);
      const current = Math.floor(startValue + (target - startValue) * easeOutQuart);
      
      element.textContent = current + suffix;
      
      if (progress < 1) {
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = target + suffix;
      }
    }

    requestAnimationFrame(updateCounter);
  }

  // ============================================
  // 工具函数
  // ============================================
  
  // 节流函数
  window.throttle = function(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(function() {
          inThrottle = false;
        }, limit);
      }
    };
  };

  // 防抖函数
  window.debounce = function(func, wait) {
    let timeout;
    return function() {
      const context = this;
      const args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(function() {
        func.apply(context, args);
      }, wait);
    };
  };

  // 检测元素是否在视口内
  window.isInViewport = function(element, offset) {
    offset = offset || 0;
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= -offset &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + offset &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  };

})();
