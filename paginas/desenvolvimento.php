<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desenvolvimento de IA para Empresas — Nidex</title>
  <meta name="description" content="Transformamos o problema do seu negócio em uma solução de IA funcional em tempo recorde. Chatbots, análise preditiva, automação de documentos. MVP em até 2 semanas." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/style.css" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar scrolled" id="navbar">
    <div class="container navbar__inner">
      <a href="/" class="navbar__logo" style="color: var(--primary)">nidex</a>
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

    <!-- HERO BANNER -->
    <section class="service-block service-block--dark">
      <div class="service-block__banner service-block__banner--dark">
        <img src="https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=1400&q=80" alt="Desenvolvimento de IA para Empresas" loading="lazy" />
        <div class="service-block__banner-overlay">
          <div class="container">
            <span class="service-block__banner-tag">⚡ Serviço 02</span>
            <h1 class="service-block__banner-title">Desenvolvimento de IA<br/><span>para Empresas</span></h1>
          </div>
        </div>
      </div>

      <!-- 2-COLUMN CONTENT — REVERSED layout (process LEFT, content RIGHT) -->
      <div class="container service-block__inner service-block__inner--reverse">

        <!-- LEFT: Process card -->
        <div class="reveal">
          <div class="process">
            <div class="process__title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              Processo de desenvolvimento
            </div>
            <div class="process__steps">
              <div class="process__step">
                <div class="process__left">
                  <div class="process__num">1</div>
                  <div class="process__line"></div>
                </div>
                <div class="process__content">
                  <div class="process__step-title">Discovery em 48h</div>
                  <div class="process__step-desc">Uma sessão intensa para entender o problema, mapear dados disponíveis e definir o escopo da solução com clareza.</div>
                </div>
              </div>
              <div class="process__step">
                <div class="process__left">
                  <div class="process__num">2</div>
                  <div class="process__line"></div>
                </div>
                <div class="process__content">
                  <div class="process__step-title">Prototipagem rápida</div>
                  <div class="process__step-desc">Em até 1 semana entregamos um MVP funcional para validar com usuários reais antes de escalar.</div>
                </div>
              </div>
              <div class="process__step">
                <div class="process__left">
                  <div class="process__num">3</div>
                  <div class="process__line"></div>
                </div>
                <div class="process__content">
                  <div class="process__step-title">Iteração com feedback</div>
                  <div class="process__step-desc">Refinamos a solução em sprints curtos de 1 semana, incorporando feedback real da sua equipe e dos dados.</div>
                </div>
              </div>
              <div class="process__step">
                <div class="process__left">
                  <div class="process__num">4</div>
                  <div class="process__line"></div>
                </div>
                <div class="process__content">
                  <div class="process__step-title">Deploy e integração</div>
                  <div class="process__step-desc">Entregamos em produção integrado aos seus sistemas atuais — ERP, CRM, WhatsApp, planilhas ou APIs.</div>
                </div>
              </div>
              <div class="process__step">
                <div class="process__left">
                  <div class="process__num">5</div>
                </div>
                <div class="process__content">
                  <div class="process__step-title">Monitoramento contínuo</div>
                  <div class="process__step-desc">Acompanhamos métricas de uso e performance em tempo real, com ajustes proativos e SLA garantido.</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tech stack box -->
          <div style="margin-top: 16px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 20px;">
            <div style="font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 14px;">Stack de IA que usamos</div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">GPT-4o</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">Claude 3.5</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">Gemini Pro</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">LangChain</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">RAG</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">Vector DB</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">Fine-tuning</span>
              <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-size: 0.8125rem; padding: 6px 12px; border-radius: 8px; font-weight: 500;">n8n</span>
            </div>
          </div>
        </div>

        <!-- RIGHT: Content -->
        <div class="reveal reveal--delay">
          <span class="service-block__tag">⚡ Serviço 02</span>
          <h2 class="service-block__title">
            Desenvolvimento de IA<br />
            <span class="text-accent">para Empresas</span>
          </h2>
          <p class="service-block__desc">
            Transformamos o problema do seu negócio em uma solução de IA funcional em tempo recorde. Não vendemos projetos longos e caros — entregamos valor rápido, com foco no resultado que você precisa agora.
          </p>
          <p class="service-block__desc" style="margin-top: -16px;">
            Desenvolvemos desde chatbots inteligentes e assistentes internos até sistemas de análise preditiva, geração de conteúdo em escala, classificação automática de documentos e muito mais. Tudo integrado ao que você já usa.
          </p>
          <ul class="service-block__benefits">
            <li class="service-block__benefit">
              <span class="service-block__benefit-check">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              Chatbots e assistentes virtuais com contexto do seu negócio
            </li>
            <li class="service-block__benefit">
              <span class="service-block__benefit-check">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              Análise preditiva: churn, demanda, precificação dinâmica
            </li>
            <li class="service-block__benefit">
              <span class="service-block__benefit-check">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              Processamento inteligente de documentos e contratos
            </li>
            <li class="service-block__benefit">
              <span class="service-block__benefit-check">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              Geração de conteúdo e relatórios automatizados
            </li>
            <li class="service-block__benefit">
              <span class="service-block__benefit-check">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              MVP entregue em até 2 semanas
            </li>
          </ul>
          <div class="service-block__cta">
            <a href="#" class="btn btn--primary">Falar com especialista</a>
            <a href="#" class="btn btn--ghost">Ver cases</a>
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
          Pronto para construir sua<br />
          <span class="text-accent">solução de IA?</span>
        </h2>
        <p class="cta-section__desc">
          Fale com nossos especialistas e descubra como transformar o seu problema em uma solução de IA funcional em tempo recorde.
        </p>
        <div class="cta-section__btns">
          <a href="#" class="btn btn--primary btn--lg">
            Falar com especialista
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="/servicos" class="btn btn--ghost btn--lg">
            Ver todos os serviços
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
        <div class="footer__logo">nidex</div>
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
