<?php
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/cms/includes/db.php';

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'errors' => ['general' => 'Método não permitido.']]);
    exit;
}

// Parse JSON or form body
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (str_contains($contentType, 'application/json')) {
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
} else {
    $body = $_POST;
}

$name  = trim($body['name']  ?? '');
$email = trim($body['email'] ?? '');
$phone = trim($body['phone'] ?? '');

$errors = [];

// Validate name
if (strlen($name) < 2 || strlen($name) > 100) {
    $errors['name'] = 'Nome obrigatório (2–100 caracteres).';
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'E-mail inválido.';
}

// Validate phone (strip non-digits, check 10-15 digits)
$phoneDigits = preg_replace('/\D/', '', $phone);
if (strlen($phoneDigits) < 10 || strlen($phoneDigits) > 15) {
    $errors['phone'] = 'Telefone inválido (10–15 dígitos).';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Sanitize
$nameSafe  = htmlspecialchars($name,  ENT_QUOTES, 'UTF-8');
$emailSafe = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phoneSafe = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');

$pdo = getDB();

// Rate limit: same email in last 60 seconds
$stmt = $pdo->prepare(
    "SELECT COUNT(*) FROM contacts WHERE email = ? AND created_at >= DATE_SUB(NOW(), INTERVAL 60 SECOND)"
);
$stmt->execute([$emailSafe]);
if ((int) $stmt->fetchColumn() > 0) {
    http_response_code(429);
    echo json_encode([
        'success' => false,
        'errors'  => ['general' => 'Aguarde um momento antes de enviar novamente.']
    ]);
    exit;
}

// Insert
$stmt = $pdo->prepare(
    "INSERT INTO contacts (name, email, phone, status) VALUES (?, ?, ?, 'new')"
);
$stmt->execute([$nameSafe, $emailSafe, $phoneSafe]);

echo json_encode(['success' => true]);
