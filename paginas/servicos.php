<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Serviços — Nidex IA para Empresas</title>
  <meta name="description" content="Treinamento em IA, desenvolvimento de soluções customizadas e consultoria estratégica para empresas que querem crescer com inteligência artificial." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/style.css" />
  <style>
    /* Services Overview Cards */
    .services-overview {
      background: #F8FAFC;
      padding: 80px 0 100px;
    }
    .services-overview__header {
      text-align: center;
      margin-bottom: 56px;
    }
    .services-overview__grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
    }
    .svc-card {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 20px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: box-shadow 0.25s ease, transform 0.25s ease;
    }
    .svc-card:hover {
      box-shadow: 0 12px 40px rgba(0,0,0,0.1);
      transform: translateY(-4px);
    }
    .svc-card__img {
      position: relative;
      height: 200px;
      overflow: hidden;
    }
    .svc-card__img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.4s ease;
    }
    .svc-card:hover .svc-card__img img {
      transform: scale(1.04);
    }
    .svc-card__img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, transparent 40%, rgba(15,23,42,0.55));
    }
    .svc-card__body {
      padding: 28px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .svc-card__badge {
      display: inline-block;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--primary);
      background: #EFF6FF;
      padding: 4px 10px;
      border-radius: 6px;
      margin-bottom: 14px;
      letter-spacing: 0.02em;
    }
    .svc-card__title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #0F172A;
      line-height: 1.3;
      margin-bottom: 12px;
    }
    .svc-card__desc {
      font-size: 0.9375rem;
      color: #64748B;
      line-height: 1.65;
      margin-bottom: 20px;
      flex: 1;
    }
    .svc-card__tags {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 24px;
    }
    .svc-card__tags span {
      font-size: 0.75rem;
      font-weight: 500;
      color: #475569;
      background: #F1F5F9;
      padding: 4px 10px;
      border-radius: 6px;
      border: 1px solid #E2E8F0;
    }
    .svc-card__link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--primary);
      text-decoration: none;
      transition: gap 0.2s ease;
    }
    .svc-card__link:hover {
      gap: 10px;
    }
    @media (max-width: 1024px) {
      .services-overview__grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 640px) {
      .services-overview__grid {
        grid-template-columns: 1fr;
      }
      .services-overview {
        padding: 60px 0 80px;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar scrolled" id="navbar">
    <div class="container navbar__inner">
      <a href="/" class="navbar__logo"><img src="/uploads/logo-nidex-cor.svg" alt="nidex" /></a>
      <nav class="navbar__links" id="navLinks">
        <a href="/#funcionalidades">Funcionalidades</a>
        <a href="/#como-funciona">Como funciona</a>
        <button class="mega-trigger" id="megaTrigger" aria-expanded="false" aria-controls="megaMenu" style="color: var(--primary); font-weight: 600;">
          Serviços
          <svg class="mega-trigger__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <a href="/#depoimentos">Depoimentos</a>
        <a href="/#precos">Preços</a>
      </nav>
      <div class="navbar__actions">
        <a href="#" class="navbar__login">Entrar</a>
        <a href="#" class="btn btn--primary">Começar grátis</a>
      </div>
      <button class="navbar__toggle" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>

    <!-- MEGA MENU -->
    <div class="mega-menu" id="megaMenu" role="region" aria-label="Serviços">
      <div class="mega-menu__inner container">
        <a href="/treinamento" class="mega-card">
          <div class="mega-card__img">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80" alt="Treinamento em IA" loading="lazy" />
            <div class="mega-card__img-overlay"></div>
            <span class="mega-card__badge">🎓 Serviço 01</span>
          </div>
          <div class="mega-card__body">
            <h3 class="mega-card__title">Treinamento em IA para Empresas</h3>
            <p class="mega-card__desc">Capacite sua equipe para usar IA no dia a dia — vendas, marketing, operações e gestão.</p>
            <div class="mega-card__tags"><span>Workshops práticos</span><span>Trilha personalizada</span><span>Certificação</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
          </div>
        </a>
        <a href="/desenvolvimento" class="mega-card">
          <div class="mega-card__img">
            <img src="https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=600&q=80" alt="Desenvolvimento com IA" loading="lazy" />
            <div class="mega-card__img-overlay"></div>
            <span class="mega-card__badge">⚡ Serviço 02</span>
          </div>
          <div class="mega-card__body">
            <h3 class="mega-card__title">Desenvolvimento de IA para Empresas</h3>
            <p class="mega-card__desc">Transformamos seu problema em uma solução de IA funcional. MVP em até 2 semanas.</p>
            <div class="mega-card__tags"><span>Chatbots</span><span>Análise preditiva</span><span>Automação</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
          </div>
        </a>
        <a href="/consultoria" class="mega-card">
          <div class="mega-card__img">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&q=80" alt="Consultoria em IA" loading="lazy" />
            <div class="mega-card__img-overlay"></div>
            <span class="mega-card__badge">💡 Serviço 03</span>
          </div>
          <div class="mega-card__body">
            <h3 class="mega-card__title">Consultoria em IA para Empresas</h3>
            <p class="mega-card__desc">Estratégia personalizada para adotar IA. Do diagnóstico ao roadmap executável com ROI claro.</p>
            <div class="mega-card__tags"><span>Diagnóstico</span><span>Roadmap de IA</span><span>ROI garantido</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
          </div>
        </a>
      </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
      <a href="/#funcionalidades" class="mobile-menu__link">Funcionalidades</a>
      <a href="/#como-funciona" class="mobile-menu__link">Como funciona</a>
      <a href="/servicos" class="mobile-menu__link">Serviços</a>
      <a href="/treinamento" class="mobile-menu__link mobile-menu__link--sub">↳ Treinamento em IA</a>
      <a href="/desenvolvimento" class="mobile-menu__link mobile-menu__link--sub">↳ Desenvolvimento com IA</a>
      <a href="/consultoria" class="mobile-menu__link mobile-menu__link--sub">↳ Consultoria em IA</a>
      <a href="/#depoimentos" class="mobile-menu__link">Depoimentos</a>
      <a href="/#precos" class="mobile-menu__link">Preços</a>
      <div class="mobile-menu__actions">
        <a href="#" class="mobile-menu__login">Entrar</a>
        <a href="#" class="btn btn--primary">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>

    <!-- HERO SECTION (dark) -->
    <section class="services-hero">
      <div class="services-hero__grid"></div>
      <div class="services-hero__glow"></div>
      <div class="container services-hero__inner reveal">
        <span class="services-hero__label">Nossos Serviços</span>
        <h1 class="services-hero__title">
          IA que <span class="text-accent">transforma</span><br />negócios de verdade
        </h1>
        <p class="services-hero__desc">
          Da capacitação da equipe ao desenvolvimento de soluções personalizadas — entregamos inteligência artificial aplicada ao seu negócio, com resultado rápido e sem complexidade.
        </p>
      </div>
    </section>

    <!-- 3 SERVICE CARDS (light bg) -->
    <section class="services-overview">
      <div class="container">
        <div class="services-overview__header reveal">
          <span class="section-label">O que fazemos</span>
          <h2 class="section-title" style="margin-top: 12px;">
            Escolha o serviço certo<br />
            <span class="text-primary">para o seu momento</span>
          </h2>
          <p class="section-desc" style="max-width: 560px; margin: 16px auto 0;">
            Cada empresa está em um estágio diferente com IA. Conheça nossos três serviços e descubra qual se encaixa melhor na sua realidade.
          </p>
        </div>

        <div class="services-overview__grid">

          <!-- Card 01 — Treinamento -->
          <div class="svc-card reveal">
            <div class="svc-card__img">
              <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80" alt="Treinamento em IA para Empresas" loading="lazy" />
              <div class="svc-card__img-overlay"></div>
            </div>
            <div class="svc-card__body">
              <span class="svc-card__badge">🎓 Serviço 01</span>
              <h3 class="svc-card__title">Treinamento em IA para Empresas</h3>
              <p class="svc-card__desc">Capacite sua equipe para usar IA no dia a dia — sem precisar ser técnico. Trilhas personalizadas por área com workshops práticos e casos reais do seu setor.</p>
              <div class="svc-card__tags">
                <span>Workshops práticos</span>
                <span>Trilha personalizada</span>
                <span>Certificação</span>
              </div>
              <a href="/treinamento" class="svc-card__link">
                Conhecer serviço
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>

          <!-- Card 02 — Desenvolvimento -->
          <div class="svc-card reveal reveal--delay">
            <div class="svc-card__img">
              <img src="https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=800&q=80" alt="Desenvolvimento de IA para Empresas" loading="lazy" />
              <div class="svc-card__img-overlay"></div>
            </div>
            <div class="svc-card__body">
              <span class="svc-card__badge">⚡ Serviço 02</span>
              <h3 class="svc-card__title">Desenvolvimento de IA para Empresas</h3>
              <p class="svc-card__desc">Transformamos seu problema em uma solução de IA funcional em tempo recorde. Chatbots, análise preditiva, automação de documentos e mais. MVP em até 2 semanas.</p>
              <div class="svc-card__tags">
                <span>Chatbots</span>
                <span>Análise preditiva</span>
                <span>Automação</span>
              </div>
              <a href="/desenvolvimento" class="svc-card__link">
                Conhecer serviço
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>

          <!-- Card 03 — Consultoria -->
          <div class="svc-card reveal reveal--delay">
            <div class="svc-card__img">
              <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&q=80" alt="Consultoria em IA para Empresas" loading="lazy" />
              <div class="svc-card__img-overlay"></div>
            </div>
            <div class="svc-card__body">
              <span class="svc-card__badge">💡 Serviço 03</span>
              <h3 class="svc-card__title">Consultoria em IA para Empresas</h3>
              <p class="svc-card__desc">Estratégia personalizada para adotar IA. Do diagnóstico completo ao roadmap executável com ROI claro — sem conflito de interesse e com suporte à execução.</p>
              <div class="svc-card__tags">
                <span>Diagnóstico</span>
                <span>Roadmap de IA</span>
                <span>ROI garantido</span>
              </div>
              <a href="/consultoria" class="svc-card__link">
                Conhecer serviço
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
      <div class="cta-section__bg-grid"></div>
      <div class="cta-section__glow"></div>
      <div class="container cta-section__inner reveal">
        <h2 class="cta-section__title">
          Pronto para levar IA ao<br />
          <span class="text-accent">seu negócio?</span>
        </h2>
        <p class="cta-section__desc">
          Fale com um especialista Nidex e descubra qual serviço faz mais sentido para o seu momento. Diagnóstico gratuito, sem compromisso.
        </p>
        <div class="cta-section__btns">
          <a href="#" class="btn btn--primary btn--lg">
            Agendar diagnóstico gratuito
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="/" class="btn btn--ghost btn--lg">
            Conhecer a plataforma
          </a>
        </div>
        <p class="cta-section__note">Sem compromisso · Resposta em até 24h · 100% gratuito</p>
      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <div class="footer__logo"><img src="/uploads/logo-nidex-white.svg" alt="nidex" /></div>
        <p class="footer__desc">O ecossistema all-in-one para empreendedores que querem crescer com inteligência.</p>
      </div>
      <div class="footer__col">
        <div class="footer__col-title">Serviços</div>
        <a href="/treinamento" class="footer__link">Treinamento em IA</a>
        <a href="/desenvolvimento" class="footer__link">Desenvolvimento com IA</a>
        <a href="/consultoria" class="footer__link">Consultoria em IA</a>
      </div>
      <div class="footer__col">
        <div class="footer__col-title">Empresa</div>
        <a href="#" class="footer__link">Sobre nós</a>
        <a href="#" class="footer__link">Blog</a>
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

  <script src="/script.js"></script>
</body>
</html>
