<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

requireLogin();

$pdo = getDB();

// Stats
$totalPublished = (int) $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'published'")->fetchColumn();
$totalDraft     = (int) $pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'draft'")->fetchColumn();
$totalLeads     = (int) $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$newLeadsToday  = (int) $pdo->query("SELECT COUNT(*) FROM contacts WHERE DATE(created_at) = CURDATE()")->fetchColumn();

// Recent leads (last 10)
$recentLeads = $pdo->query(
    "SELECT id, name, email, phone, status, created_at FROM contacts ORDER BY created_at DESC LIMIT 10"
)->fetchAll();

// Flash message
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

adminHeader('Dashboard', 'dashboard');
?>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
  <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<!-- Page Header -->
<div class="page-header">
  <div>
    <h1 class="page-header__title">Visão geral</h1>
    <p class="page-header__desc">Bem-vindo de volta, <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>!</p>
  </div>
  <div class="flex gap-2">
    <a href="/cms/post-form.php" class="btn btn-primary">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Novo Post
    </a>
    <a href="/cms/leads.php" class="btn btn-outline">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
      Ver Leads
    </a>
  </div>
</div>

<!-- Stats -->
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-card__icon icon-green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    </div>
    <div class="stat-card__label">Posts Publicados</div>
    <div class="stat-card__value"><?= $totalPublished ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon icon-yellow">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    </div>
    <div class="stat-card__label">Posts em Rascunho</div>
    <div class="stat-card__value"><?= $totalDraft ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon icon-blue">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-card__label">Total de Leads</div>
    <div class="stat-card__value"><?= $totalLeads ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon icon-red">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
    </div>
    <div class="stat-card__label">Novos Leads Hoje</div>
    <div class="stat-card__value"><?= $newLeadsToday ?></div>
  </div>
</div>

<!-- Recent Leads -->
<div class="section-head">
  <div>
    <div class="section-title">Leads recentes</div>
    <div class="section-subtitle">Últimos 10 contatos recebidos</div>
  </div>
  <a href="/cms/leads.php" class="btn btn-ghost btn-sm">Ver todos →</a>
</div>

<div class="table-wrap">
  <?php if (empty($recentLeads)): ?>
  <div class="empty-state">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
    <p>Nenhum lead ainda.</p>
  </div>
  <?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Status</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($recentLeads as $lead): ?>
      <tr>
        <td><strong><?= htmlspecialchars($lead['name']) ?></strong></td>
        <td><?= htmlspecialchars($lead['email']) ?></td>
        <td><?= htmlspecialchars($lead['phone']) ?></td>
        <td>
          <?php
          $badgeClass = match($lead['status']) {
              'new'       => 'badge-blue',
              'read'      => 'badge-yellow',
              'contacted' => 'badge-green',
              default     => 'badge-gray',
          };
          $badgeLabel = match($lead['status']) {
              'new'       => 'Novo',
              'read'      => 'Lido',
              'contacted' => 'Contactado',
              default     => $lead['status'],
          };
          ?>
          <span class="badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
        </td>
        <td class="text-muted"><?= date('d/m/Y H:i', strtotime($lead['created_at'])) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</div>

<?php adminFooter(); ?>
