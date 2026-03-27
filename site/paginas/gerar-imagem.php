<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gerador de Imagens — nidex</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #F8FAFC;
      color: #0F172A;
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 48px 24px;
    }
    .card {
      background: #fff;
      border: 1px solid #E2E8F0;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 720px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }
    .card__header { margin-bottom: 32px; }
    .card__label {
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #0B64F4;
      margin-bottom: 8px;
    }
    .card__title { font-size: 1.5rem; font-weight: 800; }
    .card__desc { font-size: 0.875rem; color: #64748B; margin-top: 6px; }

    .field { margin-bottom: 20px; }
    .field label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 6px; }
    .field textarea, .field input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      font-size: 0.9rem;
      font-family: inherit;
      color: #0F172A;
      transition: border-color 0.2s;
      outline: none;
      resize: vertical;
    }
    .field textarea:focus, .field input:focus { border-color: #0B64F4; }
    .field textarea { min-height: 100px; }

    .field__hint { font-size: 0.75rem; color: #94A3B8; margin-top: 5px; }

    .presets { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .preset {
      font-size: 0.75rem;
      font-weight: 500;
      color: #0B64F4;
      background: #EFF6FF;
      border: 1px solid #BFDBFE;
      border-radius: 20px;
      padding: 5px 12px;
      cursor: pointer;
      transition: background 0.15s;
    }
    .preset:hover { background: #DBEAFE; }

    .btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #0B64F4, #0952CC);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      transition: opacity 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .btn:hover { opacity: 0.9; }
    .btn:disabled { opacity: 0.5; cursor: not-allowed; }

    .result { margin-top: 32px; display: none; }
    .result img {
      width: 100%;
      border-radius: 10px;
      border: 1px solid #E2E8F0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .result__meta {
      margin-top: 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }
    .result__filename {
      font-size: 0.8rem;
      font-weight: 600;
      color: #0F172A;
      background: #F1F5F9;
      padding: 6px 12px;
      border-radius: 6px;
      font-family: monospace;
    }
    .result__copy {
      font-size: 0.8rem;
      font-weight: 600;
      color: #0B64F4;
      cursor: pointer;
      text-decoration: underline;
    }
    .result__revised {
      margin-top: 10px;
      font-size: 0.78rem;
      color: #64748B;
      line-height: 1.6;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 10px 14px;
    }
    .result__revised strong { display: block; font-weight: 600; color: #0F172A; margin-bottom: 4px; }

    .error-box {
      margin-top: 20px;
      background: #FEF2F2;
      border: 1px solid #FECACA;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 0.875rem;
      color: #DC2626;
      display: none;
    }

    .spinner {
      width: 18px; height: 18px;
      border: 2px solid rgba(255,255,255,0.3);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 0.7s linear infinite;
      display: none;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>
  <div class="card">
    <div class="card__header">
      <p class="card__label">DALL-E 3 · OpenAI</p>
      <h1 class="card__title">Gerador de Imagens</h1>
      <p class="card__desc">Gera imagens via IA e salva automaticamente em <code>/site/uploads/</code></p>
    </div>

    <div class="field">
      <label>Prompt</label>
      <textarea id="prompt" placeholder="Descreva a imagem em inglês para melhor resultado..."></textarea>
      <p class="field__hint">Escreva em inglês para resultados mais precisos com DALL-E 3.</p>
    </div>

    <p style="font-size:0.78rem;font-weight:600;color:#64748B;margin-bottom:8px;">Prompts prontos para o nidex:</p>
    <div class="presets">
      <span class="preset" onclick="setPrompt(this)">Brazilian entrepreneur working on laptop in modern office, smiling, natural light, professional photo, ultra realistic</span>
      <span class="preset" onclick="setPrompt(this)">Small business owner reviewing financial dashboard on tablet, clean desk, warm office atmosphere, candid photo</span>
      <span class="preset" onclick="setPrompt(this)">Team meeting in a modern Brazilian startup office, diverse professionals collaborating, bright and airy space</span>
      <span class="preset" onclick="setPrompt(this)">Abstract blue gradient tech background, geometric shapes, professional SaaS product hero image, clean minimal design</span>
      <span class="preset" onclick="setPrompt(this)">Person using smartphone app for business management, close-up hands, blurred city background, professional lifestyle photo</span>
    </div>

    <div class="field">
      <label>Nome do arquivo (sem extensão)</label>
      <input type="text" id="filename" placeholder="ex: hero-empreendedor" />
      <p class="field__hint">Será salvo como <code>/site/uploads/[nome].png</code>. Use apenas letras, números e hífens.</p>
    </div>

    <button class="btn" id="generateBtn" onclick="generate()">
      <div class="spinner" id="spinner"></div>
      <span id="btnText">Gerar imagem</span>
    </button>

    <div class="error-box" id="errorBox"></div>

    <div class="result" id="result">
      <img id="resultImg" src="" alt="Imagem gerada" />
      <div class="result__meta">
        <span class="result__filename" id="resultFilename"></span>
        <span class="result__copy" onclick="copyPath()">Copiar caminho</span>
      </div>
      <div class="result__revised" id="resultRevised" style="display:none">
        <strong>Prompt revisado pelo DALL-E:</strong>
        <span id="revisedText"></span>
      </div>
    </div>
  </div>

  <script>
    function setPrompt(el) {
      document.getElementById('prompt').value = el.textContent.trim();
      document.getElementById('prompt').focus();
    }

    async function generate() {
      const prompt   = document.getElementById('prompt').value.trim();
      const filename = document.getElementById('filename').value.trim() || ('image-' + Date.now());
      const btn      = document.getElementById('generateBtn');
      const spinner  = document.getElementById('spinner');
      const btnText  = document.getElementById('btnText');
      const errorBox = document.getElementById('errorBox');
      const result   = document.getElementById('result');

      if (!prompt) { alert('Digite um prompt.'); return; }

      // Loading state
      btn.disabled    = true;
      spinner.style.display = 'block';
      btnText.textContent   = 'Gerando... pode levar até 30s';
      errorBox.style.display = 'none';
      result.style.display   = 'none';

      try {
        const res  = await fetch('/api/generate-image.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ prompt, filename }),
        });
        const data = await res.json();

        if (!data.success) throw new Error(data.error || 'Erro desconhecido');

        // Show result
        document.getElementById('resultImg').src      = data.url;
        document.getElementById('resultFilename').textContent = data.url;
        result.style.display = 'block';

        if (data.revised_prompt && data.revised_prompt !== prompt) {
          document.getElementById('revisedText').textContent = data.revised_prompt;
          document.getElementById('resultRevised').style.display = 'block';
        }

        window._lastPath = data.url;

      } catch (err) {
        errorBox.textContent   = '❌ ' + err.message;
        errorBox.style.display = 'block';
      } finally {
        btn.disabled = false;
        spinner.style.display = 'none';
        btnText.textContent   = 'Gerar imagem';
      }
    }

    function copyPath() {
      navigator.clipboard.writeText(window._lastPath || '');
      event.target.textContent = 'Copiado!';
      setTimeout(() => event.target.textContent = 'Copiar caminho', 2000);
    }
  </script>
</body>
</html>
