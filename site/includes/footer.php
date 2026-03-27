  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <div class="footer__logo"><img src="/site/uploads/logo-nidex-white.svg" alt="nidex" /></div>
        <p class="footer__desc">O ecossistema all-in-one para empreendedores que querem crescer com inteligência.</p>
      </div>
      <div class="footer__col">
        <div class="footer__col-title">Produto</div>
        <a href="#funcionalidades" class="footer__link">Funcionalidades</a>
        <a href="#orcamento" class="footer__link">Orçamento</a>
        <a href="#" class="footer__link">Integrações</a>
        <a href="#" class="footer__link">Novidades</a>
      </div>
      <div class="footer__col">
        <div class="footer__col-title">Empresa</div>
        <a href="#" class="footer__link">Sobre nós</a>
        <a href="/blog.php" class="footer__link">Blog</a>
        <a href="#" class="footer__link">Carreiras</a>
        <a href="#" class="footer__link">Contato</a>
      </div>
      <div class="footer__col">
        <div class="footer__col-title">Suporte</div>
        <a href="#" class="footer__link">Central de ajuda</a>
        <a href="#" class="footer__link">Status</a>
        <a href="#" class="footer__link">Termos de uso</a>
        <a href="#" class="footer__link">Privacidade</a>
      </div>
    </div>
    <div class="container footer__bottom">
      <span class="footer__copyright">© 2026 Nidex. Todos os direitos reservados.</span>
      <div class="footer__status">
        <span class="footer__status-dot"></span>
        Todos os sistemas operacionais
      </div>
    </div>
  </footer>

  <!-- CONTACT MODAL -->
  <div class="modal-overlay" id="contactModal">
    <div class="modal">
      <button class="modal__close" id="modalClose" aria-label="Fechar">×</button>
      <div class="modal__header">
        <h2 class="modal__title">Comece agora, <span class="text-accent">grátis</span></h2>
        <p class="modal__desc">14 dias grátis · Sem cartão de crédito · Setup em minutos</p>
      </div>
      <form class="modal__form" id="contactForm" novalidate>
        <div class="form-group">
          <label class="form-label" for="cf-name">Nome completo</label>
          <input class="form-input" type="text" id="cf-name" name="name" placeholder="Seu nome" autocomplete="name" />
          <span class="form-error" id="err-name"></span>
        </div>
        <div class="form-group">
          <label class="form-label" for="cf-email">E-mail</label>
          <input class="form-input" type="email" id="cf-email" name="email" placeholder="seu@email.com" autocomplete="email" />
          <span class="form-error" id="err-email"></span>
        </div>
        <div class="form-group">
          <label class="form-label" for="cf-phone">WhatsApp / Telefone</label>
          <input class="form-input" type="tel" id="cf-phone" name="phone" placeholder="(00) 00000-0000" autocomplete="tel" maxlength="15" />
          <span class="form-error" id="err-phone"></span>
        </div>
        <button type="submit" class="btn btn--primary btn--full" id="cf-submit">
          Quero começar grátis
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
        <div class="form-success" id="form-success" style="display:none">
          <span>✓</span> Recebemos seu contato! Falaremos em breve.
        </div>
      </form>
    </div>
  </div>

  <script src="/site/assets/js/main.js"></script>
  <script>
// Modal
const modal = document.getElementById('contactModal');
const modalClose = document.getElementById('modalClose');
document.querySelectorAll('.open-modal').forEach(btn => {
  btn.addEventListener('click', e => { e.preventDefault(); modal.classList.add('active'); document.body.style.overflow='hidden'; });
});
modalClose.addEventListener('click', closeModal);
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
function closeModal() { modal.classList.remove('active'); document.body.style.overflow=''; }

// Phone mask
document.getElementById('cf-phone').addEventListener('input', function() {
  let v = this.value.replace(/\D/g,'');
  if (v.length > 11) v = v.slice(0,11);
  if (v.length > 10) v = v.replace(/(\d{2})(\d{5})(\d{4})/,'($1) $2-$3');
  else if (v.length > 6) v = v.replace(/(\d{2})(\d{4,5})(\d{0,4})/,'($1) $2-$3');
  else if (v.length > 2) v = v.replace(/(\d{2})(\d+)/,'($1) $2');
  else if (v.length > 0) v = v.replace(/(\d+)/,'($1');
  this.value = v;
});

// Form submit
document.getElementById('contactForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const name = document.getElementById('cf-name').value.trim();
  const email = document.getElementById('cf-email').value.trim();
  const phone = document.getElementById('cf-phone').value.trim();
  let valid = true;
  ['name','email','phone'].forEach(f => document.getElementById('err-'+f).textContent='');
  if (name.length < 2) { document.getElementById('err-name').textContent='Nome obrigatório (mín. 2 caracteres)'; valid=false; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { document.getElementById('err-email').textContent='E-mail inválido'; valid=false; }
  if (phone.replace(/\D/g,'').length < 10) { document.getElementById('err-phone').textContent='Telefone inválido'; valid=false; }
  if (!valid) return;
  const btn = document.getElementById('cf-submit');
  btn.disabled = true; btn.textContent = 'Enviando...';
  try {
    const res = await fetch('/api/contato.php', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({name,email,phone}) });
    const data = await res.json();
    if (data.success) {
      document.getElementById('form-success').style.display='flex';
      document.getElementById('contactForm').reset();
    } else { throw new Error(); }
  } catch(err) {
    btn.disabled = false; btn.textContent = 'Quero começar grátis';
    alert('Erro ao enviar. Tente novamente.');
  }
});
  </script>

</body>
</html>
