// ===========================
// NAVBAR — scroll effect
// ===========================
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 24);
}, { passive: true });

// ===========================
// NAV DROPDOWNS
// ===========================
document.querySelectorAll('.nav-dropdown').forEach(drop => {
  const trigger = drop.querySelector('.nav-dropdown__trigger');
  const menu    = drop.querySelector('.nav-dropdown__menu, .nav-mega');
  if (!trigger) return;

  let hoverTimer;

  function openDrop() {
    // Close all others first
    document.querySelectorAll('.nav-dropdown.open').forEach(d => {
      if (d !== drop) closeDrop(d);
    });
    drop.classList.add('open');
    trigger.setAttribute('aria-expanded', 'true');
  }
  function closeDrop(target) {
    const t = target || drop;
    t.classList.remove('open');
    t.querySelector('.nav-dropdown__trigger')?.setAttribute('aria-expanded', 'false');
  }

  // Hover on desktop
  drop.addEventListener('mouseenter', () => { clearTimeout(hoverTimer); openDrop(); });
  drop.addEventListener('mouseleave', () => { hoverTimer = setTimeout(() => closeDrop(), 140); });

  // Click toggle (mobile / keyboard)
  trigger.addEventListener('click', (e) => {
    e.stopPropagation();
    drop.classList.contains('open') ? closeDrop() : openDrop();
  });

  // Close on menu item click
  menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => closeDrop()));
});

// Close dropdowns on outside click
document.addEventListener('click', () => {
  document.querySelectorAll('.nav-dropdown.open').forEach(d => {
    d.classList.remove('open');
    d.querySelector('.nav-dropdown__trigger')?.setAttribute('aria-expanded', 'false');
  });
});

// Close on Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    document.querySelectorAll('.nav-dropdown.open').forEach(d => {
      d.classList.remove('open');
      d.querySelector('.nav-dropdown__trigger')?.setAttribute('aria-expanded', 'false');
    });
  }
});

// ===========================
// MOBILE DRAWER
// ===========================
const navToggle  = document.getElementById('navToggle');
const mobDrawer  = document.getElementById('mobDrawer');
const mobOverlay = document.getElementById('mobOverlay');
const mobClose   = document.getElementById('mobClose');

function openDrawer() {
  mobDrawer.classList.add('open');
  mobDrawer.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
  document.querySelectorAll('.nav-dropdown.open').forEach(d => d.classList.remove('open'));
}
function closeDrawer() {
  mobDrawer.classList.remove('open');
  mobDrawer.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
}

if (navToggle)  navToggle.addEventListener('click', openDrawer);
if (mobClose)   mobClose.addEventListener('click', closeDrawer);
if (mobOverlay) mobOverlay.addEventListener('click', closeDrawer);

// Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && mobDrawer?.classList.contains('open')) closeDrawer();
});

// Accordion sections
document.querySelectorAll('.mob-section__trigger').forEach(trigger => {
  trigger.addEventListener('click', () => {
    const section = trigger.closest('.mob-section');
    const isOpen  = section.classList.contains('open');
    // Close siblings
    document.querySelectorAll('.mob-section.open').forEach(s => {
      s.classList.remove('open');
      s.querySelector('.mob-section__trigger').setAttribute('aria-expanded', 'false');
    });
    if (!isOpen) {
      section.classList.add('open');
      trigger.setAttribute('aria-expanded', 'true');
    }
  });
});

// Close drawer on link click
document.querySelectorAll('.mob-drawer__panel a').forEach(link => {
  link.addEventListener('click', closeDrawer);
});

// ===========================
// RUN PAGE — sticky nav highlight
// ===========================
const runNav = document.getElementById('runNav');
if (runNav) {
  const sections = ['academy', 'projects', 'consulting', 'cowork'].map(id => document.getElementById(id)).filter(Boolean);
  const items    = runNav.querySelectorAll('.run-nav__item');

  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
      if (window.scrollY >= section.offsetTop - 120) current = section.id;
    });
    items.forEach(item => {
      item.classList.toggle('active', item.dataset.target === current);
    });
  }, { passive: true });
}

