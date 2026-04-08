<?php
require_once dirname(dirname(__DIR__)) . '/cms/config.php';
require_once dirname(dirname(__DIR__)) . '/cms/includes/db.php';

$pdo  = getDB();
$slug = trim($_GET['slug'] ?? '');

$post = null;
if ($slug !== '') {
    $stmt = $pdo->prepare(
        "SELECT p.id, p.title, p.slug, p.excerpt, p.content, p.cover_image, p.published_at, p.status,
                c.name AS category_name, c.slug AS category_slug, c.id AS category_id
         FROM posts p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.slug = ? AND p.status = 'published'
         LIMIT 1"
    );
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
}

// Related posts (same category, exclude current)
$relatedPosts = [];
if ($post && $post['category_id']) {
    $stmt = $pdo->prepare(
        "SELECT p.title, p.slug, p.excerpt, p.cover_image, p.published_at,
                c.name AS category_name
         FROM posts p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.status = 'published' AND p.category_id = ? AND p.id != ?
         ORDER BY p.published_at DESC
         LIMIT 3"
    );
    $stmt->execute([$post['category_id'], $post['id']]);
    $relatedPosts = $stmt->fetchAll();
}

// Format published date in Portuguese
function formatDatePt(string $date): string {
    $months = [
        1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril',
        5 => 'maio', 6 => 'junho', 7 => 'julho', 8 => 'agosto',
        9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro',
    ];
    $ts    = strtotime($date);
    $day   = (int) date('j', $ts);
    $month = $months[(int) date('n', $ts)];
    $year  = date('Y', $ts);
    return "$day de $month de $year";
}

$pageTitle = $post ? htmlspecialchars($post['title']) . ' — Blog Nidex' : 'Post não encontrado — Nidex';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $pageTitle ?></title>
  <?php if ($post): ?>
  <meta name="description" content="<?= htmlspecialchars(mb_substr($post['excerpt'] ?? '', 0, 155)) ?>" />
  <?php endif; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/site/assets/css/variables.css" />
  <link rel="stylesheet" href="/site/assets/css/reset.css" />
  <link rel="stylesheet" href="/site/assets/css/global.css" />
  <link rel="stylesheet" href="/site/assets/css/components.css" />
  <link rel="stylesheet" href="/site/assets/css/sections.css" />
  <link rel="stylesheet" href="/site/assets/css/inner-pages.css" />
  <link rel="stylesheet" href="/site/assets/css/responsive.css" />
  <link rel="icon" href="/site/uploads/favicon.png" type="image/png" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="container navbar__inner">
      <a href="/" class="navbar__logo"><img src="/site/uploads/logo-nidex-cor.svg" alt="nidex" /></a>
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
        <a href="https://app.nidex.com.br/users/sign_in" class="navbar__login">Entrar</a>
        <a href="https://app.nidex.com.br/users/sign_up" class="btn btn--primary">Começar grátis</a>
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
            <p class="mega-card__desc">Estratégia com ROI claro.</p>
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
        <a href="https://app.nidex.com.br/users/sign_in" class="mobile-menu__login">Entrar</a>
        <a href="https://app.nidex.com.br/users/sign_up" class="btn btn--primary">Começar grátis</a>
      </div>
    </div>
  </header>

  <main>
    <?php if (!$post): ?>
    <!-- 404 -->
    <div class="container">
      <div class="not-found">
        <div style="font-size:3rem;margin-bottom:16px">📄</div>
        <h1 class="not-found__title">Post não encontrado</h1>
        <p class="not-found__desc">O artigo que você procura não existe ou foi removido.</p>
        <a href="/blog.php" class="btn btn--primary">← Ver todos os posts</a>
      </div>
    </div>

    <?php else: ?>
    <!-- Cover Image -->
    <?php if ($post['cover_image']): ?>
    <div class="post-cover-wrap">
      <img
        src="<?= htmlspecialchars($post['cover_image']) ?>"
        alt="<?= htmlspecialchars($post['title']) ?>"
        class="post-cover"
      />
    </div>
    <?php endif; ?>

    <section style="padding: 0 0 80px">
      <div class="container">
        <div class="post-header">
          <!-- Breadcrumb -->
          <div class="breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <a href="/blog.php">Blog</a>
            <?php if ($post['category_name']): ?>
            <span>/</span>
            <a href="/blog.php?cat=<?= urlencode($post['category_slug']) ?>"><?= htmlspecialchars($post['category_name']) ?></a>
            <?php endif; ?>
          </div>

          <?php if ($post['category_name']): ?>
          <a href="/blog.php?cat=<?= urlencode($post['category_slug']) ?>" class="post-cat">
            <?= htmlspecialchars($post['category_name']) ?>
          </a>
          <?php endif; ?>
          <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>
          <?php if ($post['excerpt']): ?>
          <p class="post-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
          <?php endif; ?>
          <div class="post-meta">
            <?php if ($post['published_at']): ?>
            <span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <?= formatDatePt($post['published_at']) ?>
            </span>
            <?php endif; ?>
          </div>
        </div>

        <!-- Post Layout -->
        <div class="post-layout">
          <!-- Content -->
          <article class="post-content">
            <?= $post['content'] ?>
          </article>

          <!-- Sidebar: Related Posts -->
          <?php if (!empty($relatedPosts)): ?>
          <aside>
            <div class="related-title">Mais posts nesta categoria</div>
            <?php foreach ($relatedPosts as $rp): ?>
            <a href="/post.php?slug=<?= urlencode($rp['slug']) ?>" class="related-card">
              <?php if ($rp['cover_image']): ?>
              <img src="<?= htmlspecialchars($rp['cover_image']) ?>" alt="" class="related-card__img" loading="lazy" />
              <?php else: ?>
              <div class="related-card__img--empty"></div>
              <?php endif; ?>
              <div>
                <div class="related-card__title"><?= htmlspecialchars($rp['title']) ?></div>
                <?php if ($rp['published_at']): ?>
                <div class="related-card__date"><?= date('d/m/Y', strtotime($rp['published_at'])) ?></div>
                <?php endif; ?>
              </div>
            </a>
            <?php endforeach; ?>

            <div style="margin-top:16px">
              <a href="/blog.php<?= $post['category_slug'] ? '?cat=' . urlencode($post['category_slug']) : '' ?>" class="btn btn--outline" style="width:100%;justify-content:center">
                Ver todos →
              </a>
            </div>
          </aside>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- Related Posts Bottom (if no sidebar) -->
    <?php if (empty($relatedPosts)): ?>
    <section style="background:var(--bg-light);padding:48px 0">
      <div class="container" style="text-align:center">
        <a href="/blog.php" class="btn btn--outline">← Ver todos os posts</a>
      </div>
    </section>
    <?php endif; ?>

    <?php endif; ?>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <div class="footer__logo"><img src="/site/uploads/logo-nidex-white.svg" alt="nidex" /></div>
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

  <script src="/site/assets/js/main.js"></script>
</body>
</html>
