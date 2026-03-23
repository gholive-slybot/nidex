<?php
require_once __DIR__ . '/config.php';

$errors = [];
$success = false;

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    // Create users table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `users` (
            `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `username`   VARCHAR(50)  NOT NULL,
            `password`   VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_username` (`username`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Create categories table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `categories` (
            `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name`       VARCHAR(100) NOT NULL,
            `slug`       VARCHAR(100) NOT NULL,
            `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_slug` (`slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Create posts table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `posts` (
            `id`           INT UNSIGNED  NOT NULL AUTO_INCREMENT,
            `title`        VARCHAR(255)  NOT NULL,
            `slug`         VARCHAR(255)  NOT NULL,
            `excerpt`      TEXT,
            `content`      LONGTEXT,
            `cover_image`  VARCHAR(255)  DEFAULT NULL,
            `category_id`  INT UNSIGNED  DEFAULT NULL,
            `status`       ENUM('draft','published') NOT NULL DEFAULT 'draft',
            `published_at` TIMESTAMP     NULL DEFAULT NULL,
            `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_slug` (`slug`),
            KEY `fk_category` (`category_id`),
            CONSTRAINT `fk_posts_category`
                FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
                ON DELETE SET NULL ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Create contacts table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `contacts` (
            `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name`       VARCHAR(100) NOT NULL,
            `email`      VARCHAR(150) NOT NULL,
            `phone`      VARCHAR(20)  NOT NULL,
            `status`     ENUM('new','read','contacted') NOT NULL DEFAULT 'new',
            `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Insert default admin user (only if not already exists)
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    if (!$stmt->fetch()) {
        $hashedPassword = password_hash('Nidex@2026', PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute(['admin', $hashedPassword]);
    }

    // Create uploads directory if needed
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
        file_put_contents(UPLOAD_DIR . '.gitkeep', '');
    }

    $success = true;

} catch (PDOException $e) {
    $errors[] = 'Erro de banco de dados: ' . $e->getMessage();
} catch (Exception $e) {
    $errors[] = 'Erro: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instalação — Nidex CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #F8FAFC; color: #0F172A; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 24px; }
    .card { background: #fff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 48px; max-width: 540px; width: 100%; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
    .logo { font-size: 1.5rem; font-weight: 800; color: #2563EB; margin-bottom: 32px; }
    h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 8px; }
    .subtitle { color: #64748B; font-size: 0.9375rem; margin-bottom: 32px; }
    .success-box { background: #F0FDF4; border: 1px solid #86EFAC; border-radius: 10px; padding: 20px 24px; margin-bottom: 24px; }
    .success-box h2 { color: #16A34A; font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
    .success-box p { color: #166534; font-size: 0.875rem; line-height: 1.6; }
    .error-box { background: #FEF2F2; border: 1px solid #FECACA; border-radius: 10px; padding: 20px 24px; margin-bottom: 24px; }
    .error-box h2 { color: #DC2626; font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
    .error-box ul { color: #991B1B; font-size: 0.875rem; padding-left: 20px; }
    .warning-box { background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 10px; padding: 20px 24px; }
    .warning-box h2 { color: #D97706; font-size: 0.875rem; font-weight: 700; margin-bottom: 6px; }
    .warning-box p { color: #92400E; font-size: 0.875rem; line-height: 1.6; }
    .steps { margin-top: 24px; }
    .step { display: flex; gap: 12px; margin-bottom: 12px; align-items: flex-start; }
    .step-num { background: #2563EB; color: #fff; font-size: 0.75rem; font-weight: 700; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
    .step p { font-size: 0.875rem; color: #475569; line-height: 1.5; }
    .step code { background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 0.8125rem; color: #1D4ED8; }
    .btn { display: inline-flex; align-items: center; gap: 8px; background: #2563EB; color: #fff; font-family: inherit; font-weight: 600; font-size: 0.9375rem; padding: 12px 24px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; margin-top: 24px; transition: background 0.2s; }
    .btn:hover { background: #1D4ED8; }
  </style>
</head>
<body>
  <div class="card">
    <div class="logo">nidex</div>
    <h1>Instalação do CMS</h1>
    <p class="subtitle">Configurando banco de dados e usuário padrão.</p>

    <?php if ($success): ?>
    <div class="success-box">
      <h2>✓ Instalação concluída com sucesso!</h2>
      <p>Todas as tabelas foram criadas e o usuário administrador foi configurado.</p>
    </div>

    <div class="steps">
      <div class="step">
        <div class="step-num">1</div>
        <p>Acesse o painel em <code>/cms/login.php</code></p>
      </div>
      <div class="step">
        <div class="step-num">2</div>
        <p>Login: <code>admin</code> · Senha: <code>Nidex@2026</code></p>
      </div>
      <div class="step">
        <div class="step-num">3</div>
        <p><strong>IMPORTANTE:</strong> Delete o arquivo <code>install.php</code> do servidor imediatamente após o login.</p>
      </div>
    </div>

    <div class="warning-box" style="margin-top:24px">
      <h2>⚠ Segurança</h2>
      <p>Este arquivo deve ser deletado imediatamente. Deixá-lo acessível pode comprometer a segurança do seu sistema.</p>
    </div>

    <a href="/cms/login.php" class="btn">Ir para o painel →</a>

    <?php else: ?>
    <div class="error-box">
      <h2>Erro na instalação</h2>
      <ul>
        <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <p style="font-size:0.875rem;color:#64748B">Verifique as credenciais do banco de dados em <code style="background:#F1F5F9;padding:2px 6px;border-radius:4px;font-family:monospace;font-size:0.8125rem;color:#1D4ED8">config.php</code> e tente novamente.</p>
    <?php endif; ?>
  </div>
</body>
</html>
