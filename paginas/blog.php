<?php
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/cms/includes/db.php';

$pdo = getDB();

$perPage = 6;
$offset  = max(0, (int) ($_GET['offset'] ?? 0));
$catSlug = trim($_GET['cat'] ?? '');
$isAjax  = isset($_GET['ajax']) && $_GET['ajax'] === '1';

// Resolve category filter
$categoryId = null;
$categoryName = '';
if ($catSlug !== '') {
    $stmt = $pdo->prepare("SELECT id, name FROM categories WHERE slug = ? LIMIT 1");
    $stmt->execute([$catSlug]);
    $catRow = $stmt->fetch();
    if ($catRow) {
        $categoryId   = $catRow['id'];
        $categoryName = $catRow['name'];
    }
}

// Build query
$whereClause = "WHERE p.status = 'published'";
$params = [];
if ($categoryId !== null) {
    $whereClause .= " AND p.category_id = ?";
    $params[] = $categoryId;
}

$posts = $pdo->prepare(
    "SELECT p.id, p.title, p.slug, p.excerpt, p.cover_image, p.published_at,
            c.name AS category_name, c.slug AS category_slug
     FROM posts p
     LEFT JOIN categories c ON c.id = p.category_id
     $whereClause
     ORDER BY p.published_at DESC, p.created_at DESC
     LIMIT $perPage OFFSET $offset"
);
$posts->execute($params);
$posts = $posts->fetchAll();

// Check if there are more posts
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM posts p $whereClause");
$totalStmt->execute($params);
$total   = (int) $totalStmt->fetchColumn();
$hasMore = ($offset + $perPage) < $total;

// AJAX: return JSON
if ($isAjax) {
    header('Content-Type: application/json');
    $cards = [];
    foreach ($posts as $p) {
        $cards[] = [
            'title'         => $p['title'],
            'slug'          => $p['slug'],
            'excerpt'       => $p['excerpt'],
            'cover_image'   => $p['cover_image'],
            'category_name' => $p['category_name'],
            'category_slug' => $p['category_slug'],
            'published_at'  => $p['published_at'],
        ];
    }
    echo json_encode(['posts' => $cards, 'hasMore' => $hasMore, 'total' => $total]);
    exit;
}

