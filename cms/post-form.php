<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

requireLogin();

$pdo  = getDB();
$csrf = csrfToken();

$isEdit = isset($_GET['id']) && (int) $_GET['id'] > 0;
$postId = $isEdit ? (int) $_GET['id'] : 0;

$post = [
    'title'        => '',
    'slug'         => '',
    'excerpt'      => '',
    'content'      => '',
    'cover_image'  => '',
    'category_id'  => '',
    'status'       => 'draft',
    'published_at' => '',
];

$errors = [];

// Load existing post
if ($isEdit) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$postId]);
    $existing = $stmt->fetch();
    if (!$existing) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Post não encontrado.'];
        header('Location: /cms/posts.php');
        exit;
    }
    $post = array_merge($post, $existing);
    if ($post['published_at']) {
        $post['published_at'] = date('Y-m-d\TH:i', strtotime($post['published_at']));
    }
}

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfVerify($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Token de segurança inválido.';
    } else {
        $post['title']       = trim($_POST['title'] ?? '');
        $post['slug']        = trim($_POST['slug'] ?? '');
        $post['excerpt']     = trim($_POST['excerpt'] ?? '');
        $post['content']     = $_POST['content'] ?? '';
        $post['cover_image'] = trim($_POST['cover_image'] ?? '');
        $post['category_id'] = $_POST['category_id'] !== '' ? (int) $_POST['category_id'] : null;
        $post['status']      = in_array($_POST['status'] ?? '', ['draft', 'published']) ? $_POST['status'] : 'draft';
        $rawPublished        = trim($_POST['published_at'] ?? '');
        $post['published_at'] = $rawPublished;

        // Validate
        if (strlen($post['title']) < 2) {
            $errors[] = 'Título é obrigatório (mínimo 2 caracteres).';
        }
        if (strlen($post['slug']) < 2) {
            $errors[] = 'Slug é obrigatório.';
        }

        if (empty($errors)) {
            $publishedAt = null;
            if ($rawPublished) {
                $publishedAt = date('Y-m-d H:i:s', strtotime($rawPublished));
            } elseif ($post['status'] === 'published') {
                $publishedAt = date('Y-m-d H:i:s');
            }

            if ($isEdit) {
                $stmt = $pdo->prepare(
                    "UPDATE posts SET title=?, slug=?, excerpt=?, content=?, cover_image=?, category_id=?, status=?, published_at=? WHERE id=?"
                );
                $stmt->execute([
                    $post['title'], $post['slug'], $post['excerpt'], $post['content'],
                    $post['cover_image'] ?: null, $post['category_id'], $post['status'],
                    $publishedAt, $postId
                ]);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Post atualizado com sucesso.'];
            } else {
                $stmt = $pdo->prepare(
                    "INSERT INTO posts (title, slug, excerpt, content, cover_image, category_id, status, published_at) VALUES (?,?,?,?,?,?,?,?)"
                );
                $stmt->execute([
                    $post['title'], $post['slug'], $post['excerpt'], $post['content'],
                    $post['cover_image'] ?: null, $post['category_id'], $post['status'],
                    $publishedAt
                ]);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Post criado com sucesso.'];
            }

            header('Location: /cms/posts.php');
            exit;
        }
    }
}

// Categories
$categories = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC")->fetchAll();

$pageTitle = $isEdit ? 'Editar Post' : 'Novo Post';
adminHeader($pageTitle, 'posts');
?>

<?php if (!empty($errors)): ?>
<div class="alert alert-error">
  <?php foreach ($errors as $e): ?>
  <div><?= htmlspecialchars($e) ?></div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="page-header">
  <div>
    <h1 class="page-header__title"><?= $pageTitle ?></h1>
    <p class="page-header__desc"><?= $isEdit ? 'Atualize o conteúdo do post.' : 'Escreva um novo artigo para o blog.' ?></p>
  </div>
  <a href="/cms/posts.php" class="btn btn-ghost">← Voltar</a>
</div>

