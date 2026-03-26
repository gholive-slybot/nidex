<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Garantia Estendida NHS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --navy:        #152342;
      --navy-mid:    #1C2D56;
      --yellow:      #F5B200;
      --yellow-dark: #D9A000;
      --light:       #F4F6F9;
      --white:       #FFFFFF;
      --border:      #E0E6EE;
      --text:        #111827;
      --muted:       #5A6A7E;
      --radius:      8px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', sans-serif;
      color: var(--text);
      background: var(--white);
      line-height: 1.6;
    }

    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }
    img { display: block; max-width: 100%; }

    .container {
      max-width: 1160px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* ── NAVBAR ─────────────────────────────── */
    .nhs-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      background: var(--white);
      border-bottom: 3px solid var(--yellow);
      box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .nhs-nav__inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 68px;
    }
    .nhs-logo {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .nhs-logo__icon {
      width: 36px;
      height: 36px;
      background: var(--navy);
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .nhs-logo__icon svg { display: block; }
    .nhs-logo__text {
      font-size: 1.4rem;
      font-weight: 800;
      color: var(--navy);
      letter-spacing: -0.02em;
    }
    .nhs-nav__links {
      display: flex;
      gap: 36px;
    }
    .nhs-nav__links a {
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--navy);
      letter-spacing: 0.04em;
      text-transform: uppercase;
      transition: color 0.2s;
    }
    .nhs-nav__links a:hover { color: var(--yellow-dark); }
    .btn-yellow {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--yellow);
      color: var(--navy);
      font-size: 0.875rem;
      font-weight: 700;
      padding: 10px 22px;
      border-radius: var(--radius);
      border: none;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-yellow:hover { background: var(--yellow-dark); transform: translateY(-1px); }
    .btn-navy {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--navy);
      color: var(--white);
      font-size: 0.875rem;
      font-weight: 700;
      padding: 12px 28px;
      border-radius: var(--radius);
      border: none;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-navy:hover { background: var(--navy-mid); transform: translateY(-1px); }

    /* ── HERO ────────────────────────────────── */
    .hero {
      background: var(--navy);
      padding: 88px 0 72px;
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 60% 80% at 70% 50%, rgba(245,178,0,0.06) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero__inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 48px;
      align-items: center;
    }
    .hero__badge {
      display: inline-block;
      background: var(--yellow);
      color: var(--navy);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 4px 12px;
      border-radius: 20px;
      margin-bottom: 20px;
    }
    .hero__title {
      font-size: 2.75rem;
      font-weight: 800;
      color: var(--white);
      line-height: 1.15;
      margin-bottom: 16px;
    }
    .hero__title span { color: var(--yellow); }
    .hero__subtitle {
      font-size: 1.125rem;
      color: rgba(255,255,255,0.72);
      margin-bottom: 36px;
      line-height: 1.65;
    }
    .hero__disclaimer {
      font-size: 0.7rem;
      color: rgba(255,255,255,0.4);
      margin-top: 24px;
      line-height: 1.5;
    }
    .hero__images {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0;
      position: relative;
    }
    .hero__product-stack {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
      padding: 32px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 16px;
      width: 100%;
    }
    .hero__product-item {
      width: 100%;
      max-width: 280px;
      height: 64px;
      background: rgba(255,255,255,0.06);
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero__product-item span {
      font-size: 0.7rem;
      color: rgba(255,255,255,0.35);
      font-weight: 500;
      letter-spacing: 0.05em;
    }

    /* ── SECTION COMMONS ─────────────────────── */
    .section { padding: 80px 0; }
    .section--light { background: var(--light); }
    .section--navy { background: var(--navy); }
    .section--white { background: var(--white); }
    .pill-label {
      display: inline-block;
      background: var(--yellow);
      color: var(--navy);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 4px 14px;
      border-radius: 20px;
      margin-bottom: 16px;
    }
    .pill-label--white {
      background: rgba(255,255,255,0.12);
      color: var(--yellow);
    }
    .section-title {
      font-size: 2rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 16px;
    }
    .section-title--white { color: var(--white); }
    .section-desc {
      font-size: 1rem;
      color: var(--muted);
      line-height: 1.7;
    }
    .section-desc--white { color: rgba(255,255,255,0.65); }

    /* ── O QUE É ─────────────────────────────── */
    .oque-e__inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
      align-items: center;
    }
    .oque-e__img-wrap {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .img-placeholder {
      width: 100%;
      border-radius: 12px;
      background: var(--light);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--muted);
      font-size: 0.8rem;
      font-weight: 500;
    }
    .img-placeholder--tall { height: 260px; }
    .img-placeholder--short { height: 120px; }
    .oque-e__content .section-desc { margin-top: 16px; }

    /* ── COMO FUNCIONA ───────────────────────── */
    .como-funciona__inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 56px;
    }
    .checklist-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 18px;
    }
    .checklist {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 24px;
    }
    .checklist li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.925rem;
      color: var(--text);
      line-height: 1.5;
    }
    .checklist li::before {
      content: '';
      flex-shrink: 0;
      margin-top: 4px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: var(--yellow);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='8' viewBox='0 0 10 8'%3E%3Cpath d='M1 4l2.5 2.5L9 1' stroke='%23152342' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
    }
    .como-funciona__cta {
      text-align: center;
      margin-top: 40px;
    }

    /* ── O QUE MUDA ──────────────────────────── */
    .oque-muda__header {
      text-align: center;
      margin-bottom: 48px;
    }
    .oque-muda__grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }
    .muda-card {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px;
      padding: 28px 28px 32px;
    }
    .muda-card__num {
      width: 36px;
      height: 36px;
      background: var(--yellow);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 16px;
    }
    .muda-card__title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--white);
      line-height: 1.3;
    }

    /* ── SIMPLES DE CONTRATAR ────────────────── */
    .simples__inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px;
      align-items: start;
    }
    .simples__content .section-desc { margin-bottom: 28px; }
    .option-box {
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 20px 24px;
      margin-bottom: 16px;
    }
    .option-box:last-child { margin-bottom: 0; }
    .option-tag {
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--yellow-dark);
      background: #FFF8E0;
      padding: 3px 10px;
      border-radius: 20px;
      display: inline-block;
      margin-bottom: 10px;
    }
    .option-box__title {
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 8px;
    }
    .option-box__text {
      font-size: 0.875rem;
      color: var(--muted);
      line-height: 1.6;
    }

    /* ── QUEM PODE ───────────────────────────── */
    .quem-pode__header {
      text-align: center;
      margin-bottom: 40px;
    }
    .quem-pode__cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      max-width: 760px;
      margin: 0 auto;
    }
    .quem-pode__list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 0.925rem;
      color: rgba(255,255,255,0.85);
      line-height: 1.5;
      margin-bottom: 14px;
    }
    .quem-pode__list li::before {
      content: '';
      flex-shrink: 0;
      margin-top: 3px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--yellow);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='8' viewBox='0 0 10 8'%3E%3Cpath d='M1 4l2.5 2.5L9 1' stroke='%23152342' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
    }
    .quem-pode__list--muted li { color: rgba(255,255,255,0.5); }
    .quem-pode__list--muted li::before { background-color: rgba(255,255,255,0.25); }

    /* ── PLANOS ──────────────────────────────── */
    .planos__header {
      text-align: center;
      margin-bottom: 12px;
    }
    .planos__subtitle {
      text-align: center;
      font-size: 0.95rem;
      color: var(--muted);
      margin-bottom: 48px;
    }
    .planos__grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      align-items: start;
    }
    .plano-card {
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 28px 24px 32px;
      background: var(--white);
      position: relative;
    }
    .plano-card--highlight {
      background: var(--navy);
      border-color: var(--navy);
      box-shadow: 0 16px 48px rgba(21,35,66,0.22);
    }
    .plano-card__badge {
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--navy);
      background: var(--yellow);
      padding: 3px 10px;
      border-radius: 20px;
      display: inline-block;
      margin-bottom: 14px;
    }
    .plano-card--highlight .plano-card__badge {
      color: var(--navy);
    }
    .plano-card__name {
      font-size: 1.25rem;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 4px;
    }
    .plano-card--highlight .plano-card__name { color: var(--white); }
    .plano-card__years {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--yellow);
      margin-bottom: 20px;
    }
    .plano-card__divider {
      height: 1px;
      background: var(--border);
      margin-bottom: 20px;
    }
    .plano-card--highlight .plano-card__divider {
      background: rgba(255,255,255,0.12);
    }
    .plano-card__features {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 20px;
    }
    .plano-card__features li {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      font-size: 0.875rem;
      color: var(--text);
      line-height: 1.45;
    }
    .plano-card--highlight .plano-card__features li { color: rgba(255,255,255,0.8); }
    .plano-card__features li::before {
      content: '';
      flex-shrink: 0;
      margin-top: 3px;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background: var(--yellow);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='9' height='7' viewBox='0 0 9 7'%3E%3Cpath d='M1 3.5l2 2L8 1' stroke='%23152342' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center;
    }
    .plano-card__total {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--muted);
      line-height: 1.5;
    }
    .plano-card--highlight .plano-card__total { color: rgba(255,255,255,0.55); }
    .plano-card__total strong { color: var(--navy); }
    .plano-card--highlight .plano-card__total strong { color: var(--yellow); }

    /* ── FORM / SOLICITAÇÃO ──────────────────── */
    .form-section__inner {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 64px;
      align-items: start;
    }
    .form-section__info .section-desc { margin-bottom: 24px; }
    .alert-box {
      background: #FFF8E0;
      border: 1px solid #F5C842;
      border-left: 4px solid var(--yellow);
      border-radius: 8px;
      padding: 14px 16px;
    }
    .alert-box__title {
      font-size: 0.8rem;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .alert-box__text {
      font-size: 0.8rem;
      color: #6B5000;
      line-height: 1.55;
    }
    .form-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 32px 28px;
    }
    .form-group-title {
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--navy);
      border-bottom: 1px solid var(--border);
      padding-bottom: 10px;
      margin-bottom: 20px;
      margin-top: 28px;
    }
    .form-group-title:first-child { margin-top: 0; }
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .form-field {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 16px;
    }
    .form-field--full { grid-column: 1 / -1; }
    .form-field label {
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--navy);
    }
    .form-field input,
    .form-field select,
    .form-field textarea {
      padding: 10px 14px;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 0.875rem;
      font-family: inherit;
      color: var(--text);
      background: var(--white);
      transition: border-color 0.2s;
      outline: none;
    }
    .form-field input:focus,
    .form-field select:focus { border-color: var(--navy); }
    .form-field input::placeholder { color: #B0B8C4; }
    .file-upload {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border: 1px dashed #B0B8C4;
      border-radius: 6px;
      cursor: pointer;
      background: var(--light);
      transition: border-color 0.2s;
    }
    .file-upload:hover { border-color: var(--navy); }
    .file-upload span {
      font-size: 0.875rem;
      color: var(--muted);
    }
    .file-upload__icon {
      width: 20px;
      height: 20px;
      color: var(--muted);
    }
    .btn-submit {
      width: 100%;
      padding: 14px;
      background: var(--navy);
      color: var(--white);
      border: none;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      margin-top: 8px;
      transition: background 0.2s;
    }
    .btn-submit:hover { background: var(--navy-mid); }

    /* ── FOOTER ──────────────────────────────── */
    .nhs-footer {
      background: var(--navy);
      padding: 40px 0;
      border-top: 3px solid var(--yellow);
    }
    .nhs-footer__inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
    }
    .nhs-footer__phone {
      font-size: 0.925rem;
      font-weight: 600;
      color: rgba(255,255,255,0.7);
    }
    .nhs-footer__phone span { color: var(--yellow); font-weight: 700; }
    .nhs-footer__social {
      display: flex;
      gap: 14px;
    }
    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(255,255,255,0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }
    .social-icon:hover { background: rgba(255,255,255,0.16); }
    .social-icon svg { color: rgba(255,255,255,0.7); }
    .nhs-footer__copy {
      text-align: center;
      font-size: 0.75rem;
      color: rgba(255,255,255,0.3);
      margin-top: 24px;
      padding-top: 20px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }

    /* ── RESPONSIVO ──────────────────────────── */
    @media (max-width: 900px) {
      .hero__inner,
      .oque-e__inner,
      .como-funciona__inner,
      .simples__inner,
      .quem-pode__cols,
      .form-section__inner { grid-template-columns: 1fr; gap: 40px; }
      .oque-muda__grid { grid-template-columns: 1fr; }
      .planos__grid { grid-template-columns: 1fr; max-width: 420px; margin: 0 auto; }
      .nhs-nav__links { display: none; }
      .hero__title { font-size: 2rem; }
      .nhs-footer__inner { flex-direction: column; text-align: center; }
      .form-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="nhs-nav">
    <div class="container nhs-nav__inner">
      <a href="#" class="nhs-logo">
        <div class="nhs-logo__icon">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M10 2L13 8H17L13.5 12L15 18L10 15L5 18L6.5 12L3 8H7L10 2Z" fill="#F5B200"/>
          </svg>
        </div>
        <span class="nhs-logo__text">NHS</span>
      </a>
      <ul class="nhs-nav__links">
        <li><a href="#">Home</a></li>
        <li><a href="#garantia">Garantia</a></li>
        <li><a href="#planos">Planos</a></li>
      </ul>
      <a href="#solicitar" class="btn-yellow">
        Contratar Agora
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
      </a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="container hero__inner">
      <div class="hero__content">
        <span class="hero__badge">Garantia</span>
        <h1 class="hero__title">Garantia<br />Estendida <span>NHS.</span></h1>
        <p class="hero__subtitle">Seu nobreak protegido<br />por muito mais tempo.</p>
        <a href="#solicitar" class="btn-yellow">
          Quero contratar
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
        </a>
        <p class="hero__disclaimer">* Anexe a nota fiscal do produto para validar a data de compra e confirmar a elegibilidade.</p>
      </div>
      <div class="hero__images">
        <div class="hero__product-stack">
          <div class="hero__product-item"><span>NHS Nobreak Premium</span></div>
          <div class="hero__product-item"><span>NHS Nobreak Senoidal</span></div>
          <div class="hero__product-item"><span>NHS Nobreak Compact</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- O QUE É A GARANTIA -->
  <section id="garantia" class="section section--white">
    <div class="container oque-e__inner">
      <div class="oque-e__img-wrap">
        <div class="img-placeholder img-placeholder--tall">
          [Imagem do produto NHS]
        </div>
      </div>
      <div class="oque-e__content">
        <span class="pill-label">O que é a Garantia</span>
        <h2 class="section-title">Mais cobertura.<br />Mesmo padrão.</h2>
        <p class="section-desc">
          A Garantia Estendida NHS amplia a proteção do seu equipamento além do prazo de fábrica, com as mesmas condições de atendimento, mesmas redes técnicas e as mesmas peças originais.
        </p>
      </div>
    </div>
  </section>

  <!-- COMO FUNCIONA -->
  <section class="section section--light">
    <div class="container">
      <div class="como-funciona__inner">
        <div>
          <p class="checklist-title">Como funciona a extensão:</p>
          <ul class="checklist">
            <li>Garantia de fábrica: cobertura padrão do produto</li>
            <li>+ 1 ano adicional de extensão</li>
            <li>+ 2 anos adicionais de extensão</li>
            <li>+ 3 anos adicionais de extensão</li>
            <li><strong>Total: 4/5/6 anos de cobertura contratada</strong></li>
          </ul>
        </div>
        <div>
          <p class="checklist-title">O que não muda:</p>
          <ul class="checklist">
            <li>Mesmos benefícios da garantia original</li>
            <li>Rede de assistência técnica habilitada NHS</li>
            <li>Atendimento com peças originais</li>
            <li>Critérios idênticos de cobertura</li>
          </ul>
        </div>
      </div>
      <div class="como-funciona__cta">
        <a href="#solicitar" class="btn-navy">
          Contratar agora
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
        </a>
      </div>
    </div>
  </section>

  <!-- O QUE MUDA -->
  <section class="section section--navy">
    <div class="container">
      <div class="oque-muda__header">
        <span class="pill-label pill-label--white">Estender faz diferença</span>
        <h2 class="section-title section-title--white">O que muda quando<br />você estende a proteção.</h2>
      </div>
      <div class="oque-muda__grid">
        <div class="muda-card">
          <div class="muda-card__num">1</div>
          <p class="muda-card__title">Previsibilidade<br />para o orçamento</p>
        </div>
        <div class="muda-card">
          <div class="muda-card__num">2</div>
          <p class="muda-card__title">Continuidade<br />operacional garantida</p>
        </div>
        <div class="muda-card">
          <div class="muda-card__num">3</div>
          <p class="muda-card__title">Suporte técnico<br />direto com a fábrica</p>
        </div>
        <div class="muda-card">
          <div class="muda-card__num">4</div>
          <p class="muda-card__title">Retorno real<br />sobre o investimento</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SIMPLES DE CONTRATAR -->
  <section class="section section--white">
    <div class="container simples__inner">
      <div class="simples__content">
        <span class="pill-label">Como contratar</span>
        <h2 class="section-title">Simples de contratar.<br />Rápido de ativar.</h2>
        <p class="section-desc">A Garantia Estendida pode ser solicitada no momento da compra ou em até 90 dias após a aquisição do produto.</p>
        <br />
        <a href="#solicitar" class="btn-navy">
          Contratar agora
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
        </a>
      </div>
      <div class="simples__options">
        <div class="option-box">
          <span class="option-tag">Opção 1</span>
          <p class="option-box__title">No momento da compra:</p>
          <p class="option-box__text">Contrate a Garantia Estendida junto com a aquisição do nobreak. O processo é integrado e a cobertura entra em vigor imediatamente, a partir da data da garantia de fábrica.</p>
        </div>
        <div class="option-box">
          <span class="option-tag">Opção 2</span>
          <p class="option-box__title">No momento da compra:</p>
          <p class="option-box__text">Perdeu o momento? Ainda dá tempo. Você pode solicitar a garantia estendida dentro de 90 dias a partir da data de compra do produto, mediante apresentação da nota fiscal.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- QUEM PODE CONTRATAR -->
  <section class="section section--navy">
    <div class="container">
      <div class="quem-pode__header">
        <span class="pill-label pill-label--white">Quem pode contratar:</span>
      </div>
      <div class="quem-pode__cols">
        <ul class="quem-pode__list">
          <li>CPF ou CNPJ, sem restrição de perfil do cliente</li>
          <li>Revendas, distribuidoras e usuários finais</li>
        </ul>
        <ul class="quem-pode__list quem-pode__list--muted">
          <li>Válido para nobreaks NHS, exceto linha NHIS</li>
          <li>Baterias não estão contempladas neste serviço</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- PLANOS -->
  <section id="planos" class="section section--white">
    <div class="container">
      <div class="planos__header">
        <span class="pill-label">Planos</span>
        <h2 class="section-title">Escolha o prazo certo para você.</h2>
      </div>
      <p class="planos__subtitle">Três opções de extensão, todas com as mesmas critérios de atendimento, rede técnica habilitada e peças originais.</p>
      <div class="planos__grid">

        <!-- Básico -->
        <div class="plano-card">
          <span class="plano-card__badge">+ 1 ANO</span>
          <h3 class="plano-card__name">Básico</h3>
          <p class="plano-card__years">1 ano adicional</p>
          <div class="plano-card__divider"></div>
          <ul class="plano-card__features">
            <li>1 ano adicional de extensão</li>
            <li>Garantia de fábrica cobertura padrão</li>
          </ul>
          <p class="plano-card__total">
            Total de cobertura:<br />
            <strong>Depende do produto — amplia a proteção da garantia de fábrica</strong>
          </p>
        </div>

        <!-- Intermediário (highlight) -->
        <div class="plano-card plano-card--highlight">
          <span class="plano-card__badge">+ 2 ANOS</span>
          <h3 class="plano-card__name">Intermediário</h3>
          <p class="plano-card__years">2 anos adicionais</p>
          <div class="plano-card__divider"></div>
          <ul class="plano-card__features">
            <li>2 anos adicionais de extensão e proteção</li>
            <li>Total de cobertura significativamente ampliada</li>
            <li>Atendimento sem custo e proteção</li>
          </ul>
          <p class="plano-card__total">
            Total de cobertura:<br />
            <strong>Maior proteção sem comprometer o orçamento</strong>
          </p>
        </div>

        <!-- Completo -->
        <div class="plano-card">
          <span class="plano-card__badge">+ 3 ANOS</span>
          <h3 class="plano-card__name">Completo</h3>
          <p class="plano-card__years">3 anos adicionais</p>
          <div class="plano-card__divider"></div>
          <ul class="plano-card__features">
            <li>3 anos adicionais</li>
            <li>Máxima previsibilidade</li>
            <li>Total de cobertura que o equipamento pode ter para a maior proteção possível</li>
          </ul>
          <p class="plano-card__total">
            Total de cobertura:<br />
            <strong>Máxima proteção disponível</strong>
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- PRONTO PARA CONTRATAR / FORM -->
  <section id="solicitar" class="section section--light">
    <div class="container form-section__inner">

      <!-- Info -->
      <div class="form-section__info">
        <span class="pill-label">Solicitação</span>
        <h2 class="section-title">Pronto<br />para contratar?</h2>
        <p class="section-desc">
          Preencha o formulário com os dados do cliente e do equipamento. Nossa equipe entrará em contato para confirmar a contratação e enviar as informações do plano.
        </p>
        <div class="alert-box">
          <p class="alert-box__title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Atenção
          </p>
          <p class="alert-box__text">
            Tenha em mãos a nota fiscal do equipamento. Todos os dados informados no formulário devem corresponder exatamente ao que consta na nota fiscal. A nossa equipe analisará e confirmará a data de compra do produto, mediante apresentação da nota fiscal, e verificará se é elegível.
          </p>
        </div>
      </div>

      <!-- Form -->
      <div class="form-card">
        <form action="#" method="POST" enctype="multipart/form-data">

          <p class="form-group-title">Dados do cliente</p>
          <div class="form-row">
            <div class="form-field form-field--full">
              <label>CPF/CNPJ</label>
              <input type="text" name="cpf_cnpj" placeholder="000.000.000-00" />
            </div>
            <div class="form-field form-field--full">
              <label>Nome/Razão Social</label>
              <input type="text" name="nome" placeholder="Nome completo ou razão social" />
            </div>
            <div class="form-field">
              <label>Telefone</label>
              <input type="tel" name="telefone" placeholder="(00) 00000-0000" />
            </div>
            <div class="form-field">
              <label>E-mail</label>
              <input type="email" name="email" placeholder="exemplo@email.com" />
            </div>
          </div>

          <p class="form-group-title">Dados do equipamento</p>
          <div class="form-row">
            <div class="form-field">
              <label>Número de série</label>
              <input type="text" name="serie" placeholder="Nº de série" />
            </div>
            <div class="form-field">
              <label>Data de compra</label>
              <input type="date" name="data_compra" />
            </div>
            <div class="form-field">
              <label>Estado</label>
              <select name="estado">
                <option value="">Selecione</option>
                <option>AC</option><option>AL</option><option>AM</option><option>AP</option>
                <option>BA</option><option>CE</option><option>DF</option><option>ES</option>
                <option>GO</option><option>MA</option><option>MG</option><option>MS</option>
                <option>MT</option><option>PA</option><option>PB</option><option>PE</option>
                <option>PI</option><option>PR</option><option>RJ</option><option>RN</option>
                <option>RO</option><option>RR</option><option>RS</option><option>SC</option>
                <option>SE</option><option>SP</option><option>TO</option>
              </select>
            </div>
            <div class="form-field">
              <label>Cidade</label>
              <input type="text" name="cidade" placeholder="Sua cidade" />
            </div>
            <div class="form-field">
              <label>Plano desejado</label>
              <select name="plano">
                <option value="">Selecione</option>
                <option value="basico">Básico (+1 ano)</option>
                <option value="intermediario">Intermediário (+2 anos)</option>
                <option value="completo">Completo (+3 anos)</option>
              </select>
            </div>
            <div class="form-field">
              <label>Extensão de garantia</label>
              <select name="extensao">
                <option value="">Selecione</option>
                <option value="1">1 ano</option>
                <option value="2">2 anos</option>
                <option value="3">3 anos</option>
              </select>
            </div>
            <div class="form-field form-field--full">
              <label>Nota fiscal *</label>
              <label class="file-upload" for="nota_fiscal">
                <svg class="file-upload__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <span>Clique para anexar a nota fiscal (PDF, JPG, PNG)</span>
              </label>
              <input type="file" id="nota_fiscal" name="nota_fiscal" accept=".pdf,.jpg,.jpeg,.png" style="display:none" />
            </div>
          </div>

          <button type="submit" class="btn-submit">Enviar solicitação</button>
        </form>
      </div>

    </div>
  </section>

  <!-- FOOTER -->
  <footer class="nhs-footer">
    <div class="container">
      <div class="nhs-footer__inner">
        <a href="#" class="nhs-logo">
          <div class="nhs-logo__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M10 2L13 8H17L13.5 12L15 18L10 15L5 18L6.5 12L3 8H7L10 2Z" fill="#F5B200"/>
            </svg>
          </div>
          <span class="nhs-logo__text" style="color:#fff;">NHS</span>
        </a>
        <p class="nhs-footer__phone">
          Central de atendimento: <span>(11) 3000-0000</span>
        </p>
        <div class="nhs-footer__social">
          <a href="#" class="social-icon" aria-label="Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="LinkedIn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="#" class="social-icon" aria-label="YouTube">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
          </a>
        </div>
      </div>
      <p class="nhs-footer__copy">© <?php echo date('Y'); ?> NHS Sistemas Eletrônicos Ltda. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script>
    // File upload label feedback
    document.getElementById('nota_fiscal')?.addEventListener('change', function() {
      const label = this.previousElementSibling.querySelector('span');
      if (this.files.length > 0) {
        label.textContent = this.files[0].name;
        label.style.color = '#152342';
        label.style.fontWeight = '600';
      }
    });
  </script>
</body>
</html>
