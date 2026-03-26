// ===========================
// NAVBAR — scroll effect
// ===========================
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  if (window.scrollY > 24) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
}, { passive: true });

// ===========================
// MEGA MENU
// ===========================
const megaTrigger = document.getElementById('megaTrigger');
const megaMenu    = document.getElementById('megaMenu');

function openMega() {
  megaMenu.classList.add('open');
  megaTrigger.classList.add('open');
  megaTrigger.setAttribute('aria-expanded', 'true');
}
function closeMega() {
  megaMenu.classList.remove('open');
  megaTrigger.classList.remove('open');
  megaTrigger.setAttribute('aria-expanded', 'false');
}

if (megaTrigger && megaMenu) {
  // Hover on desktop
  let hoverTimer;
  megaTrigger.addEventListener('mouseenter', () => { clearTimeout(hoverTimer); openMega(); });
  megaMenu.addEventListener('mouseenter',    () => { clearTimeout(hoverTimer); });
  megaTrigger.addEventListener('mouseleave', () => { hoverTimer = setTimeout(closeMega, 120); });
  megaMenu.addEventListener('mouseleave',    () => { hoverTimer = setTimeout(closeMega, 120); });

  // Click toggle (mobile / keyboard)
  megaTrigger.addEventListener('click', (e) => {
    e.stopPropagation();
    megaMenu.classList.contains('open') ? closeMega() : openMega();
  });

  // Close on outside click
  document.addEventListener('click', (e) => {
    if (!navbar.contains(e.target)) closeMega();
  });

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMega();
  });

  // Close when clicking a mega card link
  megaMenu.querySelectorAll('.mega-card').forEach(card => {
    card.addEventListener('click', closeMega);
  });
}

// ===========================
// MOBILE MENU
// ===========================
const navToggle = document.getElementById('navToggle');
const mobileMenu = document.getElementById('mobileMenu');

navToggle.addEventListener('click', () => {
  mobileMenu.classList.toggle('open');
  closeMega();
});

// Close mobile menu when a link is clicked
document.querySelectorAll('.mobile-menu__link').forEach(link => {
  link.addEventListener('click', () => {
    mobileMenu.classList.remove('open');
  });
});

// ===========================
// SCROLL REVEAL
// ===========================
const revealEls = document.querySelectorAll('.reveal');

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      // Stagger siblings in the same parent
      const siblings = Array.from(entry.target.parentElement.querySelectorAll('.reveal:not(.visible)'));
      const idx = siblings.indexOf(entry.target);
      setTimeout(() => {
        entry.target.classList.add('visible');
      }, idx * 80);
      revealObserver.unobserve(entry.target);
    }
  });
}, {
  threshold: 0.1,
  rootMargin: '0px 0px -60px 0px'
});

revealEls.forEach(el => revealObserver.observe(el));

// ===========================
// SMOOTH ANCHOR SCROLL
// ===========================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', (e) => {
    const href = anchor.getAttribute('href');
    if (href === '#') return;
    const target = document.querySelector(href);
    if (!target) return;
    e.preventDefault();
    const offset = 80;
    const top = target.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top, behavior: 'smooth' });
  });
});

// ===========================
// ANIMATED COUNTER (stats)
// ===========================
function animateCounter(el, target, suffix, duration = 1400) {
  const isFloat = target % 1 !== 0;
  const start = performance.now();

  function update(now) {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    // Ease out cubic
    const ease = 1 - Math.pow(1 - progress, 3);
    const current = isFloat ? (target * ease).toFixed(1) : Math.floor(target * ease);
    el.textContent = current + suffix;
    if (progress < 1) requestAnimationFrame(update);
  }
  requestAnimationFrame(update);
}

const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const raw = el.dataset.value;
      const suffix = el.dataset.suffix || '';
      const num = parseFloat(raw);
      animateCounter(el, num, suffix);
      statsObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

// Attach counters to stat values
document.querySelectorAll('.hero__stat-value').forEach(el => {
  const text = el.textContent.trim();
  // Parse: "3.200+" → 3200, "R$ 48M+" → 48, "98%" → 98
  if (text.startsWith('R$')) {
    el.dataset.value = '48';
    el.dataset.suffix = 'M+';
    el.dataset.prefix = 'R$ ';
  } else if (text.includes('%')) {
    el.dataset.value = '98';
    el.dataset.suffix = '%';
  } else {
    el.dataset.value = '3200';
    el.dataset.suffix = '+';
  }
  statsObserver.observe(el);
});

// Override animateCounter to handle prefix
function animateCounterFull(el, target, prefix, suffix, duration = 1400) {
  const start = performance.now();
  function update(now) {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    const ease = 1 - Math.pow(1 - progress, 3);
    const current = Math.floor(target * ease);
    const display = current >= 1000
      ? (current / 1000).toFixed(1).replace('.', '.') + '.' + String(current % 1000).padStart(3, '0').substring(0,0)
      : current;
    el.textContent = prefix + (target >= 1000 ? (current >= 1000 ? Math.round(current/1000*10)/10 + '.000' : '0') : current) + suffix;
    if (progress < 1) requestAnimationFrame(update);
  }
  requestAnimationFrame(update);
}

