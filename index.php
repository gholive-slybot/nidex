<?php
$latestPosts = [];
try {
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/cms/includes/db.php';
    $pdo = getDB();
    $stmt = $pdo->query(
        "SELECT p.title, p.slug, p.excerpt, p.cover_image, p.published_at,
                c.name AS category_name
         FROM posts p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.status = 'published'
         ORDER BY p.published_at DESC, p.created_at DESC
         LIMIT 3"
    );
    $latestPosts = $stmt->fetchAll();
} catch (Throwable $e) {
    // Silently fail — blog section will show empty state
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nidex — Gerencie tudo. Cresça mais rápido.</title>
  <meta name="description" content="CRM, financeiro, cobranças, tarefas, projetos e IA em um único lugar. Feito para empreendedores que querem crescer com mais controle e menos estresse." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="#" class="navbar__logo">nidex</a>
      <nav class="navbar__links" id="navLinks">
        <a href="#funcionalidades">Funcionalidades</a>
        <a href="#como-funciona">Como funciona</a>
        <button class="mega-trigger" id="megaTrigger" aria-expanded="false" aria-controls="megaMenu">
          Serviços
          <svg class="mega-trigger__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <a href="#depoimentos">Depoimentos</a>
        <a href="#precos">Preços</a>
      </nav>
      <div class="navbar__actions">
        <a href="#" class="navbar__login">Entrar</a>
        <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
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
            <p class="mega-card__desc">Capacite sua equipe para usar IA no dia a dia — vendas, marketing, operações e gestão. Sem precisar ser técnico.</p>
            <div class="mega-card__tags">
              <span>Workshops práticos</span>
              <span>Trilha personalizada</span>
              <span>Certificação</span>
            </div>
            <div class="mega-card__cta">
              Saiba mais
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </div>
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
            <p class="mega-card__desc">Transformamos seu problema em uma solução de IA funcional em tempo recorde. MVP entregue em até 2 semanas.</p>
            <div class="mega-card__tags">
              <span>Chatbots</span>
              <span>Análise preditiva</span>
              <span>Automação</span>
            </div>
            <div class="mega-card__cta">
              Saiba mais
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </div>
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
            <p class="mega-card__desc">Estratégia personalizada para adotar IA no seu negócio. Do diagnóstico ao roadmap executável com ROI claro.</p>
            <div class="mega-card__tags">
              <span>Diagnóstico</span>
              <span>Roadmap de IA</span>
              <span>ROI garantido</span>
            </div>
            <div class="mega-card__cta">
              Saiba mais
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </div>
          </div>
        </a>

      </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
      <a href="#funcionalidades" class="mobile-menu__link">Funcionalidades</a>
      <a href="#como-funciona" class="mobile-menu__link">Como funciona</a>
      <a href="/servicos" class="mobile-menu__link">Serviços</a>
      <a href="/treinamento" class="mobile-menu__link mobile-menu__link--sub">↳ Treinamento em IA</a>
      <a href="/desenvolvimento" class="mobile-menu__link mobile-menu__link--sub">↳ Desenvolvimento com IA</a>
      <a href="/consultoria" class="mobile-menu__link mobile-menu__link--sub">↳ Consultoria em IA</a>
      <a href="#depoimentos" class="mobile-menu__link">Depoimentos</a>
      <a href="#precos" class="mobile-menu__link">Preços</a>
      <div class="mobile-menu__actions">
        <a href="#" class="mobile-menu__login">Entrar</a>
        <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>

    <!-- HERO -->
    <section class="hero">
      <div class="hero__bg-grid"></div>
      <div class="hero__glow hero__glow--1"></div>
      <div class="hero__glow hero__glow--2"></div>
      <div class="container hero__inner">
        <div class="hero__content reveal">
          <div class="badge">
            <span class="badge__dot"></span>
            Novo · IA integrada ao seu negócio
          </div>
          <h1 class="hero__headline">
            Gerencie tudo.<br />
            Cresça mais<br />
            <span class="text-accent">rápido.</span>
          </h1>
          <p class="hero__subtext">
            A Nidex reúne CRM, financeiro, cobranças e IA em uma plataforma. Pare de usar 7 ferramentas diferentes e foque no que importa: vender.
          </p>
          <div class="hero__ctas">
            <a href="#contato" class="btn btn--primary btn--lg open-modal">
              Começar grátis — 14 dias
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#" class="btn btn--ghost btn--lg">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5,3 19,12 5,21"/></svg>
              Ver demonstração
            </a>
          </div>
          <div class="hero__stats">
            <div class="hero__stat">
              <span class="hero__stat-value">3.200+</span>
              <span class="hero__stat-label">empreendedores</span>
            </div>
            <div class="hero__stat">
              <span class="hero__stat-value">R$ 48M+</span>
              <span class="hero__stat-label">gerenciados</span>
            </div>
            <div class="hero__stat">
              <span class="hero__stat-value">98%</span>
              <span class="hero__stat-label">satisfação</span>
            </div>
          </div>
        </div>

        <!-- Dashboard Mockup -->
        <div class="hero__mockup reveal reveal--delay">
          <div class="mockup">
            <div class="mockup__bar">
              <div class="mockup__dot mockup__dot--red"></div>
              <div class="mockup__dot mockup__dot--yellow"></div>
              <div class="mockup__dot mockup__dot--green"></div>
              <div class="mockup__url">app.nidex.com.br/dashboard</div>
            </div>
            <div class="mockup__body">
              <aside class="mockup__sidebar">
                <div class="mockup__brand">nidex</div>
                <nav class="mockup__nav">
                  <a class="mockup__nav-item mockup__nav-item--active">
                    <div class="mockup__nav-icon"></div> Dashboard
                  </a>
                  <a class="mockup__nav-item">
                    <div class="mockup__nav-icon"></div> CRM
                  </a>
                  <a class="mockup__nav-item">
                    <div class="mockup__nav-icon"></div> Financeiro
                  </a>
                  <a class="mockup__nav-item">
                    <div class="mockup__nav-icon"></div> Cobranças
                  </a>
                  <a class="mockup__nav-item">
                    <div class="mockup__nav-icon"></div> Projetos
                  </a>
                  <a class="mockup__nav-item">
                    <div class="mockup__nav-icon"></div> IA
                  </a>
                </nav>
              </aside>
              <div class="mockup__main">
                <div class="mockup__header">
                  <div>
                    <div class="mockup__title">Visão geral</div>
                    <div class="mockup__subtitle">Março 2026</div>
                  </div>
                  <div class="mockup__btn">+ Nova venda</div>
                </div>
                <div class="mockup__kpis">
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-label">Receita mensal</div>
                    <div class="mockup__kpi-value">R$ 48.320</div>
                    <div class="mockup__kpi-change">+23% este mês</div>
                  </div>
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-label">Novos clientes</div>
                    <div class="mockup__kpi-value">34</div>
                    <div class="mockup__kpi-change">+8% este mês</div>
                  </div>
                  <div class="mockup__kpi">
                    <div class="mockup__kpi-label">Conversão</div>
                    <div class="mockup__kpi-value">68%</div>
                    <div class="mockup__kpi-change">+12% este mês</div>
                  </div>
                </div>
                <div class="mockup__chart">
                  <div class="mockup__chart-label">Receita — últimos 7 meses</div>
                  <div class="mockup__bars">
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:40%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:65%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:50%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:80%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:70%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill mockup__bar-fill--active" style="height:90%"></div></div>
                    <div class="mockup__bar-wrap"><div class="mockup__bar-fill" style="height:85%"></div></div>
                  </div>
                  <div class="mockup__months">
                    <span>Set</span><span>Out</span><span>Nov</span><span>Dez</span><span>Jan</span><span>Fev</span><span>Mar</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section id="funcionalidades" class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Funcionalidades</span>
          <h2 class="section-title">
            Tudo que seu negócio precisa,<br />
            <span class="text-primary">em um só lugar</span>
          </h2>
          <p class="section-desc">
            Chega de abas abertas, planilhas perdidas e integrações que não funcionam. A Nidex centraliza tudo.
          </p>
        </div>
        <div class="features-grid">

          <!-- CRM -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · CRM Pipeline</span></div>
                <div class="fm-crm">
                  <div class="fm-col">
                    <div class="fm-col-hd">Leads <span class="fm-badge fm-badge--blue">5</span></div>
                    <div class="fm-card"><div class="fm-l" style="width:72%"></div><div class="fm-l fm-l--s" style="width:50%"></div></div>
                    <div class="fm-card"><div class="fm-l" style="width:60%"></div><div class="fm-l fm-l--s" style="width:42%"></div></div>
                    <div class="fm-card"><div class="fm-l" style="width:66%"></div><div class="fm-l fm-l--s" style="width:38%"></div></div>
                  </div>
                  <div class="fm-col">
                    <div class="fm-col-hd">Proposta <span class="fm-badge fm-badge--yellow">3</span></div>
                    <div class="fm-card"><div class="fm-l" style="width:75%"></div><div class="fm-l fm-l--s" style="width:55%"></div></div>
                    <div class="fm-card"><div class="fm-l" style="width:55%"></div><div class="fm-l fm-l--s" style="width:36%"></div></div>
                  </div>
                  <div class="fm-col">
                    <div class="fm-col-hd">Fechado <span class="fm-badge fm-badge--green">2</span></div>
                    <div class="fm-card fm-card--won"><div class="fm-l fm-l--won" style="width:65%"></div><div class="fm-l fm-l--s fm-l--won" style="width:44%"></div></div>
                    <div class="fm-card fm-card--won"><div class="fm-l fm-l--won" style="width:50%"></div><div class="fm-l fm-l--s fm-l--won" style="width:32%"></div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              </div>
              <h3 class="feature-title">CRM Inteligente</h3>
              <p class="feature-desc">Acompanhe cada cliente e oportunidade. Pipeline visual com automações que nutrem leads no piloto automático.</p>
            </div>
          </div>

          <!-- FINANCEIRO -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · Financeiro</span></div>
                <div class="fm-fin">
                  <div class="fm-fin-kpis">
                    <div class="fm-fin-kpi"><div class="fm-fin-kpi-lbl">Receita</div><div class="fm-fin-kpi-val">R$ 48k</div><div class="fm-fin-kpi-ch fm-fin-kpi-ch--up">↑ 23%</div></div>
                    <div class="fm-fin-kpi"><div class="fm-fin-kpi-lbl">Despesas</div><div class="fm-fin-kpi-val">R$ 18k</div><div class="fm-fin-kpi-ch fm-fin-kpi-ch--down">↓ 5%</div></div>
                    <div class="fm-fin-kpi"><div class="fm-fin-kpi-lbl">Lucro</div><div class="fm-fin-kpi-val">R$ 30k</div><div class="fm-fin-kpi-ch fm-fin-kpi-ch--up">↑ 41%</div></div>
                  </div>
                  <div class="fm-fin-chart">
                    <div class="fm-fin-chart-lbl">Fluxo de caixa — últimos 7 meses</div>
                    <div class="fm-fin-bars">
                      <div class="fm-fin-bar" style="height:38%"></div>
                      <div class="fm-fin-bar" style="height:55%"></div>
                      <div class="fm-fin-bar" style="height:47%"></div>
                      <div class="fm-fin-bar" style="height:72%"></div>
                      <div class="fm-fin-bar" style="height:63%"></div>
                      <div class="fm-fin-bar fm-fin-bar--active" style="height:88%"></div>
                      <div class="fm-fin-bar" style="height:78%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
              <h3 class="feature-title">Financeiro Completo</h3>
              <p class="feature-desc">Fluxo de caixa, DRE, contas a pagar e receber. Visão clara do dinheiro do seu negócio em tempo real.</p>
            </div>
          </div>

          <!-- COBRANÇAS -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · Cobranças</span></div>
                <div class="fm-bill">
                  <div class="fm-bill-hd"><span class="fm-bill-title">Cobranças do mês</span><span class="fm-bill-btn">+ Nova</span></div>
                  <div class="fm-bill-row">
                    <div class="fm-bill-ico"></div>
                    <div class="fm-bill-info"><div class="fm-l" style="width:65%"></div><div class="fm-l fm-l--s" style="width:40%"></div></div>
                    <span class="fm-badge fm-badge--green">Pago</span>
                  </div>
                  <div class="fm-bill-row">
                    <div class="fm-bill-ico"></div>
                    <div class="fm-bill-info"><div class="fm-l" style="width:58%"></div><div class="fm-l fm-l--s" style="width:35%"></div></div>
                    <span class="fm-badge fm-badge--yellow">Pendente</span>
                  </div>
                  <div class="fm-bill-row">
                    <div class="fm-bill-ico"></div>
                    <div class="fm-bill-info"><div class="fm-l" style="width:70%"></div><div class="fm-l fm-l--s" style="width:45%"></div></div>
                    <span class="fm-badge fm-badge--green">Pago</span>
                  </div>
                  <div class="fm-bill-row">
                    <div class="fm-bill-ico"></div>
                    <div class="fm-bill-info"><div class="fm-l" style="width:52%"></div><div class="fm-l fm-l--s" style="width:30%"></div></div>
                    <span class="fm-badge fm-badge--red">Vencido</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--yellow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
              </div>
              <h3 class="feature-title">Cobranças Automáticas</h3>
              <p class="feature-desc">Gere boletos, links de pagamento e cobranças recorrentes. Reduza a inadimplência com réguas automáticas.</p>
            </div>
          </div>

          <!-- TAREFAS -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · Projetos</span></div>
                <div class="fm-tasks">
                  <div class="fm-tasks-hd">Sprint atual <span class="fm-badge fm-badge--blue" style="margin-left:5px">6 tarefas</span></div>
                  <div class="fm-task-row"><div class="fm-task-chk fm-task-chk--done"></div><div class="fm-task-info"><div class="fm-l fm-l--done" style="width:68%"></div></div><span class="fm-badge fm-badge--green">Feito</span></div>
                  <div class="fm-task-row"><div class="fm-task-chk fm-task-chk--done"></div><div class="fm-task-info"><div class="fm-l fm-l--done" style="width:55%"></div></div><span class="fm-badge fm-badge--green">Feito</span></div>
                  <div class="fm-task-row fm-task-row--active"><div class="fm-task-chk"></div><div class="fm-task-info"><div class="fm-l" style="width:72%"></div></div><span class="fm-badge fm-badge--blue">Em curso</span></div>
                  <div class="fm-task-row"><div class="fm-task-chk"></div><div class="fm-task-info"><div class="fm-l" style="width:60%"></div></div><span class="fm-badge fm-badge--gray">A fazer</span></div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              </div>
              <h3 class="feature-title">Tarefas e Projetos</h3>
              <p class="feature-desc">Organize equipes, delegue tarefas e acompanhe prazos. Do Kanban ao Gantt, do jeito que você prefere.</p>
            </div>
          </div>

          <!-- IA -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · IA Assistente</span></div>
                <div class="fm-ai">
                  <div class="fm-ai-hd"><div class="fm-ai-avatar"></div><div><div class="fm-ai-name">Nidex IA</div><div class="fm-ai-status">● online</div></div></div>
                  <div class="fm-msg">
                    <div class="fm-msg-av"></div>
                    <div class="fm-bubble"><div class="fm-bubble-text">Qual cliente tem maior potencial de fechamento esse mês?</div></div>
                  </div>
                  <div class="fm-msg fm-msg--user">
                    <div class="fm-msg-av fm-msg-av--ai"></div>
                    <div class="fm-bubble fm-bubble--ai"><div class="fm-bubble-text">Com base no histórico, <strong>Tech Solutions</strong> tem 87% de chance. Último contato há 2 dias. Quer que eu agende um follow-up?</div></div>
                  </div>
                  <div class="fm-msg">
                    <div class="fm-msg-av"></div>
                    <div class="fm-bubble"><div class="fm-bubble-text">Sim, agenda para amanhã às 10h</div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--cyan">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><circle cx="12" cy="16" r="1"/></svg>
              </div>
              <h3 class="feature-title">IA Integrada</h3>
              <p class="feature-desc">Assistente inteligente que analisa seus dados, sugere ações e automatiza o que consome seu tempo.</p>
            </div>
          </div>

          <!-- RELATÓRIOS -->
          <div class="feature-card reveal">
            <div class="feature-card__img">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · Relatórios</span></div>
                <div class="fm-rpt">
                  <div class="fm-rpt-left">
                    <div class="fm-rpt-title">Visão geral <span class="fm-badge fm-badge--blue" style="margin-left:4px">Mar 2026</span></div>
                    <div class="fm-rpt-kpis">
                      <div class="fm-rpt-kpi"><div class="fm-rpt-kpi-lbl">Ticket médio</div><div class="fm-rpt-kpi-val">R$ 1.420</div></div>
                      <div class="fm-rpt-kpi"><div class="fm-rpt-kpi-lbl">Conversão</div><div class="fm-rpt-kpi-val">68%</div></div>
                    </div>
                    <div class="fm-rpt-chart">
                      <div class="fm-rpt-bar" style="height:40%"></div>
                      <div class="fm-rpt-bar" style="height:60%"></div>
                      <div class="fm-rpt-bar" style="height:48%"></div>
                      <div class="fm-rpt-bar" style="height:75%"></div>
                      <div class="fm-rpt-bar" style="height:65%"></div>
                      <div class="fm-rpt-bar fm-rpt-bar--hi" style="height:90%"></div>
                      <div class="fm-rpt-bar" style="height:80%"></div>
                    </div>
                  </div>
                  <div class="fm-rpt-right">
                    <div class="fm-rpt-donut"></div>
                    <div class="fm-rpt-legend">
                      <div class="fm-rpt-leg-item"><div class="fm-rpt-leg-dot" style="background:#2563EB"></div><span class="fm-rpt-leg-lbl">CRM 62%</span></div>
                      <div class="fm-rpt-leg-item"><div class="fm-rpt-leg-dot" style="background:#38BDF8"></div><span class="fm-rpt-leg-lbl">Fin. 20%</span></div>
                      <div class="fm-rpt-leg-item"><div class="fm-rpt-leg-dot" style="background:#E2E8F0"></div><span class="fm-rpt-leg-lbl">Outros 18%</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="feature-card__body">
              <div class="feature-icon feature-icon--orange">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
              </div>
              <h3 class="feature-title">Relatórios em tempo real</h3>
              <p class="feature-desc">Dashboards customizáveis com os KPIs do seu negócio. Tome decisões com dados, não com intuição.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="como-funciona" class="section section--white">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Como funciona</span>
          <h2 class="section-title">
            Em 3 passos você<br />
            <span class="text-accent">transforma seu negócio</span>
          </h2>
        </div>
        <div class="steps">
          <div class="step reveal">
            <div class="step__number">01</div>
            <h3 class="step__title">Crie sua conta</h3>
            <p class="step__desc">Cadastro em menos de 2 minutos. Sem cartão de crédito, sem burocracia. Começa grátis.</p>
          </div>
          <div class="step__connector"></div>
          <div class="step reveal">
            <div class="step__number">02</div>
            <h3 class="step__title">Configure seu negócio</h3>
            <p class="step__desc">Importe seus clientes, configure seu funil de vendas e personalize a plataforma para a sua realidade.</p>
          </div>
          <div class="step__connector"></div>
          <div class="step reveal">
            <div class="step__number">03</div>
            <h3 class="step__title">Cresça com dados</h3>
            <p class="step__desc">Acompanhe métricas em tempo real, automatize processos e tome decisões que aceleram seu crescimento.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="depoimentos" class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Depoimentos</span>
          <h2 class="section-title">
            Empreendedores que já<br />
            <span class="text-primary">transformaram o negócio</span>
          </h2>
        </div>
        <div class="testimonials-grid">
          <div class="testimonial-card reveal">
            <div class="stars">★★★★★</div>
            <p class="testimonial-text">"Antes eu usava WhatsApp, planilha, Trello e mais 3 ferramentas. Hoje tudo está na Nidex. Economizei 3h por dia e aumentei minha receita em 40%."</p>
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Mariana Costa" />
              <div>
                <div class="testimonial-name">Mariana Costa</div>
                <div class="testimonial-role">Fundadora, Studio MC</div>
              </div>
            </div>
          </div>
          <div class="testimonial-card reveal">
            <div class="stars">★★★★★</div>
            <p class="testimonial-text">"A parte financeira era meu pesadelo. Com a Nidex, sei exatamente quanto entra, quanto sai e qual cliente me dá mais lucro. Mudou minha vida."</p>
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rafael Nunes" />
              <div>
                <div class="testimonial-name">Rafael Nunes</div>
                <div class="testimonial-role">CEO, Agência RN Digital</div>
              </div>
            </div>
          </div>
          <div class="testimonial-card reveal">
            <div class="stars">★★★★★</div>
            <p class="testimonial-text">"O CRM me ajudou a não perder mais nenhuma oportunidade. Aumentei meu fechamento de 30% para 68% em dois meses."</p>
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Camila Ferreira" />
              <div>
                <div class="testimonial-name">Camila Ferreira</div>
                <div class="testimonial-role">Consultora de RH</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PRICING -->
    <section id="precos" class="section section--white">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Preços</span>
          <h2 class="section-title">
            Simples, transparente,<br />
            <span class="text-primary">sem surpresas</span>
          </h2>
          <p class="section-desc">Teste grátis por 14 dias. Cancele quando quiser.</p>
        </div>
        <div class="pricing-grid">
          <div class="pricing-card reveal">
            <div class="pricing-name">Starter</div>
            <p class="pricing-desc">Para quem está começando e precisa de controle.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>97
              <span class="pricing-period">/mês</span>
            </div>
            <ul class="pricing-features">
              <li>Até 500 contatos no CRM</li>
              <li>Gestão financeira básica</li>
              <li>Cobranças (até 50/mês)</li>
              <li>Tarefas e projetos</li>
              <li>Suporte por email</li>
            </ul>
            <a href="#contato" class="btn btn--outline btn--full open-modal">Começar grátis</a>
          </div>
          <div class="pricing-card pricing-card--featured reveal">
            <div class="pricing-badge">Mais popular</div>
            <div class="pricing-name">Pro</div>
            <p class="pricing-desc">Para negócios em crescimento que precisam de mais poder.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>197
              <span class="pricing-period">/mês</span>
            </div>
            <ul class="pricing-features">
              <li>Contatos ilimitados</li>
              <li>Financeiro completo + DRE</li>
              <li>Cobranças ilimitadas</li>
              <li>IA integrada</li>
              <li>Automações avançadas</li>
              <li>Suporte prioritário</li>
            </ul>
            <a href="#contato" class="btn btn--white btn--full open-modal">Começar grátis</a>
          </div>
          <div class="pricing-card reveal">
            <div class="pricing-name">Business</div>
            <p class="pricing-desc">Para empresas com equipes e processos complexos.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>397
              <span class="pricing-period">/mês</span>
            </div>
            <ul class="pricing-features">
              <li>Tudo do Pro</li>
              <li>Múltiplos usuários</li>
              <li>Relatórios personalizados</li>
              <li>API e integrações</li>
              <li>Onboarding dedicado</li>
              <li>Suporte 24/7</li>
            </ul>
            <a href="#contato" class="btn btn--outline btn--full open-modal">Falar com vendas</a>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA FINAL -->
    <section class="cta-section">
      <div class="cta-section__bg-grid"></div>
      <div class="cta-section__glow"></div>
      <div class="container cta-section__inner reveal">
        <h2 class="cta-section__title">
          Pronto para <span class="text-accent">simplificar</span><br />seu negócio?
        </h2>
        <p class="cta-section__desc">
          Junte-se a mais de 3.200 empreendedores que já usam a Nidex para crescer com mais controle e menos estresse.
        </p>
        <div class="cta-section__btns">
          <a href="#contato" class="btn btn--primary btn--lg open-modal">
            Começar grátis — 14 dias
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#" class="btn btn--ghost btn--lg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Falar com especialista
          </a>
        </div>
        <p class="cta-section__note">Sem cartão de crédito · Cancele quando quiser · Setup em minutos</p>
      </div>
    </section>

    <!-- BLOG -->
    <section id="blog" class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Blog</span>
          <h2 class="section-title">Conteúdo para <span class="text-primary">empreendedores</span></h2>
          <p class="section-desc">Dicas, estratégias e tendências para crescer com inteligência.</p>
        </div>
        <div class="blog-grid">
          <?php foreach ($latestPosts as $p): ?>
          <a href="/post.php?slug=<?= urlencode($p['slug']) ?>" class="blog-card reveal">
            <?php if ($p['cover_image']): ?>
            <div class="blog-card__img"><img src="<?= htmlspecialchars($p['cover_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy" /></div>
            <?php else: ?>
            <div class="blog-card__img blog-card__img--empty"></div>
            <?php endif; ?>
            <div class="blog-card__body">
              <?php if ($p['category_name']): ?><span class="blog-card__cat"><?= htmlspecialchars($p['category_name']) ?></span><?php endif; ?>
              <h3 class="blog-card__title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="blog-card__excerpt"><?= htmlspecialchars($p['excerpt'] ?? '') ?></p>
              <span class="blog-card__link">Ler artigo →</span>
            </div>
          </a>
          <?php endforeach; ?>
          <?php if (empty($latestPosts)): ?>
          <p style="color:var(--text-muted);grid-column:1/-1;text-align:center">Em breve — os primeiros posts estão chegando.</p>
          <?php endif; ?>
        </div>
        <div style="text-align:center;margin-top:40px">
          <a href="/blog.php" class="btn btn--outline">Ver todos os posts</a>
        </div>
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
        <div class="footer__col-title">Produto</div>
        <a href="#funcionalidades" class="footer__link">Funcionalidades</a>
        <a href="#precos" class="footer__link">Preços</a>
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

  <script src="script.js"></script>
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
  // Reset errors
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
      document.getElementById('contactForm').style.display='none';
    } else {
      btn.disabled=false; btn.textContent='Quero começar grátis';
      if (data.errors) Object.entries(data.errors).forEach(([k,v]) => { const el=document.getElementById('err-'+k); if(el) el.textContent=v; });
    }
  } catch { btn.disabled=false; btn.textContent='Quero começar grátis'; }
});
  </script>
</body>
</html>
