<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

requireLogin();

$pdo  = getDB();
$csrf = csrfToken();

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfVerify($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Token inválido.'];
        header('Location: /cms/posts.php');
        exit;
    }

    $action = $_POST['action'] ?? '';
    $id     = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        if ($action === 'delete') {
            // Delete cover image if exists
            $stmt = $pdo->prepare("SELECT cover_image FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            $post = $stmt->fetch();
            if ($post && $post['cover_image']) {
                $filePath = dirname(__DIR__) . $post['cover_image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Post excluído.'];

        } elseif ($action === 'toggle_status') {
            $stmt = $pdo->prepare("SELECT status FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            $current = $stmt->fetchColumn();
            $newStatus = $current === 'published' ? 'draft' : 'published';
            $publishedAt = $newStatus === 'published' ? date('Y-m-d H:i:s') : null;

            $stmt = $pdo->prepare("UPDATE posts SET status = ?, published_at = ? WHERE id = ?");
            $stmt->execute([$newStatus, $publishedAt, $id]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Status do post atualizado.'];
        }
    }

    header('Location: /cms/posts.php');
    exit;
}

// Fetch posts with category
$posts = $pdo->query(
    "SELECT p.id, p.title, p.slug, p.cover_image, p.status, p.published_at, p.created_at,
            c.name AS category_name
     FROM posts p
     LEFT JOIN categories c ON c.id = p.category_id
     ORDER BY p.created_at DESC"
)->fetchAll();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

adminHeader('Posts', 'posts');
?>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
  <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<div class="page-header">
  <div>
    <h1 class="page-header__title">Posts</h1>
    <p class="page-header__desc">Gerencie os artigos do blog.</p>
  </div>
  <a href="/cms/post-form.php" class="btn btn-primary">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Novo Post
  </a>
</div>

<div class="table-wrap">
  <?php if (empty($posts)): ?>
  <div class="empty-state">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    <p>Nenhum post ainda. <a href="/cms/post-form.php" style="color:#2563EB">Criar o primeiro →</a></p>
  </div>
  <?php else: ?>
  <table>
    <thead>
      <tr>
        <th style="width:60px">Capa</th>
        <th>Título</th>
        <th>Categoria</th>
        <th>Status</th>
        <th>Publicado em</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post): ?>
      <tr>
        <td>
          <?php if ($post['cover_image']): ?>
          <img src="<?= htmlspecialchars($post['cover_image']) ?>" alt="" class="thumb" />
          <?php else: ?>
          <div class="thumb-empty">img</div>
          <?php endif; ?>
        </td>
        <td>
          <strong><?= htmlspecialchars($post['title']) ?></strong>
          <div style="font-size:0.75rem;color:#94A3B8;margin-top:2px">/<?= htmlspecialchars($post['slug']) ?></div>
        </td>
        <td><?= $post['category_name'] ? htmlspecialchars($post['category_name']) : '<span class="text-muted">—</span>' ?></td>
        <td>
          <?php if ($post['status'] === 'published'): ?>
          <span class="badge badge-green">Publicado</span>
          <?php else: ?>
          <span class="badge badge-gray">Rascunho</span>
          <?php endif; ?>
        </td>
        <td class="text-muted">
          <?= $post['published_at'] ? date('d/m/Y', strtotime($post['published_at'])) : '—' ?>
        </td>
        <td>
          <div class="flex gap-2">
            <a href="/cms/post-form.php?id=<?= $post['id'] ?>" class="btn btn-ghost btn-sm">Editar</a>

            <form method="POST" action="/cms/posts.php" style="display:inline">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="toggle_status">
              <input type="hidden" name="id" value="<?= $post['id'] ?>">
              <button type="submit" class="btn btn-outline btn-sm">
                <?= $post['status'] === 'published' ? 'Despublicar' : 'Publicar' ?>
              </button>
            </form>

            <form method="POST" action="/cms/posts.php" style="display:inline" onsubmit="return confirm('Tem certeza que deseja excluir este post?')">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $post['id'] ?>">
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
