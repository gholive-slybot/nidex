<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guideline — Nidex Design System</title>
  <meta name="description" content="Referência visual e de componentes do Design System Nidex." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/style.css" />
  <style>
    /* ── Guideline-only overrides ── */
    body { background: #fff; }

    .gl-header {
      background: var(--bg-dark);
      padding: 64px 0 48px;
      margin-bottom: 64px;
    }
    .gl-header__label {
      display: block;
      color: var(--accent);
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 12px;
    }
    .gl-header__title {
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 800;
      color: #fff;
      margin-bottom: 12px;
    }
    .gl-header__title span { color: var(--primary); }
    .gl-header__desc {
      font-size: 1.125rem;
      color: rgba(255,255,255,0.5);
      max-width: 560px;
    }

    .gl-section { margin-bottom: 80px; }
    .gl-section__title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-primary);
      padding-bottom: 16px;
      border-bottom: 1px solid var(--border);
      margin-bottom: 32px;
    }

    /* Color swatches */
    .gl-swatches {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 16px;
      margin-bottom: 24px;
    }
    .gl-swatch { border-radius: 12px; overflow: hidden; border: 1px solid var(--border); }
    .gl-swatch__color { height: 72px; }
    .gl-swatch__info { padding: 12px; background: #fff; }
    .gl-swatch__name { font-size: 0.75rem; font-weight: 700; color: var(--text-primary); display: block; margin-bottom: 3px; }
    .gl-swatch__hex  { font-size: 0.75rem; font-family: monospace; color: var(--text-muted); }

    /* Gradient tiles */
    .gl-gradients {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 16px;
    }
    .gl-gradient { border-radius: 14px; overflow: hidden; border: 1px solid var(--border); }
    .gl-gradient__preview { height: 100px; display: flex; align-items: center; justify-content: center; }
    .gl-gradient__info { padding: 16px; background: #fff; }
    .gl-gradient__name { font-size: 0.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
    .gl-gradient__css  { font-size: 0.75rem; font-family: monospace; color: var(--text-muted); word-break: break-all; margin-bottom: 4px; }
    .gl-gradient__class { font-size: 0.75rem; font-family: monospace; color: var(--primary); }

    /* Typography rows */
    .gl-type-row {
      display: flex;
      align-items: flex-start;
      gap: 32px;
      padding: 20px 0;
      border-bottom: 1px solid #F1F5F9;
    }
    .gl-type-meta { width: 180px; flex-shrink: 0; }
    .gl-type-meta__name { font-size: 0.875rem; font-weight: 600; color: var(--text-primary); margin-bottom: 4px; }
    .gl-type-meta__spec { font-size: 0.75rem; color: var(--text-muted); }

    /* Button showcase */
    .gl-buttons {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 12px;
      padding: 24px;
      border-radius: 16px;
      margin-bottom: 16px;
    }
    .gl-buttons--dark { background: var(--bg-dark); }
    .gl-buttons--light { background: var(--bg-light); border: 1px solid var(--border); }

    /* Card showcase */
    .gl-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 24px;
    }

    /* Token table */
    .gl-tokens { width: 100%; border-collapse: collapse; }
    .gl-tokens th { text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-muted); padding: 8px 12px; border-bottom: 2px solid var(--border); text-transform: uppercase; letter-spacing: 0.06em; }
    .gl-tokens td { font-size: 0.875rem; padding: 10px 12px; border-bottom: 1px solid #F1F5F9; vertical-align: top; }
    .gl-tokens td:first-child { font-family: monospace; color: var(--primary); }
    .gl-tokens td:nth-child(2) { font-family: monospace; color: var(--text-muted); }

    /* Section pattern */
    .gl-section-pattern {
      display: flex;
      flex-direction: column;
      gap: 4px;
      max-width: 400px;
    }
    .gl-sp-row {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 0.875rem;
    }
    .gl-sp-dot {
      width: 16px; height: 16px;
      border-radius: 4px;
      border: 1px solid var(--border);
      flex-shrink: 0;
    }

    /* Code block */
    .gl-code {
      background: var(--bg-dark);
      border-radius: 12px;
      padding: 20px 24px;
      overflow-x: auto;
    }
    .gl-code pre {
      font-family: monospace;
      font-size: 0.8125rem;
      color: rgba(255,255,255,0.7);
      line-height: 1.6;
      margin: 0;
    }
    .gl-code pre .token-key   { color: #38BDF8; }
    .gl-code pre .token-val   { color: #86efac; }
    .gl-code pre .token-com   { color: rgba(255,255,255,0.3); }

    /* Spacing */
    .gl-spacing {
      display: flex;
      flex-wrap: wrap;
      align-items: flex-end;
      gap: 16px;
      margin-bottom: 24px;
    }
    .gl-spacing__item { display: flex; flex-direction: column; align-items: center; gap: 6px; }
    .gl-spacing__box  { background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3); border-radius: 4px; width: 20px; }
    .gl-spacing__label { font-size: 0.6875rem; color: var(--text-muted); }

    /* Radius */
    .gl-radii { display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 24px; }
    .gl-radius__item { display: flex; flex-direction: column; align-items: center; gap: 8px; }
    .gl-radius__box { width: 60px; height: 60px; background: rgba(37,99,235,0.12); border: 2px solid rgba(37,99,235,0.3); }
    .gl-radius__label { font-size: 0.75rem; font-weight: 600; color: var(--text-primary); text-align: center; }
    .gl-radius__value { font-size: 0.6875rem; color: var(--text-muted); }

    /* Shadows */
    .gl-shadows { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 24px; }
    .gl-shadow__box { width: 80px; height: 80px; border-radius: 16px; margin: 0 auto 10px; background: #fff; }
    .gl-shadow__label { font-size: 0.75rem; font-weight: 600; text-align: center; color: var(--text-primary); margin-bottom: 4px; }
    .gl-shadow__css { font-size: 0.6875rem; color: var(--text-muted); text-align: center; font-family: monospace; }

    @media (max-width: 768px) {
      .gl-type-row { flex-direction: column; gap: 8px; }
      .gl-type-meta { width: 100%; }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="gl-header">
    <div class="container">
      <span class="gl-header__label">Design System</span>
      <h1 class="gl-header__title"><span>nidex</span> Guideline</h1>
      <p class="gl-header__desc">
        Referência visual completa — cores, tipografia, componentes, espaçamentos e padrões de uso para o site Nidex.
      </p>
    </div>
  </div>

  <div class="container" style="padding-bottom: 96px;">

    <!-- ── CORES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Cores</h2>
      <div class="gl-swatches">
        <?php
        $colors = [
          ['--primary',       '#2563EB', 'primary',       'Botões, links, destaques'],
          ['--primary-dark',  '#1D4ED8', 'primary-dark',  'Hover de botões'],
          ['--accent',        '#38BDF8', 'accent',        'Destaques em headlines'],
          ['--bg-dark',       '#0F172A', 'bg-dark',       'Fundo seções escuras'],
          ['--bg-dark-2',     '#1E293B', 'bg-dark-2',     'Cards em fundo escuro'],
          ['--bg-light',      '#F8FAFC', 'bg-light',      'Fundo seções claras'],
          ['--bg-white',      '#FFFFFF', 'bg-white',      'Cards, navbar, footer'],
          ['--text-primary',  '#0F172A', 'text-primary',  'Texto principal'],
          ['--text-muted',    '#64748B', 'text-muted',    'Subtítulos, secundário'],
          ['--border',        '#E2E8F0', 'border',        'Bordas de cards'],
        ];
        foreach ($colors as $c): ?>
        <div class="gl-swatch">
          <div class="gl-swatch__color" style="background:<?= $c[1] ?>"></div>
          <div class="gl-swatch__info">
            <span class="gl-swatch__name"><?= $c[2] ?></span>
            <span class="gl-swatch__hex"><?= $c[1] ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Border Dark variant -->
      <div style="background:var(--bg-dark);border-radius:12px;padding:20px;display:flex;align-items:center;gap:16px;">
        <div style="width:56px;height:40px;border-radius:8px;border:1px solid rgba(255,255,255,0.08)"></div>
        <div>
          <div style="color:#fff;font-size:0.875rem;font-weight:600">Border Dark</div>
          <code style="color:rgba(255,255,255,0.4);font-size:0.75rem">rgba(255,255,255,0.08)</code>
        </div>
      </div>
    </section>

    <!-- ── GRADIENTES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Gradientes</h2>
      <div class="gl-gradients">
        <div class="gl-gradient">
          <div class="gl-gradient__preview gradient-primary">
            <span style="color:#fff;font-size:0.875rem;font-weight:600">Gradiente Principal</span>
          </div>
          <div class="gl-gradient__info">
            <div class="gl-gradient__name">Gradiente Principal — Botões CTA</div>
            <div class="gl-gradient__css">linear-gradient(135deg, #2563EB, #1D4ED8)</div>
            <div class="gl-gradient__class">.gradient-primary</div>
          </div>
        </div>
        <div class="gl-gradient">
          <div class="gl-gradient__preview gradient-dark">
            <span style="color:rgba(255,255,255,0.7);font-size:0.875rem;font-weight:600">Gradiente Dark</span>
          </div>
          <div class="gl-gradient__info">
            <div class="gl-gradient__name">Gradiente Dark — Seções escuras</div>
            <div class="gl-gradient__css">linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%)</div>
            <div class="gl-gradient__class">.gradient-dark</div>
          </div>
        </div>
        <div class="gl-gradient">
          <div class="gl-gradient__preview" style="background:var(--bg-dark)">
            <span class="text-gradient" style="font-size:2rem;font-weight:800">destaque</span>
          </div>
          <div class="gl-gradient__info">
            <div class="gl-gradient__name">Text Gradient — Destaques tipográficos</div>
            <div class="gl-gradient__css">linear-gradient(135deg, #2563EB, #38BDF8)</div>
            <div class="gl-gradient__class">.text-gradient</div>
          </div>
        </div>
        <div class="gl-gradient">
          <div class="gl-gradient__preview" style="background:linear-gradient(to bottom, rgba(15,23,42,0.72), rgba(15,23,42,0.88)); background-color:#475569;">
            <span style="color:rgba(255,255,255,0.7);font-size:0.875rem;font-weight:600">Hero Overlay</span>
          </div>
          <div class="gl-gradient__info">
            <div class="gl-gradient__name">Hero Overlay — Sobre foto de fundo</div>
            <div class="gl-gradient__css">linear-gradient(to bottom, rgba(15,23,42,.72), rgba(15,23,42,.88))</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── TIPOGRAFIA ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Tipografia</h2>
      <p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:24px">Fonte: <strong>Inter</strong> — 400, 500, 600, 700, 800</p>

      <div style="margin-bottom:40px">
        <?php
        $types = [
          ['Display / Hero', '4–5rem · 800', 'Um ecossistema inteligente', 'font-size:clamp(2.5rem,5vw,4rem);font-weight:800;line-height:1.07;color:#0F172A'],
          ['Headline Grande (H1)', '3.5–5rem · 700–800', 'Gerencie tudo.', 'font-size:2.5rem;font-weight:800;line-height:1.1;color:#0F172A'],
          ['Headline Médio (H2)', '2–2.75rem · 700', 'Tudo que você precisa.', 'font-size:1.875rem;font-weight:700;color:#0F172A'],
          ['Headline Pequeno (H3)', '1.25–1.5rem · 700', 'CRM Inteligente', 'font-size:1.25rem;font-weight:700;color:#0F172A'],
          ['Corpo', '1–1.125rem · 400', 'Acompanhe cada cliente do primeiro contato ao fechamento. Pipeline visual com automações.', 'font-size:1rem;font-weight:400;line-height:1.75;color:#64748B'],
          ['Label de Seção', '0.75rem · 600 · uppercase', 'FUNCIONALIDADES', 'font-size:0.75rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#2563EB'],
          ['Small / Caption', '0.875rem · 400', 'Sem cartão de crédito · Cancele quando quiser', 'font-size:0.875rem;color:#94A3B8'],
        ];
        foreach ($types as $t): ?>
        <div class="gl-type-row">
          <div class="gl-type-meta">
            <div class="gl-type-meta__name"><?= $t[0] ?></div>
            <div class="gl-type-meta__spec"><?= $t[1] ?></div>
          </div>
          <div style="flex:1;<?= $t[3] ?>"><?= $t[2] ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div style="background:var(--bg-light);border:1px solid var(--border);border-radius:16px;padding:32px">
        <div style="font-size:0.875rem;font-weight:600;color:var(--text-primary);margin-bottom:16px">Destaque em headline</div>
        <h2 style="font-size:2rem;font-weight:700;line-height:1.2;color:#0F172A">
          Tudo que você precisa.
          <span style="color:var(--accent)">Nada que você não precisa.</span>
        </h2>
        <p style="font-size:0.8125rem;color:var(--text-muted);margin-top:12px">Palavra-chave em <code>var(--accent)</code> (#38BDF8) em fundos escuros, ou <code>var(--primary)</code> (#2563EB) em fundos claros</p>
      </div>
    </section>

    <!-- ── BOTÕES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Botões</h2>

      <div class="gl-buttons gl-buttons--light" style="margin-bottom:12px">
        <a href="#" class="btn btn--primary">Primário</a>
        <a href="#" class="btn btn--outline">Outline</a>
        <a href="#" class="btn btn--primary btn--lg">Primário Large</a>
        <a href="#" class="btn btn--outline btn--lg">Outline Large</a>
      </div>

      <div class="gl-buttons gl-buttons--dark">
        <a href="#" class="btn btn--ghost">Ghost (dark bg)</a>
        <a href="#" class="btn btn--ghost btn--lg">Ghost Large</a>
        <a href="#" class="btn btn--white">White</a>
      </div>

      <div style="margin-top:24px">
        <table class="gl-tokens">
          <tr><th>Propriedade</th><th>Valor</th><th>Notas</th></tr>
          <tr><td>border-radius</td><td>10px</td><td>Todos os botões</td></tr>
          <tr><td>padding (default)</td><td>12px 24px</td><td>.btn</td></tr>
          <tr><td>padding (large)</td><td>15px 28px</td><td>.btn--lg</td></tr>
          <tr><td>font-weight</td><td>600</td><td>Todos os botões</td></tr>
          <tr><td>font-size</td><td>0.9375rem</td><td>Default · 1rem no --lg</td></tr>
          <tr><td>transition</td><td>all 0.2s ease</td><td></td></tr>
          <tr><td>hover (primary)</td><td>background #1D4ED8 + translateY(-1px)</td><td></td></tr>
        </table>
      </div>
    </section>

    <!-- ── CARDS ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Cards</h2>
      <div class="gl-cards">
        <!-- Light card -->
        <div style="background:#fff;border:1px solid var(--border);border-radius:16px;padding:32px;box-shadow:0 4px 24px rgba(0,0,0,0.06)">
          <div style="width:44px;height:44px;border-radius:12px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;margin-bottom:20px">
            <div style="width:20px;height:20px;background:var(--primary);border-radius:5px"></div>
          </div>
          <h3 style="font-size:1.25rem;font-weight:700;color:var(--text-primary);margin-bottom:12px">Card Light</h3>
          <p style="font-size:0.9375rem;color:var(--text-muted);line-height:1.7">Fundo branco, borda #E2E8F0, sombra suave. Usado em seções claras (#F8FAFC / #FFFFFF).</p>
        </div>
        <!-- Dark card -->
        <div style="background:#1E293B;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:32px">
          <div style="width:44px;height:44px;border-radius:12px;background:rgba(37,99,235,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:20px">
            <div style="width:20px;height:20px;background:var(--accent);border-radius:5px"></div>
          </div>
          <h3 style="font-size:1.25rem;font-weight:700;color:#fff;margin-bottom:12px">Card Dark</h3>
          <p style="font-size:0.9375rem;color:rgba(255,255,255,0.5);line-height:1.7">Fundo #1E293B, borda rgba(255,255,255,0.08). Usado em seções escuras (#0F172A).</p>
        </div>
      </div>

      <div style="margin-top:24px">
        <table class="gl-tokens">
          <tr><th>Propriedade</th><th>Valor</th></tr>
          <tr><td>border-radius</td><td>12–16px (rounded-xl / 2xl)</td></tr>
          <tr><td>padding</td><td>24–32px</td></tr>
          <tr><td>shadow (light)</td><td>0 4px 24px rgba(0,0,0,0.06)</td></tr>
          <tr><td>shadow (dark)</td><td>0 4px 24px rgba(0,0,0,0.2)</td></tr>
          <tr><td>border (light)</td><td>1px solid #E2E8F0</td></tr>
          <tr><td>border (dark)</td><td>1px solid rgba(255,255,255,0.08)</td></tr>
        </table>
      </div>
    </section>

    <!-- ── HEADER DE SEÇÃO ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Header de Seção</h2>
      <div style="background:var(--bg-light);border:1px solid var(--border);border-radius:16px;padding:48px;text-align:center;margin-bottom:16px">
        <span class="section-label">Label de seção</span>
        <h2 class="section-title">
          Título principal da seção.<br />
          <span class="text-primary">Com palavra em destaque.</span>
        </h2>
        <p class="section-desc">Subtítulo opcional com no máximo 2 linhas.</p>
      </div>
      <div style="background:var(--bg-dark);border-radius:16px;padding:48px;text-align:center">
        <span class="section-label section-label--accent">Label de seção (dark)</span>
        <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:700;line-height:1.2;color:#fff;margin-bottom:16px">
          Título principal da seção.<br />
          <span class="text-accent">Com palavra em destaque.</span>
        </h2>
        <p style="font-size:1.0625rem;color:rgba(255,255,255,0.5)">Em fundos escuros o accent muda para #38BDF8.</p>
      </div>
    </section>

    <!-- ── PADRÃO DE SEÇÕES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Padrão de Seções</h2>
      <div class="gl-section-pattern" style="margin-bottom:24px">
        <?php
        $sectionPattern = [
          ['#0F172A', 'bg-dark',    'Hero'],
          ['#F8FAFC', 'bg-light',   'Problem'],
          ['#0F172A', 'bg-dark',    'Modules'],
          ['#1E3A8A', 'gradient-dark', 'AI Section'],
          ['#0F172A', 'bg-dark',    'Mobile Section'],
          ['#F8FAFC', 'bg-light',   'Why Nidex'],
          ['#FFFFFF', 'bg-white',   'FAQ'],
          ['#F8FAFC', 'bg-light',   'Pricing'],
          ['#0F172A', 'bg-dark',    'Footer'],
        ];
        foreach ($sectionPattern as $s): ?>
        <div class="gl-sp-row">
          <div class="gl-sp-dot" style="background:<?= $s[0] ?>;border-color:<?= $s[0] === '#FFFFFF' ? '#E2E8F0' : $s[0] ?>"></div>
          <span style="font-size:0.8125rem;color:var(--text-muted);width:100px"><?= $s[1] ?></span>
          <span style="font-size:0.8125rem;font-weight:600;color:var(--text-primary)"><?= $s[2] ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <table class="gl-tokens">
        <tr><th>Propriedade</th><th>Valor</th></tr>
        <tr><td>padding-y</td><td>96px (section) / 80–120px</td></tr>
        <tr><td>container max-width</td><td>1200px</td></tr>
        <tr><td>container padding</td><td>0 24px</td></tr>
      </table>
    </section>

    <!-- ── ESPAÇAMENTOS ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Espaçamentos</h2>
      <div class="gl-spacing">
        <?php
        $spaces = [4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 80, 96];
        foreach ($spaces as $s): ?>
        <div class="gl-spacing__item">
          <div class="gl-spacing__box" style="height:<?= min($s, 80) ?>px"></div>
          <span class="gl-spacing__label"><?= $s ?>px</span>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ── BORDER RADIUS ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Border Radius</h2>
      <div class="gl-radii">
        <?php
        $radii = [
          ['sm', '8px', 'Botões'],
          ['md', '10px', 'Botões (atual)'],
          ['lg', '12px', 'Ícones, badges'],
          ['xl', '16px', 'Cards'],
          ['2xl', '20px', 'Module cards'],
          ['pill', '999px', 'Badges, pills'],
        ];
        foreach ($radii as $r): ?>
        <div class="gl-radius__item">
          <div class="gl-radius__box" style="border-radius:<?= $r[1] ?>"></div>
          <div class="gl-radius__label"><?= $r[0] ?></div>
          <div class="gl-radius__value"><?= $r[1] ?></div>
          <div class="gl-radius__value"><?= $r[2] ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ── SOMBRAS ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Sombras</h2>
      <div class="gl-shadows">
        <?php
        $shadows = [
          ['Card Light', '0 4px 24px rgba(0,0,0,0.06)'],
          ['Card Dark',  '0 4px 24px rgba(0,0,0,0.2)'],
          ['Hero/Mockup','0 32px 80px rgba(0,0,0,0.5)'],
          ['Button Hover','0 8px 24px rgba(37,99,235,0.3)'],
        ];
        foreach ($shadows as $s): ?>
        <div>
          <div class="gl-shadow__box" style="box-shadow:<?= $s[1] ?>"></div>
          <div class="gl-shadow__label"><?= $s[0] ?></div>
          <div class="gl-shadow__css"><?= substr($s[1], 0, 30) ?>…</div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ── ANIMAÇÕES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">Animações</h2>
      <div class="gl-code">
        <pre>/* Scroll reveal — classe .reveal + IntersectionObserver */
.reveal {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Delay para stagger de elementos irmãos */
/* Calculado dinamicamente em script.js: idx * 80ms */

/* Pulse — badge / status dot */
@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: 0.6; transform: scale(0.85); }
}</pre>
      </div>
      <div style="margin-top:16px">
        <table class="gl-tokens">
          <tr><th>Propriedade</th><th>Valor</th></tr>
          <tr><td>opacity</td><td>0 → 1</td></tr>
          <tr><td>translateY</td><td>24px → 0</td></tr>
          <tr><td>duration</td><td>0.5s</td></tr>
          <tr><td>ease</td><td>ease</td></tr>
          <tr><td>stagger (irmãos)</td><td>idx × 80ms</td></tr>
        </table>
      </div>
    </section>

    <!-- ── CSS VARIABLES ── -->
    <section class="gl-section">
      <h2 class="gl-section__title">CSS Variables (style.css)</h2>
      <div class="gl-code">
        <pre>:root {
  --primary:      #2563EB;   /* botões, links, destaques */
  --primary-dark: #1D4ED8;   /* hover de botões */
  --accent:       #38BDF8;   /* destaques em headlines (dark bg) */
  --bg-dark:      #0F172A;   /* fundo seções escuras */
  --bg-light:     #F8FAFC;   /* fundo seções claras */
  --text-primary: #0F172A;   /* texto principal */
  --text-muted:   #64748B;   /* subtítulos, secundário */
  --border:       #E2E8F0;   /* bordas de cards e divisores */
}

/* Utility classes */
.gradient-primary  { background: linear-gradient(135deg, #2563EB, #1D4ED8); }
.gradient-dark     { background: linear-gradient(135deg, #0F172A, #1E3A8A); }
.text-gradient     { background: linear-gradient(135deg, #2563EB, #38BDF8);
                     -webkit-background-clip: text;
                     -webkit-text-fill-color: transparent; }
.text-primary      { color: var(--primary); }
.text-accent       { color: var(--accent); }
.section-label     { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.1em;
                     text-transform: uppercase; color: var(--primary); }
.section--dark     { background: var(--bg-dark); }
.section--light    { background: var(--bg-light); }
.section--white    { background: #fff; }</pre>
      </div>
    </section>

    <!-- Footer -->
    <div style="border-top:1px solid var(--border);padding-top:32px;text-align:center">
      <p style="color:var(--text-muted);font-size:0.875rem">
        <strong style="color:var(--primary)">nidex</strong> Design System — Atualizado em 2026
      </p>
    </div>

  </div><!-- /container -->

</body>
</html>
