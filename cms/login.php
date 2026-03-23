<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';

// Already logged in
if (!empty($_SESSION['user_id'])) {
    header('Location: /cms/index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Preencha usuário e senha.';
    } else {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /cms/index.php');
            exit;
        } else {
            $error = 'Usuário ou senha inválidos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login — Nidex CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: #0F172A;
      color: #0F172A;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 24px;
      -webkit-font-smoothing: antialiased;
    }
    .login-wrap {
      width: 100%;
      max-width: 420px;
    }
    .login-logo {
      font-size: 2rem;
      font-weight: 800;
      color: #2563EB;
      text-align: center;
      margin-bottom: 8px;
      letter-spacing: -0.03em;
    }
    .login-tagline {
      text-align: center;
      font-size: 0.875rem;
      color: #64748B;
      margin-bottom: 32px;
    }
    .login-card {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 24px 64px rgba(0,0,0,0.3);
    }
    .login-title {
      font-size: 1.375rem;
      font-weight: 700;
      margin-bottom: 6px;
    }
    .login-subtitle {
      font-size: 0.875rem;
      color: #64748B;
      margin-bottom: 28px;
    }
    .form-group { margin-bottom: 18px; }
    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 6px;
    }
    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid #E2E8F0;
      border-radius: 8px;
      font-size: 0.9375rem;
      font-family: inherit;
      color: #0F172A;
      background: #fff;
      transition: border-color 0.15s;
    }
    .form-input:focus {
      outline: none;
      border-color: #2563EB;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .btn-login {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 13px 24px;
      background: linear-gradient(135deg, #2563EB, #1D4ED8);
      color: #fff;
      font-family: inherit;
      font-size: 0.9375rem;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: opacity 0.15s;
      margin-top: 8px;
    }
    .btn-login:hover { opacity: 0.9; }
    .error-box {
      background: #FEF2F2;
      border: 1px solid #FECACA;
      color: #991B1B;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .footer-note {
      text-align: center;
      font-size: 0.75rem;
      color: #475569;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="login-wrap">
    <div class="login-logo">nidex</div>
    <p class="login-tagline">Painel de administração</p>

    <div class="login-card">
      <h1 class="login-title">Entrar no painel</h1>
      <p class="login-subtitle">Use suas credenciais de administrador.</p>

      <?php if ($error): ?>
      <div class="error-box">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <?= htmlspecialchars($error) ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="/cms/login.php" novalidate>
        <div class="form-group">
          <label class="form-label" for="username">Usuário</label>
          <input
            class="form-input"
            type="text"
            id="username"
            name="username"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
            autocomplete="username"
            autofocus
            required
          />
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Senha</label>
          <input
            class="form-input"
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
            required
          />
        </div>
        <button type="submit" class="btn-login">
          Entrar
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </form>

      <p class="footer-note">Nidex CMS &copy; <?= date('Y') ?></p>
    </div>
  </div>
</body>
</html>