<form method="POST" action="/cms/post-form.php<?= $isEdit ? '?id=' . $postId : '' ?>" id="postForm">
  <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
  <input type="hidden" name="cover_image" id="coverImageInput" value="<?= htmlspecialchars($post['cover_image']) ?>">

  <div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start">

    <!-- Left Column -->
    <div>
      <!-- Title & Slug -->
      <div class="form-card" style="margin-bottom:20px">
        <div class="form-group">
          <label class="form-label" for="title">Título *</label>
          <input
            class="form-input"
            type="text"
            id="title"
            name="title"
            value="<?= htmlspecialchars($post['title']) ?>"
            placeholder="Título do post"
            required
          />
        </div>
        <div class="form-group mb-0">
          <label class="form-label" for="slug">Slug (URL)</label>
          <div style="display:flex;gap:8px">
            <input
              class="form-input"
              type="text"
              id="slug"
              name="slug"
              value="<?= htmlspecialchars($post['slug']) ?>"
              placeholder="url-do-post"
              style="font-family:monospace;font-size:0.8125rem"
            />
          </div>
          <div style="font-size:0.75rem;color:#94A3B8;margin-top:4px">site.com/post/<span id="slugPreview" style="color:#2563EB"><?= htmlspecialchars($post['slug']) ?></span></div>
        </div>
      </div>

      <!-- Excerpt -->
      <div class="form-card" style="margin-bottom:20px">
        <div class="form-group mb-0">
          <label class="form-label" for="excerpt">Resumo (excerpt)</label>
          <textarea
            class="form-textarea"
            id="excerpt"
            name="excerpt"
            maxlength="200"
            rows="3"
            placeholder="Breve descrição do post (máx. 200 caracteres)"
          ><?= htmlspecialchars($post['excerpt']) ?></textarea>
          <div style="font-size:0.75rem;color:#94A3B8;margin-top:4px"><span id="excerptCount"><?= strlen($post['excerpt']) ?></span>/200</div>
        </div>
      </div>

      <!-- Content (TinyMCE) -->
      <div class="form-card">
        <label class="form-label">Conteúdo</label>
        <textarea id="content" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
      </div>
    </div>

    <!-- Right Column -->
    <div>
      <!-- Publish Settings -->
      <div class="form-card" style="margin-bottom:20px">
        <div style="font-size:0.875rem;font-weight:700;color:#0F172A;margin-bottom:16px">Publicação</div>
        <div class="form-group">
          <label class="form-label" for="status">Status</label>
          <select class="form-select" id="status" name="status">
            <option value="draft"     <?= $post['status'] === 'draft'     ? 'selected' : '' ?>>Rascunho</option>
            <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Publicado</option>
          </select>
        </div>
        <div class="form-group mb-0">
          <label class="form-label" for="published_at">Data de publicação</label>
          <input
            class="form-input"
            type="datetime-local"
            id="published_at"
            name="published_at"
            value="<?= htmlspecialchars($post['published_at']) ?>"
          />
        </div>
      </div>

      <!-- Category -->
      <div class="form-card" style="margin-bottom:20px">
        <div class="form-group mb-0">
          <label class="form-label" for="category_id">Categoria</label>
          <select class="form-select" id="category_id" name="category_id">
            <option value="">Sem categoria</option>
            <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= (string)$post['category_id'] === (string)$cat['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['name']) ?>
            </option>
            <?php endforeach; ?>
          </select>
          <?php if (empty($categories)): ?>
          <div style="font-size:0.75rem;color:#94A3B8;margin-top:6px"><a href="/cms/categories.php" style="color:#2563EB">Criar uma categoria →</a></div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Cover Image -->
      <div class="form-card" style="margin-bottom:20px">
        <div style="font-size:0.875rem;font-weight:700;color:#0F172A;margin-bottom:12px">Imagem de capa</div>
        <div id="coverPreview" style="margin-bottom:12px;<?= !$post['cover_image'] ? 'display:none' : '' ?>">
          <img id="coverImg" src="<?= htmlspecialchars($post['cover_image']) ?>" alt="" style="width:100%;height:160px;object-fit:cover;border-radius:8px;border:1px solid #E2E8F0" />
          <button type="button" id="removeCover" class="btn btn-danger btn-sm" style="margin-top:8px;width:100%;justify-content:center">Remover imagem</button>
        </div>
        <div id="uploadArea">
          <label style="display:block;cursor:pointer;border:2px dashed #E2E8F0;border-radius:8px;padding:24px;text-align:center;transition:border-color 0.15s" id="uploadLabel">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5" style="margin:0 auto 8px"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <div style="font-size:0.8125rem;color:#64748B;font-weight:500">Clique para enviar</div>
            <div style="font-size:0.75rem;color:#94A3B8;margin-top:4px">JPG, PNG ou WebP · Máx 5MB</div>
            <input type="file" id="imageFile" accept="image/jpeg,image/png,image/webp" style="display:none" />
          </label>
          <div id="uploadProgress" style="display:none;font-size:0.8125rem;color:#2563EB;text-align:center;padding:8px">Enviando...</div>
          <div id="uploadError" style="display:none;font-size:0.8125rem;color:#DC2626;text-align:center;padding:8px"></div>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        <?= $isEdit ? 'Salvar alterações' : 'Publicar post' ?>
      </button>
    </div>

  </div>
</form>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '#content',
  height: 460,
  menubar: true,
  language: 'pt_BR',
  plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
  toolbar: 'undo redo | blocks | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | code fullscreen',
  content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; color: #0F172A; line-height: 1.7; }',
  branding: false,
  promotion: false,
});

