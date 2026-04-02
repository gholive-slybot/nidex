    <!-- HERO SPLIT -->
    <section class="hero-split">

      <!-- Painel 1: Nidex.Cowork — Azul -->
      <div data-href="/cowork" class="hero-split__panel hero-split__panel--cowork">
        <div class="hero-split__grid"></div>
        <div class="hero-split__glow hero-split__glow--blue"></div>
        <div class="hero-split__glow hero-split__glow--blue2"></div>
        <div class="hero-split__inner">
          <span class="hero-split__eyebrow">
            <span class="hero-split__eyebrow-dot hero-split__eyebrow-dot--blue"></span>
            Nidex.Cowork
          </span>
          <h2 class="hero-split__title">
            Ecossistema completo<br />
            de Apps com<br />
            <span class="hero-split__accent hero-split__accent--blue">Agentes de IA trabalhando por você.</span>
          </h2>
          <p class="hero-split__desc">
            Todos os apps do seu negócio em um único lugar — com Agentes de IA embarcados em cada módulo, executando tarefas de forma autônoma enquanto você foca no que importa.
          </p>
          <div class="hero-split__pills">
            <a href="/cowork#crm">CRM</a>
            <a href="/cowork#financeiro">Financeiro</a>
            <a href="/cowork#cobrancas">Cobranças</a>
            <a href="/cowork#projetos">Projetos</a>
            <a href="/cowork#agenda">Agenda</a>
            <a href="/cowork#ia" class="hero-split__pill--ia">+ Agentes de IA</a>
          </div>
          <div class="hero-split__cta">
            <a href="/cowork" class="hero-split__btn hero-split__btn--blue">
              Conhecer o Cowork
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Divisor central -->
      <div class="hero-split__divider"></div>

      <!-- Painel 2: Nidex.Run — Teal/Verde -->
      <div data-href="/run" class="hero-split__panel hero-split__panel--run">
        <div class="hero-split__grid"></div>
        <div class="hero-split__glow hero-split__glow--teal"></div>
        <div class="hero-split__glow hero-split__glow--teal2"></div>
        <div class="hero-split__inner">
          <span class="hero-split__eyebrow">
            <span class="hero-split__eyebrow-dot hero-split__eyebrow-dot--teal"></span>
            Nidex.Run
          </span>
          <h2 class="hero-split__title">
            Serviços e Agentes de IA<br />
            <span class="hero-split__accent hero-split__accent--teal">sob medida</span><br />
            para o seu negócio.
          </h2>
          <p class="hero-split__desc">
            Serviços premium de IA conectados de forma personalizada ao seu negócio — do treinamento da equipe ao deployment de Agentes customizados no seu stack.
          </p>
          <div class="hero-split__pills">
            <a href="/run/academy">Academy</a>
            <a href="/run/projects">Projects</a>
            <a href="/run/ia-agents">IA Agents</a>
            <a href="/run/consulting">Consulting</a>
          </div>
          <div class="hero-split__cta">
            <a href="/run" class="hero-split__btn hero-split__btn--teal">
              Conhecer o Run
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </div>

    </section>

    <script>
      document.querySelectorAll('.hero-split__panel[data-href]').forEach(function(panel) {
        panel.addEventListener('click', function(e) {
          if (!e.target.closest('a')) {
            window.location.href = panel.dataset.href;
          }
        });
      });
    </script>
