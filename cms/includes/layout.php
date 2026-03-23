<?php
require_once __DIR__ . '/auth.php';

function adminHeader(string $title, string $active): void
{
    $username = htmlspecialchars($_SESSION['username'] ?? 'Admin');
    $csrf = csrfToken();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($title) ?> — Nidex CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { height: 100%; }
    body {
      font-family: 'Inter', sans-serif;
      background: #F1F5F9;
      color: #0F172A;
      display: flex;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }

    /* ---- SIDEBAR ---- */
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background: #0F172A;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      z-index: 100;
      border-right: 1px solid rgba(255,255,255,0.06);
    }
    .sidebar__brand {
      padding: 28px 24px 20px;
      font-size: 1.375rem;
      font-weight: 800;
      color: #2563EB;
      letter-spacing: -0.02em;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .sidebar__nav {
      flex: 1;
      padding: 20px 12px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .sidebar__nav-label {
      font-size: 0.6875rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #475569;
      padding: 12px 12px 6px;
    }
    .sidebar__link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      color: #94A3B8;
      transition: all 0.15s;
    }
    .sidebar__link:hover {
      background: rgba(255,255,255,0.06);
      color: #E2E8F0;
    }
    .sidebar__link.active {
      background: rgba(37,99,235,0.2);
      color: #93C5FD;
      font-weight: 600;
    }
    .sidebar__link svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      opacity: 0.8;
    }
    .sidebar__link.active svg { opacity: 1; }
    .sidebar__footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .sidebar__user {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 8px;
      margin-bottom: 4px;
    }
    .sidebar__avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2563EB, #1D4ED8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }
    .sidebar__username {
      font-size: 0.8125rem;
      font-weight: 600;
      color: #E2E8F0;
    }
    .sidebar__logout {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      border-radius: 8px;
      font-size: 0.8125rem;
      font-weight: 500;
      color: #64748B;
      transition: all 0.15s;
    }
    .sidebar__logout:hover {
      background: rgba(220,38,38,0.1);
      color: #FCA5A5;
    }
    .sidebar__logout svg { width: 16px; height: 16px; }

    /* ---- MAIN CONTENT ---- */
    .main-wrap {
      margin-left: 240px;
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
    }
    .topbar {
      background: #fff;
      border-bottom: 1px solid #E2E8F0;
      padding: 0 32px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .topbar__title {
      font-size: 1.125rem;
      font-weight: 700;
      color: #0F172A;
    }
    .topbar__breadcrumb {
      font-size: 0.8125rem;
      color: #94A3B8;
      margin-top: 2px;
    }
    .content {
      padding: 32px;
      flex: 1;
    }

    /* ---- CARDS / STATS ---- */
    .stat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 32px;
    }
    .stat-card {
      background: #fff;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: 24px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .stat-card__label {
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #64748B;
      margin-bottom: 10px;
    }
    .stat-card__value {
      font-size: 2rem;
      font-weight: 800;
      color: #0F172A;
      line-height: 1;
    }
    .stat-card__icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }
    .stat-card__icon svg { width: 20px; height: 20px; }
    .icon-blue { background: #EFF6FF; color: #2563EB; }
    .icon-green { background: #F0FDF4; color: #16A34A; }
    .icon-yellow { background: #FFFBEB; color: #D97706; }
    .icon-red { background: #FEF2F2; color: #DC2626; }
    .icon-purple { background: #F5F3FF; color: #7C3AED; }

    /* ---- SECTION HEADERS ---- */
    .section-title {
      font-size: 1rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 4px;
    }
    .section-subtitle {
      font-size: 0.8125rem;
      color: #64748B;
      margin-bottom: 20px;
    }
    .section-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    /* ---- TABLE ---- */
    .table-wrap {
      background: #fff;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead tr {
      background: #F8FAFC;
      border-bottom: 1px solid #E2E8F0;
    }
    th {
      text-align: left;
      padding: 12px 16px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #64748B;
    }
    td {
      padding: 14px 16px;
      font-size: 0.875rem;
      color: #334155;
      border-bottom: 1px solid #F1F5F9;
      vertical-align: middle;
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #F8FAFC; }

    /* ---- BADGES ---- */
    .badge {
      display: inline-flex;
      align-items: center;
      font-size: 0.6875rem;
      font-weight: 600;
      padding: 3px 10px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .badge-green  { background: #DCFCE7; color: #16A34A; }
    .badge-yellow { background: #FEF9C3; color: #CA8A04; }
    .badge-blue   { background: #DBEAFE; color: #2563EB; }
    .badge-gray   { background: #F1F5F9; color: #64748B; }
    .badge-red    { background: #FEE2E2; color: #DC2626; }

    /* ---- BUTTONS ---- */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-family: inherit;
      font-weight: 600;
      font-size: 0.875rem;
      padding: 9px 18px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.15s;
      text-decoration: none;
    }
    .btn-primary { background: #2563EB; color: #fff; }
    .btn-primary:hover { background: #1D4ED8; }
    .btn-outline { background: transparent; border: 1.5px solid #2563EB; color: #2563EB; }
    .btn-outline:hover { background: #EFF6FF; }
    .btn-danger { background: transparent; border: 1.5px solid #FCA5A5; color: #DC2626; }
    .btn-danger:hover { background: #FEF2F2; }
    .btn-sm { font-size: 0.75rem; padding: 6px 12px; border-radius: 6px; }
    .btn-ghost { background: transparent; color: #64748B; border: 1.5px solid #E2E8F0; }
    .btn-ghost:hover { background: #F8FAFC; color: #334155; }

    /* ---- FORMS ---- */
    .form-card {
      background: #fff;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: 28px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .form-group { margin-bottom: 20px; }
    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 6px;
    }
    .form-input, .form-select, .form-textarea {
      width: 100%;
      padding: 10px 14px;
      border: 1.5px solid #E2E8F0;
      border-radius: 8px;
      font-size: 0.875rem;
      font-family: inherit;
      color: #0F172A;
      background: #fff;
      transition: border-color 0.15s;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
      outline: none;
      border-color: #2563EB;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .form-textarea { resize: vertical; min-height: 100px; }

    /* ---- ALERTS ---- */
    .alert {
      padding: 14px 18px;
      border-radius: 10px;
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 24px;
    }
    .alert-success { background: #F0FDF4; border: 1px solid #86EFAC; color: #166534; }
    .alert-error   { background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; }

    /* ---- PAGE HEADER ---- */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 28px;
      gap: 16px;
    }
    .page-header__title {
      font-size: 1.5rem;
      font-weight: 800;
      color: #0F172A;
      margin-bottom: 4px;
    }
    .page-header__desc {
      font-size: 0.875rem;
      color: #64748B;
    }

    /* ---- TABS ---- */
    .tabs {
      display: flex;
      gap: 4px;
      background: #F1F5F9;
      border-radius: 10px;
      padding: 4px;
      margin-bottom: 24px;
      width: fit-content;
    }
    .tab {
      padding: 8px 16px;
      border-radius: 7px;
      font-size: 0.8125rem;
      font-weight: 600;
      color: #64748B;
      cursor: pointer;
      transition: all 0.15s;
      text-decoration: none;
      display: inline-block;
    }
    .tab:hover { color: #334155; }
    .tab.active { background: #fff; color: #2563EB; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }

    /* ---- THUMBNAIL ---- */
    .thumb {
      width: 50px;
      height: 50px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid #E2E8F0;
    }
    .thumb-empty {
      width: 50px;
      height: 50px;
      border-radius: 8px;
      background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
      border: 1px solid #E2E8F0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.6875rem;
      color: #94A3B8;
    }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main-wrap { margin-left: 0; }
      .content { padding: 20px 16px; }
      .topbar { padding: 0 16px; }
    }

    /* misc */
    .text-muted { color: #64748B; }
    .flex { display: flex; }
    .gap-2 { gap: 8px; }
    .gap-3 { gap: 12px; }
    .items-center { align-items: center; }
    .justify-between { justify-content: space-between; }
    .mt-2 { margin-top: 8px; }
    .mt-4 { margin-top: 16px; }
    .mb-0 { margin-bottom: 0; }
    .w-full { width: 100%; }
    .empty-state {
      text-align: center;
      padding: 48px 24px;
      color: #94A3B8;
      font-size: 0.875rem;
    }
    .empty-state svg { margin: 0 auto 12px; opacity: 0.4; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar__brand">nidex</div>
    <nav class="sidebar__nav">
      <span class="sidebar__nav-label">Menu</span>
      <a href="/cms/index.php" class="sidebar__link <?= $active === 'dashboard' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="/cms/posts.php" class="sidebar__link <?= $active === 'posts' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        Posts
      </a>
      <a href="/cms/categories.php" class="sidebar__link <?= $active === 'categories' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
        Categorias
      </a>
      <a href="/cms/leads.php" class="sidebar__link <?= $active === 'leads' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Leads
      </a>
    </nav>
    <div class="sidebar__footer">
      <div class="sidebar__user">
        <div class="sidebar__avatar"><?= strtoupper(substr($username, 0, 1)) ?></div>
        <span class="sidebar__username"><?= $username ?></span>
      </div>
      <a href="/cms/logout.php" class="sidebar__logout">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sair
      </a>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main-wrap">
    <div class="topbar">
      <div>
        <div class="topbar__title"><?= htmlspecialchars($title) ?></div>
      </div>
      <div style="font-size:0.8125rem;color:#94A3B8"><?= date('d/m/Y') ?></div>
    </div>
    <div class="content">
<?php
}

function adminFooter(): void
{
?>
    </div><!-- .content -->
  </div><!-- .main-wrap -->

</body>
</html>
<?php
}