// Re-observe with corrected display logic
const statsObserver2 = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const text = el.dataset.originalText;
      const duration = 1600;
      const start = performance.now();

      // Animate to final text by counting up the number part
      let num, prefix, suffix;
      if (text.startsWith('R$')) {
        num = 48; prefix = 'R$ '; suffix = 'M+';
      } else if (text.includes('%')) {
        num = 98; prefix = ''; suffix = '%';
      } else {
        num = 3200; prefix = ''; suffix = '+';
      }

      function update(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(num * ease);
        if (num >= 1000) {
          const thousands = Math.floor(current / 1000);
          const hundreds = current % 1000;
          el.textContent = prefix + thousands + '.' + String(hundreds).padStart(3, '0') + suffix;
        } else {
          el.textContent = prefix + current + suffix;
        }
        if (progress < 1) requestAnimationFrame(update);
        else el.textContent = text; // restore original at end
      }
      requestAnimationFrame(update);
      statsObserver2.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.hero__stat-value').forEach(el => {
  el.dataset.originalText = el.textContent.trim();
  statsObserver2.observe(el);
});

// ===========================
// FAQ ACCORDION
// ===========================
document.querySelectorAll('.faq-item__trigger').forEach(trigger => {
  trigger.addEventListener('click', () => {
    const item = trigger.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-item').forEach(i => {
      i.classList.remove('open');
      i.querySelector('.faq-item__trigger').setAttribute('aria-expanded', 'false');
    });

    // Open clicked if it was closed
    if (!isOpen) {
      item.classList.add('open');
      trigger.setAttribute('aria-expanded', 'true');
    }
  });
});

// ===========================
// AI CHAT — typing animation
// ===========================
(function () {
  const messagesEl = document.getElementById('aiMessages');
  const inputEl    = document.getElementById('aiInputText');
  const cursorEl   = document.getElementById('aiCursor');
  if (!messagesEl || !inputEl) return;

  const exchanges = [
    {
      user: 'Crie um relatório de vendas do trimestre',
      ai:   'Pronto! Vendas do Q3: R$ 284.500 (+18% vs Q2). Top produto: Consultoria Premium. Detalhes no dashboard.'
    },
    {
      user: 'Quais clientes estão inadimplentes?',
      ai:   'Encontrei 7 clientes com pagamentos vencidos. O maior débito é de R$ 12.800 (Empresa Silva & Filhos, 45 dias).'
    },
    {
      user: 'Registre R$ 4.520 do cliente Marcos',
      ai:   'Pagamento registrado! Fatura #1082 marcada como paga. Saldo do Marcos: R$ 0,00. Recibo enviado por e-mail.'
    },
    {
      user: 'Projete o fluxo de caixa dos próximos 30 dias',
      ai:   'Projeção: entradas R$ 96.300 · saídas R$ 71.400 · saldo previsto R$ +24.900. Risco: 2 contratos vencendo.'
    }
  ];

  let exIdx = 0;
  let started = false;

  function typeText(el, text, speed, cb) {
    let i = 0;
    el.textContent = '';
    const t = setInterval(() => {
      el.textContent += text[i++];
      if (i >= text.length) { clearInterval(t); if (cb) cb(); }
    }, speed);
  }

  function addBubble(type, text) {
    const div = document.createElement('div');
    div.className = 'ai-bubble ai-bubble--' + type;
    if (type === 'ai') {
      const dots = document.createElement('div');
      dots.className = 'ai-typing-dots';
      dots.innerHTML = '<span></span><span></span><span></span>';
      messagesEl.appendChild(dots);
      messagesEl.scrollTop = messagesEl.scrollHeight;
      return new Promise(resolve => {
        setTimeout(() => {
          dots.remove();
          div.textContent = text;
          messagesEl.appendChild(div);
          messagesEl.scrollTop = messagesEl.scrollHeight;
          setTimeout(resolve, 800);
        }, 1400);
      });
    } else {
      div.textContent = text;
      messagesEl.appendChild(div);
      messagesEl.scrollTop = messagesEl.scrollHeight;
      return Promise.resolve();
    }
  }

  async function runExchange() {
    const ex = exchanges[exIdx % exchanges.length];
    exIdx++;

    // Type user message in input bar
    await new Promise(resolve => typeText(inputEl, ex.user, 42, resolve));
    await new Promise(r => setTimeout(r, 400));

    // Send — clear input, add user bubble
    inputEl.textContent = '';
    await addBubble('user', ex.user);

    // AI responds
    await addBubble('ai', ex.ai);

    // Pause then next
    await new Promise(r => setTimeout(r, 2200));

    // Keep only last 6 bubbles to avoid overflow
    while (messagesEl.children.length > 6) messagesEl.firstChild.remove();

    runExchange();
  }

  // Start when section enters viewport
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting && !started) {
        started = true;
        setTimeout(runExchange, 800);
        observer.disconnect();
      }
    });
  }, { threshold: 0.3 });

  observer.observe(document.getElementById('ia') || messagesEl);
})();

// ===========================
// MOBILE SECTION — parallax bg
// ===========================
const mobileBg = document.getElementById('mobileBg');
if (mobileBg) {
  const mobileSection = document.getElementById('mobileSection');
  let ticking = false;

  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        const rect = mobileSection.getBoundingClientRect();
        const viewH = window.innerHeight;
        if (rect.top < viewH && rect.bottom > 0) {
          const progress = (viewH - rect.top) / (viewH + mobileSection.offsetHeight);
          const translateY = Math.round((progress - 0.5) * 100);
          mobileBg.style.transform = `translateY(${translateY}px)`;
        }
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
}