// All categories for filter bar
$categories = $pdo->query(
    "SELECT c.id, c.name, c.slug, COUNT(p.id) AS post_count
     FROM categories c
     INNER JOIN posts p ON p.category_id = c.id AND p.status = 'published'
     GROUP BY c.id
     ORDER BY c.name ASC"
)->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $categoryName ? htmlspecialchars($categoryName) . ' — ' : '' ?>Blog — Nidex</title>
  <meta name="description" content="Dicas, estratégias e tendências para empreendedores crescerem com inteligência." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/style.css" />
  <style>
    .blog-hero {
      background: var(--bg-dark);
      padding: 80px 0 60px;
      text-align: center;
    }
    .blog-hero__label {
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 12px;
    }
    .blog-hero__title {
      font-size: clamp(2rem, 5vw, 3rem);
      font-weight: 800;
      color: #fff;
      line-height: 1.15;
      margin-bottom: 16px;
    }
    .blog-hero__desc {
      font-size: 1rem;
      color: #94A3B8;
      max-width: 520px;
      margin: 0 auto;
      line-height: 1.7;
    }
    .category-filter {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 40px;
    }
    .cat-btn {
      display: inline-block;
      padding: 8px 18px;
      border-radius: 999px;
      font-size: 0.8125rem;
      font-weight: 600;
      border: 1.5px solid var(--border);
      color: var(--text-muted);
      text-decoration: none;
      transition: all 0.15s;
    }
    .cat-btn:hover { border-color: var(--primary); color: var(--primary); }
    .cat-btn.active { background: var(--primary); color: #fff; border-color: var(--primary); }
    .load-more-wrap { text-align: center; margin-top: 48px; }
    #loadMoreBtn { min-width: 180px; justify-content: center; }
    #loadMoreBtn:disabled { opacity: 0.5; cursor: not-allowed; }
    .blog-count {
      font-size: 0.875rem;
      color: var(--text-muted);
      margin-bottom: 24px;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="/" class="navbar__logo"><img src="/uploads/logo-nidex-cor.svg" alt="nidex" /></a>
      <nav class="navbar__links" id="navLinks">
        <a href="/#funcionalidades">Funcionalidades</a>
        <a href="/#como-funciona">Como funciona</a>
        <button class="mega-trigger" id="megaTrigger" aria-expanded="false" aria-controls="megaMenu">
          Serviços
          <svg class="mega-trigger__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <a href="/#depoimentos">Depoimentos</a>
        <a href="/#precos">Preços</a>
      </nav>
      <div class="navbar__actions">
        <a href="#" class="navbar__login">Entrar</a>
        <a href="/#contato" class="btn btn--primary open-modal">Começar grátis</a>
      </div>
      <button class="navbar__toggle" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
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
            <p class="mega-card__desc">Capacite sua equipe para usar IA no dia a dia.</p>
            <div class="mega-card__tags"><span>Workshops práticos</span><span>Certificação</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
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
            <p class="mega-card__desc">MVP entregue em até 2 semanas.</p>
            <div class="mega-card__tags"><span>Chatbots</span><span>Automação</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
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
            <p class="mega-card__desc">Estratégia de IA com ROI claro.</p>
            <div class="mega-card__tags"><span>Diagnóstico</span><span>Roadmap</span></div>
            <div class="mega-card__cta">Saiba mais <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
          </div>
        </a>
      </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
      <a href="/#funcionalidades" class="mobile-menu__link">Funcionalidades</a>
      <a href="/#como-funciona" class="mobile-menu__link">Como funciona</a>
      <a href="/servicos" class="mobile-menu__link">Serviços</a>
      <a href="/#depoimentos" class="mobile-menu__link">Depoimentos</a>
      <a href="/#precos" class="mobile-menu__link">Preços</a>
      <div class="mobile-menu__actions">
        <a href="#" class="mobile-menu__login">Entrar</a>
        <a href="/#contato" class="btn btn--primary">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>
    <!-- Blog Hero -->
    <div class="blog-hero">
      <div class="container">
        <div class="blog-hero__label">Blog</div>
        <h1 class="blog-hero__title">
          Conteúdo para <span style="color:var(--accent)">empreendedores</span>
        </h1>
        <p class="blog-hero__desc">
          Dicas, estratégias e tendências para crescer com inteligência.
        </p>
      </div>
    </div>

    <section class="section section--light" style="padding-top:48px">
      <div class="container">

        <!-- Category Filter -->
        <?php if (!empty($categories)): ?>
        <div class="category-filter">
          <a href="/blog.php" class="cat-btn <?= $catSlug === '' ? 'active' : '' ?>">Todos</a>
          <?php foreach ($categories as $cat): ?>
          <a href="/blog.php?cat=<?= urlencode($cat['slug']) ?>" class="cat-btn <?= $catSlug === $cat['slug'] ? 'active' : '' ?>">
            <?= htmlspecialchars($cat['name']) ?>
            <span style="opacity:0.6;font-size:0.75rem;margin-left:4px">(<?= $cat['post_count'] ?>)</span>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($total > 0): ?>
        <div class="blog-count"><?= $total ?> post<?= $total !== 1 ? 's' : '' ?><?= $categoryName ? ' em ' . htmlspecialchars($categoryName) : '' ?></div>
        <?php endif; ?>

        <!-- Posts Grid -->
        <div class="blog-grid" id="blogGrid">
          <?php if (empty($posts)): ?>
          <p style="color:var(--text-muted);grid-column:1/-1;text-align:center;padding:48px 0">
            <?= $categoryName ? 'Nenhum post nesta categoria ainda.' : 'Nenhum post publicado ainda.' ?>
          </p>
          <?php else: ?>
          <?php foreach ($posts as $p): ?>
          <a href="/post.php?slug=<?= urlencode($p['slug']) ?>" class="blog-card">
            <?php if ($p['cover_image']): ?>
            <div class="blog-card__img"><img src="<?= htmlspecialchars($p['cover_image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy" /></div>
            <?php else: ?>
            <div class="blog-card__img blog-card__img--empty"></div>
            <?php endif; ?>
            <div class="blog-card__body">
              <?php if ($p['category_name']): ?>
              <span class="blog-card__cat"><?= htmlspecialchars($p['category_name']) ?></span>
              <?php endif; ?>
              <h3 class="blog-card__title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="blog-card__excerpt"><?= htmlspecialchars($p['excerpt'] ?? '') ?></p>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto">
                <span class="blog-card__link">Ler mais →</span>
                <?php if ($p['published_at']): ?>
                <span style="font-size:0.75rem;color:var(--text-muted)"><?= date('d/m/Y', strtotime($p['published_at'])) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Load More -->
        <?php if ($hasMore): ?>
        <div class="load-more-wrap">
          <button id="loadMoreBtn" class="btn btn--outline" data-offset="<?= $perPage ?>" data-cat="<?= htmlspecialchars($catSlug) ?>">
            Carregar mais
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
        </div>
        <?php endif; ?>

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
        <a href="/#funcionalidades" class="footer__link">Funcionalidades</a>
        <a href="/#precos" class="footer__link">Preços</a>
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

  <script src="/script.js"></script>
  <script>
  const loadMoreBtn = document.getElementById('loadMoreBtn');
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', async function() {
      const btn    = this;
      const offset = parseInt(btn.dataset.offset, 10);
      const cat    = btn.dataset.cat;

      btn.disabled = true;
      btn.textContent = 'Carregando...';

      try {
        const params = new URLSearchParams({ ajax: '1', offset: offset });
        if (cat) params.set('cat', cat);

        const res  = await fetch('/blog.php?' + params.toString());
        const data = await res.json();

        const grid = document.getElementById('blogGrid');

        data.posts.forEach(p => {
          const card = document.createElement('a');
          card.href = '/post.php?slug=' + encodeURIComponent(p.slug);
          card.className = 'blog-card';

          let imgHtml = '';
          if (p.cover_image) {
            imgHtml = `<div class="blog-card__img"><img src="${escHtml(p.cover_image)}" alt="${escHtml(p.title)}" loading="lazy" /></div>`;
          } else {
            imgHtml = '<div class="blog-card__img blog-card__img--empty"></div>';
          }

          let catHtml = p.category_name ? `<span class="blog-card__cat">${escHtml(p.category_name)}</span>` : '';
          let dateHtml = p.published_at ? `<span style="font-size:0.75rem;color:var(--text-muted)">${formatDate(p.published_at)}</span>` : '';

          card.innerHTML = `
            ${imgHtml}
            <div class="blog-card__body">
              ${catHtml}
              <h3 class="blog-card__title">${escHtml(p.title)}</h3>
              <p class="blog-card__excerpt">${escHtml(p.excerpt || '')}</p>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto">
                <span class="blog-card__link">Ler mais →</span>
                ${dateHtml}
              </div>
            </div>
          `;
          grid.appendChild(card);
        });

        const newOffset = offset + data.posts.length;
        btn.dataset.offset = newOffset;

        if (data.hasMore) {
          btn.disabled = false;
          btn.innerHTML = 'Carregar mais <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>';
        } else {
          btn.parentElement.style.display = 'none';
        }
      } catch (err) {
        btn.disabled = false;
        btn.textContent = 'Tentar novamente';
      }
    });
  }

  function escHtml(str) {
    const d = document.createElement('div');
    d.textContent = str || '';
    return d.innerHTML;
  }

  function formatDate(str) {
    if (!str) return '';
    const d = new Date(str);
    return d.toLocaleDateString('pt-BR');
  }
  </script>
</body>
</html>
