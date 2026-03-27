# sync-guideline.ps1
# Reads :root CSS vars from style.css and syncs color values in guideline.php

$baseDir   = Split-Path -Parent $PSScriptRoot   # = NIDEX/site
$cssFile   = Join-Path $baseDir "assets\css\variables.css"
$guideFile = Join-Path $baseDir "paginas\guideline.php"

# Read style.css and extract :root variables
$css = Get-Content $cssFile -Raw -Encoding UTF8
if ($css -notmatch '(?s):root\s*\{([^}]+)\}') {
    Write-Host "ERROR: :root block not found in style.css"
    exit 1
}
$rootBlock = $Matches[1]

$vars = @{}
foreach ($m in [regex]::Matches($rootBlock, '(--[\w-]+)\s*:\s*(#[0-9A-Fa-f]{3,8})')) {
    $vars[$m.Groups[1].Value] = $m.Groups[2].Value
}

$primary     = $vars['--primary']
$primaryDark = $vars['--primary-dark']
$accent      = $vars['--accent']

if (-not $primary) {
    Write-Host "ERROR: --primary not found in :root"
    exit 1
}

Write-Host "Syncing: --primary=$primary  --primary-dark=$primaryDark  --accent=$accent"

$guide   = Get-Content $guideFile -Raw -Encoding UTF8
$original = $guide

# 1. PHP $colors array entries
$guide = $guide -replace "('--primary',\s*'#)[0-9A-Fa-f]{3,8}(')", "`${1}$($primary.TrimStart('#'))`$2"
$guide = $guide -replace "('--primary-dark',\s*'#)[0-9A-Fa-f]{3,8}(')", "`${1}$($primaryDark.TrimStart('#'))`$2"
$guide = $guide -replace "('--accent',\s*'#)[0-9A-Fa-f]{3,8}(')", "`${1}$($accent.TrimStart('#'))`$2"

# 2. gradient-primary CSS string
$guide = $guide -replace 'linear-gradient\(135deg,\s*#[0-9A-Fa-f]{3,8},\s*#[0-9A-Fa-f]{3,8}\)', "linear-gradient(135deg, $primary, $primaryDark)"

# 3. text-gradient CSS string
$guide = $guide -replace 'linear-gradient\(90deg,\s*#[0-9A-Fa-f]{3,8},\s*#[0-9A-Fa-f]{3,8}\)', "linear-gradient(90deg, $accent, $primary)"

# 4. Logo fundo primário background
$guide = $guide -replace '(background:#)[0-9A-Fa-f]{3,8}(;padding:40px;display:flex;align-items:center;justify-content:center;min-height:120px)', "`${1}$($primary.TrimStart('#'))`$2"

# 5. Token table text reference
$guide = $guide -replace '(Fundos na cor primária \(#)[0-9A-Fa-f]{3,8}(\))', "`${1}$($primary.TrimStart('#'))`$2"

# 6. Typography label inline color
$guide = $guide -replace '(text-transform:uppercase;color:#)[0-9A-Fa-f]{3,8}', "`${1}$($primary.TrimStart('#'))"

# 7. Inline text mentions "(#ACCENT) em fundos escuros"
$guide = $guide -replace '\(#[0-9A-Fa-f]{3,8}\)( em fundos escuros)', "($accent)`$1"
$guide = $guide -replace '\(#[0-9A-Fa-f]{3,8}\)( em fundos claros)', "($primary)`$1"

# 8. .token-key color
$guide = $guide -replace '(\.token-key\s*\{\s*color:\s*)#[0-9A-Fa-f]{3,8}', "`${1}$accent"

# Write only if changed
if ($guide -ne $original) {
    [System.IO.File]::WriteAllText($guideFile, $guide, [System.Text.Encoding]::UTF8)
    Write-Host "guideline.php updated successfully."
} else {
    Write-Host "guideline.php already up to date."
}
