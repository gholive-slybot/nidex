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
  <title>nidex — O simples completo</title>
  <meta name="description" content="Ecossistema inteligente para empreendedores. CRM, financeiro, cobranças e gestão de projetos integrados com IA nativa." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="#" class="navbar__logo"><img src="/uploads/logo-nidex-cor.svg" alt="nidex" /></a>
      <nav class="navbar__links" id="navLinks">
        <a href="#funcionalidades">Funcionalidades</a>
        <a href="#ia">IA</a>
        <button class="mega-trigger" id="megaTrigger" aria-expanded="false" aria-controls="megaMenu">
          Serviços
          <svg class="mega-trigger__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <a href="#precos">Preços</a>
        <a href="#faq">FAQ</a>
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
      <a href="#ia" class="mobile-menu__link">IA</a>
      <a href="/servicos" class="mobile-menu__link">Serviços</a>
      <a href="/treinamento" class="mobile-menu__link mobile-menu__link--sub">↳ Treinamento em IA</a>
      <a href="/desenvolvimento" class="mobile-menu__link mobile-menu__link--sub">↳ Desenvolvimento com IA</a>
      <a href="/consultoria" class="mobile-menu__link mobile-menu__link--sub">↳ Consultoria em IA</a>
      <a href="#precos" class="mobile-menu__link">Preços</a>
      <a href="#faq" class="mobile-menu__link">FAQ</a>
      <div class="mobile-menu__actions">
        <a href="#" class="mobile-menu__login">Entrar</a>
        <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>

    <!-- HERO -->
    <section class="hero hero--photo">
      <!-- Swap /images/hero-bg.jpg for a real photo of an entrepreneur -->
      <div class="hero__photo-bg" style="background-image:url('/images/hero-bg.jpg')"></div>
      <div class="hero__overlay"></div>
      <div class="hero__bg-grid"></div>
      <div class="hero__glow hero__glow--1"></div>
      <div class="container hero__inner hero__inner--left">
        <div class="hero__content reveal">
          <div class="badge">
            <span class="badge__dot"></span>
            Novo · IA integrada ao seu negócio
          </div>
          <h1 class="hero__headline">
            Um ecossistema inteligente<br />
            <span class="text-accent">para empreendedores.</span>
          </h1>
          <p class="hero__subtext">
            CRM, financeiro, cobranças e gestão de projetos integrados com IA nativa. Tudo que você precisa para crescer, em um único lugar.
          </p>
          <div class="hero__ctas">
            <a href="#contato" class="btn btn--primary btn--lg open-modal">
              Começar agora
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#funcionalidades" class="btn btn--ghost btn--lg">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5,3 19,12 5,21"/></svg>
              Ver como funciona
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
      </div>
    </section>

    <!-- PROBLEM -->
    <section class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">O problema</span>
          <h2 class="section-title">
            Todos os empreendedores usam várias ferramentas.<br />
            <span class="text-primary">A nidex centraliza tudo.</span>
          </h2>
        </div>
        <div class="problem-grid">
          <div class="problem-card reveal">
            <div class="problem-card__num">01</div>
            <h3 class="problem-card__title">Um jeito só</h3>
            <p class="problem-card__desc">Fique no controle de tudo com uma única login, uma única interface e uma única mensalidade.</p>
          </div>
          <div class="problem-card reveal">
            <div class="problem-card__num">02</div>
            <h3 class="problem-card__title">O que trabalha por você</h3>
            <p class="problem-card__desc">Automações inteligentes que executam tarefas repetitivas enquanto você foca no que importa: crescer.</p>
          </div>
          <div class="problem-card reveal">
            <div class="problem-card__num">03</div>
            <h3 class="problem-card__title">Dados que convertem mais</h3>
            <p class="problem-card__desc">Tome decisões com inteligência. Relatórios, previsões e insights prontos no seu dashboard.</p>
          </div>
        </div>
        <div class="problem-quote reveal">
          <p>"A tecnologia deveria libertar. A nidex é para isso."</p>
        </div>
      </div>
    </section>

    <!-- MODULES -->
    <section id="funcionalidades" class="section section--dark">
      <div class="container">
        <div class="section-header section-header--light reveal">
          <span class="section-label section-label--accent">Módulos</span>
          <h2 class="section-title section-title--light">
            Tudo que você precisa.<br />
            <span class="text-accent">Nada que você não precisa.</span>
          </h2>
          <p class="section-desc section-desc--muted">Módulos integrados que se conectam naturalmente. Da ideia ao dinheiro, do plano à execução.</p>
        </div>
        <div class="module-grid">

          <!-- CRM -->
          <div class="module-card reveal">
            <div class="module-card__screen">
              <div class="fm-screen">
                <div class="fm-bar"><span class="fm-dot fm-dot--r"></span><span class="fm-dot fm-dot--y"></span><span class="fm-dot fm-dot--g"></span><span class="fm-url">nidex · CRM Pipeline</span></div>
                <div class="fm-crm">
                  <div class="fm-col">
                    <div class="fm-col-hd">Leads <span class="fm-badge fm-badge--blue">5</span></div>
                    <div class="fm-card"><div class="fm-l" style="width:72%"></div><div class="fm-l fm-l--s" style="width:50%"></div></div>
                    <div class="fm-card"><div class="fm-l" style="width:60%"></div><div class="fm-l fm-l--s" style="width:42%"></div></div>
                  </div>
                  <div class="fm-col">
                    <div class="fm-col-hd">Proposta <span class="fm-badge fm-badge--yellow">3</span></div>
                    <div class="fm-card"><div class="fm-l" style="width:75%"></div><div class="fm-l fm-l--s" style="width:55%"></div></div>
                    <div class="fm-card"><div class="fm-l" style="width:55%"></div><div class="fm-l fm-l--s" style="width:36%"></div></div>
                  </div>
                  <div class="fm-col">
                    <div class="fm-col-hd">Fechado <span class="fm-badge fm-badge--green">2</span></div>
                    <div class="fm-card fm-card--won"><div class="fm-l fm-l--won" style="width:65%"></div><div class="fm-l fm-l--s fm-l--won" style="width:44%"></div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="module-card__body">
              <div class="module-card__head">
                <div class="feature-icon feature-icon--blue">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="module-card__title">CRM Inteligente</h3>
              </div>
              <p class="module-card__desc">Acompanhe cada cliente do primeiro contato ao fechamento. Pipeline visual com automações no piloto automático.</p>
              <ul class="module-card__features">
                <li>Pipeline Kanban visual e personalizável</li>
                <li>Histórico completo de cada cliente</li>
                <li>Lembretes e follow-ups automáticos</li>
                <li>Relatório de conversão em tempo real</li>
              </ul>
            </div>
          </div>

          <!-- FINANCEIRO -->
          <div class="module-card reveal">
            <div class="module-card__screen">
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
            <div class="module-card__body">
              <div class="module-card__head">
                <div class="feature-icon feature-icon--green">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="module-card__title">Financeiro</h3>
              </div>
              <p class="module-card__desc">Controle de receitas, despesas, fluxo de caixa e projeções. Para não ter mais surpresas no fim do mês.</p>
              <ul class="module-card__features">
                <li>Fluxo de caixa em tempo real</li>
                <li>Contas a pagar e a receber</li>
                <li>Conciliação bancária integrada</li>
                <li>DRE e relatórios financeiros</li>
              </ul>
            </div>
          </div>

          <!-- COBRANÇAS -->
          <div class="module-card reveal">
            <div class="module-card__screen">
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
            <div class="module-card__body">
              <div class="module-card__head">
                <div class="feature-icon feature-icon--yellow">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <h3 class="module-card__title">Cobranças e Pagamentos</h3>
              </div>
              <p class="module-card__desc">Gere boletos, Pix e links de pagamento. Automatize réguas de cobrança e reduza a inadimplência.</p>
              <ul class="module-card__features">
                <li>Boleto, Pix e cartão integrados</li>
                <li>Réguas de cobrança automáticas</li>
                <li>Notificações por WhatsApp e email</li>
                <li>Conciliação automática de pagamentos</li>
              </ul>
            </div>
          </div>

          <!-- TAREFAS -->
          <div class="module-card reveal">
            <div class="module-card__screen">
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
            <div class="module-card__body">
              <div class="module-card__head">
                <div class="feature-icon feature-icon--purple">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </div>
                <h3 class="module-card__title">Gestão de Tarefas e Projetos</h3>
              </div>
              <p class="module-card__desc">Organize equipes, delegue com clareza e acompanhe prazos. Kanban, lista ou linha do tempo.</p>
              <ul class="module-card__features">
                <li>Kanban, lista e visão de timeline</li>
                <li>Delegação com responsáveis e prazos</li>
                <li>Comentários e anexos em cada tarefa</li>
                <li>Relatório de produtividade da equipe</li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- AI SECTION -->
    <section id="ia" class="ai-section">
      <div class="ai-section__glow"></div>
      <div class="container ai-section__inner">

        <!-- Left: text -->
        <div class="ai-section__content reveal">
          <span class="section-label section-label--accent">Inteligência Artificial nativa</span>
          <h2 class="ai-section__title">
            Diga o que precisa.<br />
            <span class="text-accent">A IA executa.</span>
          </h2>
          <p class="ai-section__desc">
            A inteligência artificial embarcada em todo o sistema. Uma conversação em linguagem natural para realizar qualquer ação.
          </p>
          <a href="#contato" class="btn btn--primary open-modal">
            Experimentar a IA
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>

        <!-- Right: chat UI -->
        <div class="ai-chat reveal reveal--delay">
          <div class="ai-chat__header">
            <div class="ai-chat__avatar">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="ai-chat__name">nidex IA</span>
            <div class="ai-chat__status">
              <span class="ai-chat__dot"></span>
              Online
            </div>
          </div>
          <div class="ai-chat__prompts">
            <div class="ai-chat__prompt">
              <span class="ai-chat__arrow">→</span>
              Crie um relatório de vendas do último trimestre
            </div>
            <div class="ai-chat__prompt">
              <span class="ai-chat__arrow">→</span>
              Me mostre os clientes inadimplentes há mais de 30 dias
            </div>
            <div class="ai-chat__prompt">
              <span class="ai-chat__arrow">→</span>
              Registre o pagamento do cliente Marcos de R$ 4.520
            </div>
            <div class="ai-chat__prompt">
              <span class="ai-chat__arrow">→</span>
              Projete o fluxo de caixa para os próximos 30 dias
            </div>
          </div>
          <div class="ai-chat__input">
            <span class="ai-chat__placeholder">Digite o que você precisa fazer...</span>
            <button class="ai-chat__send" aria-label="Enviar">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- MOBILE SECTION -->
    <section class="mobile-section">
      <!-- Swap /images/mobile-bg.jpg for a real city/office photo -->
      <div class="mobile-section__bg" style="background-image:url('/images/mobile-bg.jpg')"></div>
      <div class="mobile-section__overlay"></div>
      <div class="container mobile-section__inner">

        <!-- Left: content -->
        <div class="mobile-section__content reveal">
          <span class="section-label section-label--accent">Em todos os lugares</span>
          <h2 class="mobile-section__title">
            Seu negócio<br />
            <span class="text-accent">na palma da mão.</span>
          </h2>
          <p class="mobile-section__desc">
            Disponível para iOS e Android. Acesse seus dados, feche negócios e gerencie sua equipe de onde estiver.
          </p>
          <ul class="mobile-section__features">
            <li>Visualizar dashboard</li>
            <li>Registrar financeiro</li>
            <li>Responder clientes</li>
            <li>Gerenciar com IA</li>
          </ul>
          <div class="mobile-section__ctas">
            <a href="#" class="btn btn--white">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
              App iOS
            </a>
            <a href="#" class="btn btn--ghost">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
              Google Play
            </a>
          </div>
        </div>

        <!-- Right: phone mockup -->
        <div class="phone-mockup reveal reveal--delay" id="phoneMockup">
          <div class="phone-mockup__wrapper">
            <!-- Gradient screen shown behind the iPhone frame -->
            <div class="phone-mockup__screen-inner">
              <div class="phone-mockup__screen-logo">
                <img src="/uploads/logo-nidex-white.svg" alt="nidex" />
              </div>
              <div class="phone-mockup__screen-tagline">Seu negócio na palma da mão</div>
            </div>
            <!-- iPhone frame overlay -->
            <img src="/uploads/iphone-moc.png" class="phone-mockup__img" alt="Nidex Mobile App" loading="lazy">
          </div>
          <div class="phone-mockup__glow"></div>
        </div>

      </div>
    </section>

    <!-- WHY NIDEX -->
    <section class="why-section section--light section">
      <div class="container why-section__inner reveal">
        <h2 class="why-section__title">
          Empreender já é complexo demais.<br />
          <span class="text-primary">A tecnologia precisa simplificar.</span>
        </h2>
        <p class="why-section__tagline">nidex. O simples completo.</p>
        <a href="#contato" class="btn btn--primary btn--lg open-modal">
          Começar agora
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="section section--white">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Dúvidas frequentes</span>
          <h2 class="section-title">Perguntas frequentes</h2>
        </div>
        <div class="faq-list">

          <div class="faq-item reveal">
            <button class="faq-item__trigger" aria-expanded="false">
              <span>O que é o nidex?</span>
              <span class="faq-item__icon">
                <svg class="faq-item__plus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <svg class="faq-item__minus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </span>
            </button>
            <div class="faq-item__answer">
              <p>O nidex é um ecossistema all-in-one para empreendedores. Reúne CRM, financeiro, cobranças, gestão de projetos e IA em uma única plataforma integrada, eliminando a necessidade de múltiplas ferramentas.</p>
            </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-item__trigger" aria-expanded="false">
              <span>Existe limite de uso no nidex?</span>
              <span class="faq-item__icon">
                <svg class="faq-item__plus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <svg class="faq-item__minus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </span>
            </button>
            <div class="faq-item__answer">
              <p>Depende do plano escolhido. O plano Individual tem limites menores para uso solo. Os planos Gestão Pequena, Sem Limitações e Empresas têm limites progressivamente maiores, chegando a uso ilimitado.</p>
            </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-item__trigger" aria-expanded="false">
              <span>Meus dados são seguros?</span>
              <span class="faq-item__icon">
                <svg class="faq-item__plus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <svg class="faq-item__minus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </span>
            </button>
            <div class="faq-item__answer">
              <p>Sim. Utilizamos criptografia de ponta a ponta, backups automáticos diários e infraestrutura em nuvem com certificação SOC 2. Seus dados nunca são compartilhados com terceiros.</p>
            </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-item__trigger" aria-expanded="false">
              <span>Existe integração com outros sistemas?</span>
              <span class="faq-item__icon">
                <svg class="faq-item__plus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <svg class="faq-item__minus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </span>
            </button>
            <div class="faq-item__answer">
              <p>Sim. O nidex se integra com as principais ferramentas: WhatsApp Business, Google Workspace, Zapier e diversos gateways de pagamento. O plano Empresas inclui acesso à API completa.</p>
            </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-item__trigger" aria-expanded="false">
              <span>Como funciona o suporte?</span>
              <span class="faq-item__icon">
                <svg class="faq-item__plus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <svg class="faq-item__minus" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
              </span>
            </button>
            <div class="faq-item__answer">
              <p>Todos os planos incluem suporte por chat. O plano Gestão Pequena tem suporte prioritário. O plano Empresas inclui gerente de sucesso dedicado e suporte 24/7.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- PRICING -->
    <section id="precos" class="section section--light">
      <div class="container">
        <div class="section-header reveal">
          <span class="section-label">Preços</span>
          <h2 class="section-title">
            Quanto mais sua equipe cresce,<br />
            <span class="text-primary">menos você paga.</span>
          </h2>
          <p class="section-desc">Teste grátis por 14 dias. Sem cartão de crédito. Cancele quando quiser.</p>
        </div>
        <div class="pricing-grid pricing-grid--4">

          <div class="pricing-card reveal">
            <div class="pricing-users">1 usuário</div>
            <div class="pricing-name">Individual</div>
            <p class="pricing-desc">Para quem trabalha solo e precisa de controle total.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>99
              <span class="pricing-period">/mês</span>
            </div>
            <ul class="pricing-features">
              <li>CRM com até 500 contatos</li>
              <li>Financeiro completo</li>
              <li>Cobranças (até 50/mês)</li>
              <li>Tarefas e projetos</li>
              <li>Suporte por chat</li>
            </ul>
            <a href="#contato" class="btn btn--outline btn--full open-modal">Começar grátis</a>
          </div>

          <div class="pricing-card pricing-card--featured reveal">
            <div class="pricing-badge">Popular</div>
            <div class="pricing-users">Até 5 usuários</div>
            <div class="pricing-name">Gestão Pequena</div>
            <p class="pricing-desc">Para pequenas equipes que querem crescer com organização.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>85
              <span class="pricing-period">/usuário/mês</span>
            </div>
            <ul class="pricing-features">
              <li>Tudo do Individual</li>
              <li>CRM ilimitado</li>
              <li>Cobranças ilimitadas</li>
              <li>IA integrada</li>
              <li>Suporte prioritário</li>
            </ul>
            <a href="#contato" class="btn btn--white btn--full open-modal">Começar grátis</a>
          </div>

          <div class="pricing-card reveal">
            <div class="pricing-users">Usuários ilimitados</div>
            <div class="pricing-name">Sem Limitações</div>
            <p class="pricing-desc">Para times que precisam escalar sem limitações.</p>
            <div class="pricing-price">
              <span class="pricing-currency">R$</span>75
              <span class="pricing-period">/usuário/mês</span>
            </div>
            <ul class="pricing-features">
              <li>Tudo do Gestão Pequena</li>
              <li>Automações avançadas</li>
              <li>Relatórios personalizados</li>
              <li>API e integrações</li>
              <li>Onboarding dedicado</li>
            </ul>
            <a href="#contato" class="btn btn--outline btn--full open-modal">Começar grátis</a>
          </div>

          <div class="pricing-card reveal">
            <div class="pricing-users">Multi-empresa</div>
            <div class="pricing-name">Empresas</div>
            <p class="pricing-desc">Para empresas com processos complexos e time de vendas.</p>
            <div class="pricing-price pricing-price--consult">
              Sob consulta
            </div>
            <ul class="pricing-features">
              <li>Tudo do Sem Limitações</li>
              <li>Multi-empresa</li>
              <li>SLA contratual</li>
              <li>Gerente de sucesso</li>
              <li>Suporte 24/7</li>
            </ul>
            <a href="#contato" class="btn btn--outline btn--full open-modal">Falar com consultor</a>
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
          Junte-se a mais de 3.200 empreendedores que já usam a nidex para crescer com mais controle e menos estresse.
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
        <div class="footer__logo"><img src="/uploads/logo-nidex-white.svg" alt="nidex" /></div>
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
