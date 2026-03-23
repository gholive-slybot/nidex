<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

requireLogin();

$pdo  = getDB();
$csrf = csrfToken();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfVerify($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Token inválido.'];
        header('Location: /cms/categories.php');
        exit;
    }

    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');

        if (strlen($name) < 2) {
            $errors[] = 'Nome é obrigatório (mínimo 2 caracteres).';
        }
        if (strlen($slug) < 2) {
            $errors[] = 'Slug é obrigatório.';
        }

        if (empty($errors)) {
            // Check unique slug
            $stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
            $stmt->execute([$slug]);
            if ($stmt->fetch()) {
                $errors[] = 'Já existe uma categoria com este slug.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
                $stmt->execute([$name, $slug]);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Categoria criada com sucesso.'];
                header('Location: /cms/categories.php');
                exit;
            }
        }

    } elseif ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            // Check if has posts
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE category_id = ?");
            $stmt->execute([$id]);
            $count = (int) $stmt->fetchColumn();

            if ($count > 0) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => "Não é possível excluir: esta categoria tem {$count} post(s) associado(s)."
                ];
            } else {
                $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
                $stmt->execute([$id]);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Categoria excluída.'];
            }
        }
        header('Location: /cms/categories.php');
        exit;
    }
}

$categories = $pdo->query(
    "SELECT c.id, c.name, c.slug, c.created_at, COUNT(p.id) AS post_count
     FROM categories c
     LEFT JOIN posts p ON p.category_id = c.id
     GROUP BY c.id
     ORDER BY c.name ASC"
)->fetchAll();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Preserve form values on error
$formName = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$formSlug = isset($_POST['slug']) ? htmlspecialchars($_POST['slug']) : '';

adminHeader('Categorias', 'categories');
?>

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
  <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<div class="page-header">
  <div>
    <h1 class="page-header__title">Categorias</h1>
    <p class="page-header__desc">Organize os posts por categorias.</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 360px;gap:24px;align-items:start">

  <!-- Categories Table -->
  <div class="table-wrap">
    <?php if (empty($categories)): ?>
    <div class="empty-state">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
      <p>Nenhuma categoria ainda.</p>
    </div>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Slug</th>
          <th>Posts</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
          <td><strong><?= htmlspecialchars($cat['name']) ?></strong></td>
          <td style="font-family:monospace;font-size:0.8125rem;color:#64748B"><?= htmlspecialchars($cat['slug']) ?></td>
          <td>
            <span class="badge badge-blue"><?= $cat['post_count'] ?> post<?= $cat['post_count'] != 1 ? 's' : '' ?></span>
          </td>
          <td>
            <form method="POST" action="/cms/categories.php" style="display:inline"
              onsubmit="return confirm('Excluir a categoria \'<?= htmlspecialchars(addslashes($cat['name'])) ?>\'?')">
              <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $cat['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>

  <!-- Add Category Form -->
  <div class="form-card">
    <div style="font-size:0.9375rem;font-weight:700;color:#0F172A;margin-bottom:16px">Nova categoria</div>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-error" style="margin-bottom:16px">
      <?php foreach ($errors as $e): ?>
      <div><?= htmlspecialchars($e) ?></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="/cms/categories.php">
      <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
      <input type="hidden" name="action" value="add">
      <div class="form-group">
        <label class="form-label" for="catName">Nome *</label>
        <input
          class="form-input"
          type="text"
          id="catName"
          name="name"
          value="<?= $formName ?>"
          placeholder="Ex: Marketing Digital"
          autocomplete="off"
          required
        />
      </div>
      <div class="form-group">
        <label class="form-label" for="catSlug">Slug</label>
        <input
          class="form-input"
          type="text"
          id="catSlug"
          name="slug"
          value="<?= $formSlug ?>"
          placeholder="marketing-digital"
          style="font-family:monospace;font-size:0.8125rem"
          autocomplete="off"
        />
        <div style="font-size:0.75rem;color:#94A3B8;margin-top:4px">Gerado automaticamente a partir do nome.</div>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Criar categoria
      </button>
    </form>
  </div>

</div>

<script>
function toSlug(str) {
  return str
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
}

const catName = document.getElementById('catName');
const catSlug = document.getElementById('catSlug');
let slugTouched = <?= $formSlug !== '' ? 'true' : 'false' ?>;

catName.addEventListener('input', function() {
  if (!slugTouched) {
    catSlug.value = toSlug(this.value);
  }
});

catSlug.addEventListener('input', function() {
  slugTouched = true;
});
</script>

<?php adminFooter(); ?>