// ===========================
// SCROLL REVEAL
// ===========================
const revealEls = document.querySelectorAll('.reveal');

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const siblings = Array.from(entry.target.parentElement.querySelectorAll('.reveal:not(.visible)'));
      const idx = siblings.indexOf(entry.target);
      setTimeout(() => entry.target.classList.add('visible'), idx * 80);
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

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
    const top = target.getBoundingClientRect().top + window.scrollY - 80;
    window.scrollTo({ top, behavior: 'smooth' });
  });
});

// ===========================
// ANIMATED COUNTER (stats)
// ===========================
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el   = entry.target;
      const text = el.textContent.trim();
      const duration = 1600;
      const start = performance.now();

      let num, prefix, suffix;
      if (text.startsWith('R$')) { num = 48;   prefix = 'R$ '; suffix = 'M+'; }
      else if (text.includes('%')) { num = 98;  prefix = '';   suffix = '%'; }
      else                         { num = 3200; prefix = '';  suffix = '+'; }

      el.dataset.original = text;

      function update(now) {
        const progress = Math.min((now - start) / duration, 1);
        const ease     = 1 - Math.pow(1 - progress, 3);
        const current  = Math.floor(num * ease);
        if (num >= 1000) {
          const t = Math.floor(current / 1000);
          const h = String(current % 1000).padStart(3, '0');
          el.textContent = prefix + t + '.' + h + suffix;
        } else {
          el.textContent = prefix + current + suffix;
        }
        if (progress < 1) requestAnimationFrame(update);
        else el.textContent = text;
      }
      requestAnimationFrame(update);
      statsObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.hero__stat-value').forEach(el => statsObserver.observe(el));

// ===========================
// FAQ ACCORDION
// ===========================
document.querySelectorAll('.faq-item__trigger').forEach(trigger => {
  trigger.addEventListener('click', () => {
    const item   = trigger.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(i => {
      i.classList.remove('open');
      i.querySelector('.faq-item__trigger').setAttribute('aria-expanded', 'false');
    });
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
  if (!messagesEl || !inputEl) return;

  const exchanges = [
    { user: 'Crie um relatório de vendas do trimestre', ai: 'Pronto! Vendas do Q3: R$ 284.500 (+18% vs Q2). Top produto: Consultoria Premium. Detalhes no dashboard.' },
    { user: 'Quais clientes estão inadimplentes?', ai: 'Encontrei 7 clientes com pagamentos vencidos. O maior débito é de R$ 12.800 (Empresa Silva & Filhos, 45 dias).' },
    { user: 'Registre R$ 4.520 do cliente Marcos', ai: 'Pagamento registrado! Fatura #1082 marcada como paga. Saldo do Marcos: R$ 0,00. Recibo enviado por e-mail.' },
    { user: 'Projete o fluxo de caixa dos próximos 30 dias', ai: 'Projeção: entradas R$ 96.300 · saídas R$ 71.400 · saldo previsto R$ +24.900. Risco: 2 contratos vencendo.' }
  ];
  let exIdx = 0, started = false;

  function typeText(el, text, speed, cb) {
    let i = 0; el.textContent = '';
    const t = setInterval(() => { el.textContent += text[i++]; if (i >= text.length) { clearInterval(t); if (cb) cb(); } }, speed);
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
        setTimeout(() => { dots.remove(); div.textContent = text; messagesEl.appendChild(div); messagesEl.scrollTop = messagesEl.scrollHeight; setTimeout(resolve, 800); }, 1400);
      });
    }
    div.textContent = text; messagesEl.appendChild(div); messagesEl.scrollTop = messagesEl.scrollHeight;
    return Promise.resolve();
  }
  async function runExchange() {
    const ex = exchanges[exIdx++ % exchanges.length];
    await new Promise(r => typeText(inputEl, ex.user, 42, r));
    await new Promise(r => setTimeout(r, 400));
    inputEl.textContent = '';
    await addBubble('user', ex.user);
    await addBubble('ai', ex.ai);
    await new Promise(r => setTimeout(r, 2200));
    while (messagesEl.children.length > 6) messagesEl.firstChild.remove();
    runExchange();
  }
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting && !started) { started = true; setTimeout(runExchange, 800); observer.disconnect(); } });
  }, { threshold: 0.3 });
  observer.observe(document.getElementById('ia') || messagesEl);
})();

