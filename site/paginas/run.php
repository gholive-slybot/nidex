<?php
$page_title       = 'Nidex.Run — IA de Alta Performance para Empresas';
$page_description = 'Nidex.Run executa serviços de IA de alta performance: Academy, Projects, IA Agents e Consulting. Transforme sua empresa com inteligência artificial.';
require_once dirname(dirname(__DIR__)) . '/site/includes/head-page.php';
require_once dirname(dirname(__DIR__)) . '/site/includes/header.php';
?>

<!-- HERO -->
<section class="run-hero">
  <div class="run-hero__grid"></div>
  <div class="run-hero__glow run-hero__glow--1"></div>
  <div class="run-hero__glow run-hero__glow--2"></div>
  <div class="container run-hero__inner">
    <span class="run-hero__label">Nidex.Run</span>
    <h1 class="run-hero__title">
      IA de alta performance<br />
      <span class="text-run">para empresas que evoluem.</span>
    </h1>
    <p class="run-hero__desc">
      Quatro abordagens estratégicas para implementar, integrar e escalar inteligência artificial
      no seu negócio — do treinamento ao projeto mais complexo.
    </p>
    <div class="run-hero__pills">
      <a href="/run/academy" class="run-pill">
        <span class="run-pill__dot run-pill__dot--1"></span>
        Nidex.Academy
      </a>
      <a href="/run/projects" class="run-pill">
        <span class="run-pill__dot run-pill__dot--2"></span>
        Nidex.Projects
      </a>
      <a href="/run/ia-agents" class="run-pill">
        <span class="run-pill__dot run-pill__dot--3"></span>
        Nidex.IA Agents
      </a>
      <a href="/run/consulting" class="run-pill">
        <span class="run-pill__dot run-pill__dot--4"></span>
        Nidex.Consulting
      </a>
    </div>
  </div>
</section>

<!-- SUMMARY CARDS -->
<section class="run-summary">
  <div class="container">
    <div class="run-summary__header reveal">
      <span class="section-label">Nossos Serviços</span>
      <h2 class="run-summary__title">Escolha sua abordagem de IA</h2>
    </div>
    <div class="run-summary__grid">

      <!-- Academy -->
      <a href="/run/academy" class="run-sum-card reveal">
        <div class="run-sum-card__img">
          <img src="/site/assets/img/nidex-academy2.png" alt="Nidex.Academy" loading="lazy" />
          <div class="run-sum-card__img-overlay"></div>
          <span class="run-sum-card__num">01</span>
          <span class="run-sum-card__badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/></svg>
            Capacitação
          </span>
        </div>
        <div class="run-sum-card__body">
          <h3 class="run-sum-card__title">Nidex.<span class="text-run">Academy</span></h3>
          <p class="run-sum-card__desc">Treinamentos in company e online para equipes de qualquer porte. Customizado para o seu segmento e função — sua equipe usa IA na prática a partir da próxima semana.</p>
          <div class="run-sum-card__chips">
            <span>Workshops práticos</span>
            <span>Trilha por função</span>
            <span>Certificação</span>
            <span>Online ou presencial</span>
          </div>
          <span class="run-sum-card__link">
            Ver detalhes
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </span>
        </div>
      </a>

      <!-- Projects -->
      <a href="/run/projects" class="run-sum-card reveal">
        <div class="run-sum-card__img">
          <img src="/site/assets/img/nidex-projects4.png" alt="Nidex.Projects" loading="lazy" />
          <div class="run-sum-card__img-overlay"></div>
          <span class="run-sum-card__num">02</span>
          <span class="run-sum-card__badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            Desenvolvimento
          </span>
        </div>
        <div class="run-sum-card__body">
          <h3 class="run-sum-card__title">Nidex.<span class="text-run">Projects</span></h3>
          <p class="run-sum-card__desc">Desenvolvimento de softwares, apps e automações com IA embarcada. MVP funcional em até 2 semanas — do discovery ao deploy com time completo.</p>
          <div class="run-sum-card__chips">
            <span>MVP em 2 semanas</span>
            <span>IA embarcada</span>
            <span>Apps & chatbots</span>
            <span>Deploy incluso</span>
          </div>
          <span class="run-sum-card__link">
            Ver detalhes
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </span>
        </div>
      </a>

      <!-- IA Agents -->
      <a href="/run/ia-agents" class="run-sum-card reveal">
        <div class="run-sum-card__img">
          <img src="/site/assets/img/nidex-agents2.png" alt="Nidex.IA Agents" loading="lazy" />
          <div class="run-sum-card__img-overlay"></div>
          <span class="run-sum-card__num">03</span>
          <span class="run-sum-card__badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
            Agentes Autônomos
          </span>
        </div>
        <div class="run-sum-card__body">
          <h3 class="run-sum-card__title">Nidex.<span class="text-run">IA Agents</span></h3>
          <p class="run-sum-card__desc">Agentes de IA acoplados ao software que o cliente já utiliza — via API ou webhook. Sem trocar sistema, sem interromper operação. Inteligência autônoma embarcada.</p>
          <div class="run-sum-card__chips">
            <span>Zero interrupção</span>
            <span>Agentes autônomos</span>
            <span>Qualquer sistema</span>
            <span>Suporte contínuo</span>
          </div>
          <span class="run-sum-card__link">
            Ver detalhes
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </span>
        </div>
      </a>

      <!-- Consulting -->
      <a href="/run/consulting" class="run-sum-card reveal">
        <div class="run-sum-card__img">
          <img src="/site/assets/img/nidex-consulting3.png" alt="Nidex.Consulting" loading="lazy" />
          <div class="run-sum-card__img-overlay"></div>
          <span class="run-sum-card__num">04</span>
          <span class="run-sum-card__badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Consultoria Premium
          </span>
        </div>
        <div class="run-sum-card__body">
          <h3 class="run-sum-card__title">Nidex.<span class="text-run">Consulting</span></h3>
          <p class="run-sum-card__desc">Diagnóstico completo de maturidade em IA, roadmap estratégico com ROI estimado e execução supervisionada. Para quem quer resultado real, não relatório.</p>
          <div class="run-sum-card__chips">
            <span>Diagnóstico completo</span>
            <span>ROI por iniciativa</span>
            <span>Roadmap 12 meses</span>
            <span>Execução supervisionada</span>
          </div>
          <span class="run-sum-card__link">
            Ver detalhes
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </span>
        </div>
      </a>

    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="run-cta">
  <div class="run-cta__glow"></div>
  <div class="container run-cta__inner reveal">
    <span class="section-label section-label--accent">Pronto para começar?</span>
    <h2 class="run-cta__title">Escolha sua abordagem.<br /><span class="text-run">Execute com quem entende.</span></h2>
    <p class="run-cta__desc">Entre em contato e nosso time define a melhor estratégia para o seu momento.</p>
    <div class="run-cta__actions">
      <a href="#contato" class="btn btn--run open-modal">Falar com especialista</a>
      <a href="/cowork" class="btn btn--ghost-dark">Conhecer o Nidex.Cowork</a>
    </div>
  </div>
</section>

<?php require_once dirname(dirname(__DIR__)) . '/site/includes/footer.php'; ?>
