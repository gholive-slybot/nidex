<?php
$page_title       = 'Nidex.Cowork — Ecossistema all-in-one para empreendedores';
$page_description = 'CRM, financeiro, cobranças, tarefas, projetos, agenda, relatórios e Agentes de IA embarcados em cada módulo. Conheça o Nidex.Cowork.';
require_once dirname(dirname(__DIR__)) . '/site/includes/head-page.php';
require_once dirname(dirname(__DIR__)) . '/site/includes/header.php';

/* Mock screen reutilizável — passar --mock-color via style */
function mock_screen(string $color, bool $dark = false): string {
  $cls = $dark ? ' mock-screen--dark' : '';
  return <<<HTML
<div class="mock-screen{$cls}" style="--mock-color:{$color}">
  <div class="mock-screen__chrome">
    <div class="mock-screen__dots"><span></span><span></span><span></span></div>
    <div class="mock-screen__urlbar"></div>
  </div>
  <div class="mock-screen__body">
    <div class="mock-screen__sidebar">
      <div class="mock-screen__sidebar-logo"></div>
      <div class="mock-screen__sidebar-item mock-screen__sidebar-item--active"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
    </div>
    <div class="mock-screen__main">
      <div class="mock-screen__topbar">
        <div class="mock-screen__topbar-title"></div>
        <div class="mock-screen__topbar-btn"></div>
      </div>
      <div class="mock-screen__cards">
        <div class="mock-screen__card">
          <div class="mock-screen__card-label"></div>
          <div class="mock-screen__card-value mock-screen__card-value--accent"></div>
        </div>
        <div class="mock-screen__card">
          <div class="mock-screen__card-label"></div>
          <div class="mock-screen__card-value"></div>
        </div>
        <div class="mock-screen__card">
          <div class="mock-screen__card-label"></div>
          <div class="mock-screen__card-value"></div>
        </div>
      </div>
      <div class="mock-screen__rows">
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
      </div>
    </div>
  </div>
</div>
HTML;
}
?>

<!-- HERO -->
<section class="suite-hero">
  <div class="suite-hero__grid"></div>
  <div class="suite-hero__glow suite-hero__glow--1"></div>
  <div class="suite-hero__glow suite-hero__glow--2"></div>
  <div class="container suite-hero__inner">
    <span class="suite-hero__label">Nidex.Cowork</span>
    <h1 class="suite-hero__title">
      O ecossistema completo.<br />
      <span class="text-gradient">Com Agentes de IA trabalhando por você.</span>
    </h1>
    <p class="suite-hero__desc">CRM, financeiro, cobranças, tarefas, projetos, agenda — com <strong>Agentes de IA embarcados em cada módulo</strong>. Tudo integrado, sem planilha, sem dor de cabeça.</p>
    <div class="suite-hero__pills">
      <a href="#crm"        class="suite-pill"><span class="suite-pill__dot" style="background:#2563EB"></span>CRM</a>
      <a href="#financeiro" class="suite-pill"><span class="suite-pill__dot" style="background:#16A34A"></span>Financeiro</a>
      <a href="#cobrancas"  class="suite-pill"><span class="suite-pill__dot" style="background:#EA580C"></span>Cobranças</a>
      <a href="#tarefas"    class="suite-pill"><span class="suite-pill__dot" style="background:#9333EA"></span>Tarefas</a>
      <a href="#projetos"   class="suite-pill"><span class="suite-pill__dot" style="background:#0284C7"></span>Projetos</a>
      <a href="#agenda"     class="suite-pill"><span class="suite-pill__dot" style="background:#E11D48"></span>Agenda</a>
      <a href="#relatorios" class="suite-pill"><span class="suite-pill__dot" style="background:#D97706"></span>Relatórios</a>
      <a href="#ia"         class="suite-pill"><span class="suite-pill__dot" style="background:#38BDF8"></span>Agentes de IA</a>
    </div>
  </div>
</section>

<!-- 01 CRM -->
<div id="crm" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#2563EB') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#EFF6FF;color:#2563EB;border:1px solid #DBEAFE">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          CRM & Clientes
        </div>
        <h2 class="suite-block__title">Seu pipeline de vendas.<br /><span class="text-primary">Organizado e vivo.</span></h2>
        <p class="suite-block__desc">Gerencie clientes, leads e oportunidades em um funil visual e intuitivo. Do primeiro contato ao fechamento, tudo em um só lugar — sem planilha, sem pós-it.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Pipeline Kanban com arrastar e soltar</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Histórico completo de interações por cliente</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Score de lead e alertas automáticos</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Integração com WhatsApp e e-mail</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 02 FINANCEIRO -->
<div id="financeiro" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#16A34A') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#F0FDF4;color:#16A34A;border:1px solid #BBF7D0">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Financeiro
        </div>
        <h2 class="suite-block__title">Saiba para onde vai<br /><span style="color:#16A34A">cada centavo.</span></h2>
        <p class="suite-block__desc">Controle de caixa, DRE, contas a pagar e receber — tudo atualizado em tempo real. Tome decisões com dados, não com chute.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Fluxo de caixa com previsão automática</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>DRE (Demonstrativo de Resultados) em tempo real</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Categorização automática de lançamentos</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Conciliação bancária integrada</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 03 COBRANÇAS -->
