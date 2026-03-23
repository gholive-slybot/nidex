<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

requireLogin();

$pdo = getDB();
$csrf = csrfToken();

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfVerify($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Token inválido. Tente novamente.'];
        header('Location: /cms/leads.php');
        exit;
    }

    $action = $_POST['action'] ?? '';
    $id     = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        if ($action === 'status') {
            $newStatus = $_POST['new_status'] ?? '';
            if (in_array($newStatus, ['new', 'read', 'contacted'], true)) {
                $stmt = $pdo->prepare("UPDATE contacts SET status = ? WHERE id = ?");
                $stmt->execute([$newStatus, $id]);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Status atualizado.'];
            }
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Lead removido.'];
        }
    }

    header('Location: /cms/leads.php' . (isset($_GET['filter']) ? '?filter=' . urlencode($_GET['filter']) : ''));
    exit;
}

// Filter
$filter      = $_GET['filter'] ?? 'all';
$validFilters = ['all', 'new', 'read', 'contacted'];
if (!in_array($filter, $validFilters, true)) {
    $filter = 'all';
}

$whereClause = $filter === 'all' ? '' : "WHERE status = " . $pdo->quote($filter);
$leads = $pdo->query(
    "SELECT id, name, email, phone, status, created_at FROM contacts $whereClause ORDER BY created_at DESC"
)->fetchAll();

$counts = [];
foreach (['all', 'new', 'read', 'contacted'] as $f) {
    $w = $f === 'all' ? '' : "WHERE status = " . $pdo->quote($f);
    $counts[$f] = (int) $pdo->query("SELECT COUNT(*) FROM contacts $w")->fetchColumn();
}

// Flash
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

adminHeader('Leads', 'leads');
?>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
  <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<div class="page-header">
  <div>
    <h1 class="page-header__title">Leads</h1>
    <p class="page-header__desc">Gerencie os contatos recebidos pelo site.</p>
  </div>
</div>

<!-- Filter Tabs -->
<div class="tabs">
  <a href="?filter=all"       class="tab <?= $filter === 'all'       ? 'active' : '' ?>">Todos <span style="font-size:0.75rem;opacity:0.7">(<?= $counts['all'] ?>)</span></a>
  <a href="?filter=new"       class="tab <?= $filter === 'new'       ? 'active' : '' ?>">Novos <span style="font-size:0.75rem;opacity:0.7">(<?= $counts['new'] ?>)</span></a>
  <a href="?filter=read"      class="tab <?= $filter === 'read'      ? 'active' : '' ?>">Lidos <span style="font-size:0.75rem;opacity:0.7">(<?= $counts['read'] ?>)</span></a>
  <a href="?filter=contacted" class="tab <?= $filter === 'contacted' ? 'active' : '' ?>">Contactados <span style="font-size:0.75rem;opacity:0.7">(<?= $counts['contacted'] ?>)</span></a>
</div>

<div class="table-wrap">
  <?php if (empty($leads)): ?>
  <div class="empty-state">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
    <p>Nenhum lead nesta categoria.</p>
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
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($leads as $lead): ?>
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
        <td>
          <div class="flex gap-2">
            <?php if ($lead['status'] !== 'read'): ?>
            <form method="POST" action="/cms/leads.php?filter=<?= urlencode($filter) ?>" style="display:inline">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="status">
              <input type="hidden" name="id" value="<?= $lead['id'] ?>">
              <input type="hidden" name="new_status" value="read">
              <button type="submit" class="btn btn-ghost btn-sm">Lido</button>
            </form>
            <?php endif; ?>
            <?php if ($lead['status'] !== 'contacted'): ?>
            <form method="POST" action="/cms/leads.php?filter=<?= urlencode($filter) ?>" style="display:inline">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="status">
              <input type="hidden" name="id" value="<?= $lead['id'] ?>">
              <input type="hidden" name="new_status" value="contacted">
              <button type="submit" class="btn btn-outline btn-sm">Contactado</button>
            </form>
            <?php endif; ?>
            <form method="POST" action="/cms/leads.php?filter=<?= urlencode($filter) ?>" style="display:inline" onsubmit="return confirm('Confirma a exclusão deste lead?')">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $lead['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</div>

<?php adminFooter(); ?>
