<?php
/**
 * DALL-E 3 Image Generator
 * POST /api/generate-image.php
 * Body: { "prompt": "...", "filename": "nome-do-arquivo" }
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// ── Carrega a API key do .env ─────────────────────────────────────────────────
function loadEnv(string $path): void {
    if (!file_exists($path)) return;
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $_ENV[$key] = $value;
    }
}

loadEnv(dirname(__DIR__) . '/.env');

$apiKey = $_ENV['OPENAI_API_KEY'] ?? '';
if (!$apiKey || $apiKey === 'sua_chave_aqui') {
    http_response_code(500);
    echo json_encode(['error' => 'API key não configurada no .env']);
    exit;
}

// ── Lê o body da requisição ───────────────────────────────────────────────────
$body     = json_decode(file_get_contents('php://input'), true);
$prompt   = trim($body['prompt']   ?? '');
$filename = trim($body['filename'] ?? 'image-' . time());

if (!$prompt) {
    http_response_code(400);
    echo json_encode(['error' => 'Prompt obrigatório']);
    exit;
}

// Sanitiza o filename
$filename = preg_replace('/[^a-z0-9\-_]/', '', strtolower($filename));
if (!$filename) $filename = 'image-' . time();

// ── Chama a API do DALL-E 3 ───────────────────────────────────────────────────
$payload = json_encode([
    'model'           => 'dall-e-3',
    'prompt'          => $prompt,
    'n'               => 1,
    'size'            => '1792x1024',
    'quality'         => 'standard',
    'response_format' => 'url',
]);

$ch = curl_init('https://api.openai.com/v1/images/generations');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ],
    CURLOPT_TIMEOUT        => 60,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);

if ($httpCode !== 200 || empty($data['data'][0]['url'])) {
    http_response_code(500);
    echo json_encode([
        'error'    => 'Erro na API OpenAI',
        'details'  => $data['error']['message'] ?? $response,
    ]);
    exit;
}

// ── Baixa e salva a imagem em /uploads/ ───────────────────────────────────────
$imageUrl  = $data['data'][0]['url'];
$savePath  = dirname(__DIR__) . '/uploads/' . $filename . '.png';
$publicUrl = '/uploads/' . $filename . '.png';

$imageData = file_get_contents($imageUrl);
if ($imageData === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Falha ao baixar a imagem gerada']);
    exit;
}

file_put_contents($savePath, $imageData);

echo json_encode([
    'success'        => true,
    'url'            => $publicUrl,
    'filename'       => $filename . '.png',
    'revised_prompt' => $data['data'][0]['revised_prompt'] ?? $prompt,
]);
