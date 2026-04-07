<?php
$latestPosts = [];
try {
    require_once __DIR__ . '/cms/config.php';
    require_once __DIR__ . '/cms/includes/db.php';
    $pdo = getDB();
    $stmt = $pdo->query(
        "SELECT p.title, p.slug, p.excerpt, p.cover_image, p.published_at,
                c.name AS category_name
         FROM posts p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.status = 'published'
         ORDER BY p.published_at DESC, p.created_at DESC
         LIMIT 3"
    );
    $latestPosts = $stmt->fetchAll();
} catch (Throwable $e) {
    // Silently fail — blog section will show empty state
}

define('ROOT', __DIR__);
define('SITE', ROOT . '/site');

$page_title = 'nidex — O simples completo';
$page_description = 'nidex é um ecossistema all-in-one para empreendedores: CRM, financeiro, cobranças, tarefas e IA integrada em um único lugar.';

require SITE . '/includes/head.php';
require SITE . '/includes/header.php';
require SITE . '/sections/hero.php';
require SITE . '/sections/problem.php';
require SITE . '/sections/modules.php';
require SITE . '/sections/ia.php';
require SITE . '/sections/why.php';
require SITE . '/sections/run-preview.php';
require SITE . '/sections/faq.php';
require SITE . '/sections/orcamento.php';
require SITE . '/sections/cta.php';
require SITE . '/sections/blog-preview.php';
require SITE . '/includes/footer.php';