// Auto-generate slug from title
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

const titleInput = document.getElementById('title');
const slugInput  = document.getElementById('slug');
const slugPreview = document.getElementById('slugPreview');
let slugTouched = <?= ($post['slug'] !== '') ? 'true' : 'false' ?>;

titleInput.addEventListener('input', function() {
  if (!slugTouched) {
    const s = toSlug(this.value);
    slugInput.value = s;
    slugPreview.textContent = s;
  }
});

slugInput.addEventListener('input', function() {
  slugTouched = true;
  slugPreview.textContent = this.value;
});

// Excerpt counter
const excerptTA = document.getElementById('excerpt');
const excerptCount = document.getElementById('excerptCount');
excerptTA.addEventListener('input', function() {
  excerptCount.textContent = this.value.length;
});

// Cover image upload
const imageFile    = document.getElementById('imageFile');
const coverPreview = document.getElementById('coverPreview');
const coverImg     = document.getElementById('coverImg');
const coverInput   = document.getElementById('coverImageInput');
const uploadArea   = document.getElementById('uploadArea');
const uploadProgress = document.getElementById('uploadProgress');
const uploadError  = document.getElementById('uploadError');
const removeCover  = document.getElementById('removeCover');

imageFile.addEventListener('change', async function() {
  const file = this.files[0];
  if (!file) return;

  uploadProgress.style.display = 'block';
  uploadError.style.display = 'none';

  const formData = new FormData();
  formData.append('image', file);

  try {
    const res = await fetch('/cms/upload.php', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.success) {
      coverInput.value = data.url;
      coverImg.src = data.url;
      coverPreview.style.display = 'block';
      uploadProgress.style.display = 'none';
    } else {
      uploadError.textContent = data.error || 'Erro ao enviar imagem.';
      uploadError.style.display = 'block';
      uploadProgress.style.display = 'none';
    }
  } catch (err) {
    uploadError.textContent = 'Falha no upload. Tente novamente.';
    uploadError.style.display = 'block';
    uploadProgress.style.display = 'none';
  }

  this.value = '';
});

removeCover.addEventListener('click', function() {
  coverInput.value = '';
  coverImg.src = '';
  coverPreview.style.display = 'none';
});

// Upload area hover effect
const uploadLabel = document.getElementById('uploadLabel');
uploadLabel.addEventListener('dragover', e => { e.preventDefault(); uploadLabel.style.borderColor = '#2563EB'; });
uploadLabel.addEventListener('dragleave', () => { uploadLabel.style.borderColor = '#E2E8F0'; });
uploadLabel.addEventListener('drop', e => {
  e.preventDefault();
  uploadLabel.style.borderColor = '#E2E8F0';
  const file = e.dataTransfer.files[0];
  if (file) {
    const dt = new DataTransfer();
    dt.items.add(file);
    imageFile.files = dt.files;
    imageFile.dispatchEvent(new Event('change'));
  }
});
</script>

<?php adminFooter(); ?>