<div id="cobrancas" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#EA580C') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#FFF7ED;color:#EA580C;border:1px solid #FED7AA">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          Cobranças
        </div>
        <h2 class="suite-block__title">Receba em dia.<br /><span style="color:#EA580C">Sem constrangimento.</span></h2>
        <p class="suite-block__desc">Emita boletos, configure recorrência e automatize a régua de cobrança. O sistema faz o trabalho chato — você foca em crescer.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Boleto, PIX e cartão em um só lugar</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Régua de cobrança automática com WhatsApp e e-mail</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Assinaturas e cobrança recorrente</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Link de pagamento com checkout personalizado</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 04 TAREFAS -->
<div id="tarefas" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#9333EA') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#FDF4FF;color:#9333EA;border:1px solid #E9D5FF">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          Tarefas
        </div>
        <h2 class="suite-block__title">Sua equipe sabe<br /><span style="color:#9333EA">o que fazer agora.</span></h2>
        <p class="suite-block__desc">Organize tarefas individuais e de equipe com prioridades, prazos e responsáveis. Nada cai no esquecimento — tudo tem dono e data.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Tarefas com subtarefas, checklists e anexos</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Prioridades, tags e filtros avançados</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Notificações automáticas por prazo</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Integrado com Projetos, Agenda e CRM</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 05 PROJETOS -->
<div id="projetos" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#0284C7') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#F0F9FF;color:#0284C7;border:1px solid #BAE6FD">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          Projetos
        </div>
        <h2 class="suite-block__title">Do início à entrega.<br /><span style="color:#0284C7">Tudo no trilho.</span></h2>
        <p class="suite-block__desc">Gerencie projetos inteiros com Kanban, cronograma e marcos. Sua equipe alinhada, seu cliente satisfeito — sem reunião desnecessária.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Kanban, lista e cronograma (Gantt) integrados</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Marcos e entregáveis com alertas automáticos</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Portal do cliente para acompanhamento externo</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Relatório de progresso gerado automaticamente</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 06 AGENDA -->
<div id="agenda" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#E11D48') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#FFF1F2;color:#E11D48;border:1px solid #FECDD3">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Agenda
        </div>
        <h2 class="suite-block__title">Sua agenda.<br /><span style="color:#E11D48">Conectada ao negócio.</span></h2>
        <p class="suite-block__desc">Reuniões, compromissos e lembretes integrados com CRM e tarefas. Cada evento vira uma ação — sem pós-it, sem anotação perdida.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Calendário integrado com Google e Outlook</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Link de agendamento público para clientes</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Lembretes automáticos por WhatsApp e e-mail</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Criação de tarefa automática após reunião</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 07 RELATÓRIOS -->
<div id="relatorios" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#D97706') ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:#FFFBEB;color:#D97706;border:1px solid #FDE68A">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
          Relatórios
        </div>
        <h2 class="suite-block__title">Dados que viram<br /><span style="color:#D97706">decisão.</span></h2>
        <p class="suite-block__desc">Dashboards em tempo real com os números que importam para o seu negócio — vendas, financeiro, produtividade e mais. Tudo visual, sem exportar planilha.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Dashboard unificado com todos os módulos</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Relatórios automáticos enviados por e-mail</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Metas e indicadores com alertas de desvio</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Exportação em PDF e Excel com um clique</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 08 AGENTES DE IA -->
<div id="ia" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--dark suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col">
      <?= mock_screen('#38BDF8', true) ?>
    </div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
<div class="suite-block__tag" style="background:rgba(56,189,248,0.1);color:#38BDF8;border:1px solid rgba(56,189,248,0.2)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
          Agentes de IA
        </div>
        <h2 class="suite-block__title suite-block--dark">Agentes trabalhando<br /><span class="text-accent">dentro do seu software.</span></h2>
        <p class="suite-block__desc suite-block--dark">Não é um chat separado. São Agentes de IA embarcados em cada módulo — executando tarefas, tomando decisões e gerando resultados de forma autônoma.</p>
        <ul class="suite-block__features suite-block--dark">
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Agente de vendas que age no CRM por você</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Agente financeiro com alertas e insights em tempo real</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Automações autônomas criadas por linguagem natural</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Relatórios gerados e interpretados por agentes</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
          <a href="/#ia" class="btn btn--ghost-dark">Ver Agentes na homepage</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="run-cta">
  <div class="run-cta__glow"></div>
  <div class="container run-cta__inner reveal">
    <span class="section-label section-label--accent">Comece hoje</span>
    <h2 class="run-cta__title">Tudo isso em<br /><span class="text-accent">um único lugar.</span></h2>
    <p class="run-cta__desc">Experimente o Nidex.Cowork gratuitamente e veja como é simples ter tudo integrado — com Agentes de IA trabalhando por você.</p>
    <div class="run-cta__actions">
      <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      <a href="/run" class="btn btn--ghost-dark">Conhecer o Nidex.Run</a>
    </div>
  </div>
</section>

<?php require_once dirname(dirname(__DIR__)) . '/site/includes/footer.php'; ?>
