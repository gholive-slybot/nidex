<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="/" class="navbar__logo"><img src="/site/uploads/logo-black.svg" alt="nidex" /></a>

      <nav class="navbar__links" id="navLinks">

        <!-- Nidex.Suite dropdown -->
        <div class="nav-dropdown" id="dropSuite">
          <button class="nav-dropdown__trigger" aria-expanded="false" aria-controls="menuSuite">
            Nidex.Suite
            <svg class="nav-dropdown__chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="nav-dropdown__menu" id="menuSuite" role="menu">
            <a href="/#hero" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
              </div>
              <div>
                <strong>O que é</strong>
                <span>Conheça o ecossistema Nidex</span>
              </div>
            </a>
            <a href="/#modulos" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              </div>
              <div>
                <strong>Módulos</strong>
                <span>CRM, financeiro, tarefas e mais</span>
              </div>
            </a>
            <a href="/#ia" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--accent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
              </div>
              <div>
                <strong>IA Embarcada</strong>
                <span>Inteligência artificial no core</span>
              </div>
            </a>
          </div>
        </div>

        <!-- Nidex.Run dropdown -->
        <div class="nav-dropdown" id="dropRun">
          <button class="nav-dropdown__trigger" aria-expanded="false" aria-controls="menuRun">
            Nidex.Run
            <svg class="nav-dropdown__chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="nav-dropdown__menu" id="menuRun" role="menu">
            <a href="/run#academy" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
              </div>
              <div>
                <strong>Nidex.Academy</strong>
                <span>Treinamento in company e online</span>
              </div>
            </a>
            <a href="/run#projects" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--accent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
              </div>
              <div>
                <strong>Nidex.Projects</strong>
                <span>Sites, apps e softwares com IA</span>
              </div>
            </a>
            <a href="/run#cowork" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--blue">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
              </div>
              <div>
                <strong>Nidex.Cowork</strong>
                <span>IA integrada ao seu software atual</span>
              </div>
            </a>
            <a href="/run#consulting" class="nav-dropdown__item" role="menuitem">
              <div class="nav-dropdown__icon nav-dropdown__icon--gold">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              </div>
              <div>
                <strong>Nidex.Consulting</strong>
                <span>Consultoria premium de alto impacto</span>
              </div>
            </a>
          </div>
        </div>

        <a href="#contato" class="navbar__link-plain">Contato</a>

      </nav>

      <div class="navbar__actions">
        <a href="#" class="navbar__login">Entrar</a>
        <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      </div>
      <button class="navbar__toggle" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
      <div class="mobile-menu__group">
        <span class="mobile-menu__group-label">Nidex.Suite</span>
        <a href="/#hero" class="mobile-menu__link">O que é</a>
        <a href="/#modulos" class="mobile-menu__link">Módulos</a>
        <a href="/#ia" class="mobile-menu__link">IA Embarcada</a>
      </div>
      <div class="mobile-menu__group">
        <span class="mobile-menu__group-label">Nidex.Run</span>
        <a href="/run#academy" class="mobile-menu__link">Academy</a>
        <a href="/run#projects" class="mobile-menu__link">Projects</a>
        <a href="/run#cowork" class="mobile-menu__link">Cowork</a>
        <a href="/run#consulting" class="mobile-menu__link">Consulting</a>
      </div>
      <a href="#contato" class="mobile-menu__link mobile-menu__link--solo">Contato</a>
      <div class="mobile-menu__actions">
        <a href="#" class="mobile-menu__login">Entrar</a>
        <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>
