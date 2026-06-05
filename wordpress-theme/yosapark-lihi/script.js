
    const header = document.getElementById('header');
    const hamburger = document.getElementById('hamburger');
    const drawer = document.getElementById('drawer');
    const drawerLinks = drawer.querySelectorAll('a[href^="#"]');

    const updateScrolledHeader = () => {
      if (window.scrollY > 80) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
    };

    updateScrolledHeader();
    window.addEventListener('scroll', updateScrolledHeader, { passive: true });

    const closeDrawer = () => {
      drawer.classList.remove('is-open');
      document.body.classList.remove('is-drawer-open');
      document.body.style.overflow = '';
      hamburger.setAttribute('aria-expanded', 'false');
      drawer.setAttribute('aria-hidden', 'true');
    };

    const openDrawer = () => {
      drawer.classList.add('is-open');
      document.body.classList.add('is-drawer-open');
      document.body.style.overflow = 'hidden';
      hamburger.setAttribute('aria-expanded', 'true');
      drawer.setAttribute('aria-hidden', 'false');
    };

    hamburger.addEventListener('click', () => {
      if (drawer.classList.contains('is-open')) {
        closeDrawer();
      } else {
        openDrawer();
      }
    });

    drawerLinks.forEach((link) => {
      link.addEventListener('click', closeDrawer);
    });

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener('click', (event) => {
        const targetId = anchor.getAttribute('href');
        if (!targetId || targetId === '#') {
          return;
        }
        const target = document.querySelector(targetId);
        if (!target) {
          return;
        }

        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');

          const sectionHeader = entry.target.querySelector('.section-header');
          if (sectionHeader) {
            sectionHeader.classList.add('is-visible');
          }

          entry.target.querySelectorAll('.animate-item').forEach((el, i) => {
            el.style.transitionDelay = `${i * 0.12}s`;
            el.classList.add('is-visible');
          });
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('[data-section]').forEach((el) => observer.observe(el));
  