#!/usr/bin/env python3
"""
sync-guideline.py
Reads CSS custom properties from style.css :root block and updates
color values in paginas/guideline.php to stay in sync.
"""
import re
import os

BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
CSS_FILE = os.path.join(BASE_DIR, "style.css")
GUIDELINE_FILE = os.path.join(BASE_DIR, "paginas", "guideline.php")

# CSS tokens to sync → (css_var, php_array_token)
TOKENS = [
    ("--primary",      "--primary"),
    ("--primary-dark", "--primary-dark"),
    ("--accent",       "--accent"),
]


def extract_root_vars(css_path):
    """Parse :root { } block and return {var: hex} dict."""
    with open(css_path, "r", encoding="utf-8") as f:
        css = f.read()

    root_match = re.search(r":root\s*\{([^}]+)\}", css, re.DOTALL)
    if not root_match:
        return {}

    vars_block = root_match.group(1)
    pattern = re.compile(r"(--[\w-]+)\s*:\s*(#[0-9A-Fa-f]{3,8})")
    return {m.group(1): m.group(2) for m in pattern.finditer(vars_block)}


def update_guideline(guideline_path, token_map):
    """Replace hard-coded hex values in the PHP $colors array and inline strings."""
    with open(guideline_path, "r", encoding="utf-8") as f:
        content = f.read()

    original = content

    # 1. Update $colors PHP array entries:
    #    ['--primary', '#XXXXXX', ...]  →  ['--primary', '#YYYYYY', ...]
    for token, new_hex in token_map.items():
        content = re.sub(
            r"(\['" + re.escape(token) + r"',\s*')(#[0-9A-Fa-f]{3,8})(')",
            lambda m, h=new_hex: m.group(1) + h + m.group(3),
            content,
        )

    # 2. Update gradient CSS strings that reference old primary/accent hex values
    primary = token_map.get("--primary", "")
    primary_dark = token_map.get("--primary-dark", "")
    accent = token_map.get("--accent", "")

    if primary and primary_dark:
        content = re.sub(
            r"linear-gradient\(135deg,\s*#[0-9A-Fa-f]{3,8},\s*#[0-9A-Fa-f]{3,8}\)",
            f"linear-gradient(135deg, {primary}, {primary_dark})",
            content,
            count=1,
        )

    if accent and primary:
        content = re.sub(
            r"linear-gradient\(90deg,\s*#[0-9A-Fa-f]{3,8},\s*#[0-9A-Fa-f]{3,8}\)",
            f"linear-gradient(90deg, {accent}, {primary})",
            content,
            count=1,
        )

    # 3. Update inline logo background (fundo primário demo)
    if primary:
        content = re.sub(
            r"(background:#)[0-9A-Fa-f]{3,8}(;padding:40px;display:flex;align-items:center;justify-content:center;min-height:120px)",
            lambda m, h=primary: m.group(1) + h.lstrip("#") + m.group(2),
            content,
        )

    # 4. Update label section inline color in typography array
    if primary:
        content = re.sub(
            r"(text-transform:uppercase;color:#)[0-9A-Fa-f]{3,8}",
            lambda m, h=primary: m.group(1) + h.lstrip("#"),
            content,
        )

    # 5. Update "(#ACCENT) em fundos escuros, ou ... (#PRIMARY) em fundos claros"
    if accent:
        content = re.sub(
            r"\(#[0-9A-Fa-f]{3,8}\)( em fundos escuros)",
            f"({accent})\\1",
            content,
        )
    if primary:
        content = re.sub(
            r"\(#[0-9A-Fa-f]{3,8}\)( em fundos claros)",
            f"({primary})\\1",
            content,
        )

    # 6. Update table text "#PRIMARY" reference
    if primary:
        content = re.sub(
            r"(Fundos na cor primária \(#)[0-9A-Fa-f]{3,8}(\))",
            lambda m, h=primary: m.group(1) + h.lstrip("#") + m.group(2),
            content,
        )

    # 7. Update .gl-code .token-key color
    if accent:
        content = re.sub(
            r"(\.token-key\s*\{\s*color:\s*)#[0-9A-Fa-f]{3,8}",
            lambda m, h=accent: m.group(1) + h,
            content,
        )

    if content != original:
        with open(guideline_path, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"guideline.php synced: {', '.join(f'{k}={v}' for k, v in token_map.items())}")
    else:
        print("guideline.php already up to date.")


if __name__ == "__main__":
    vars_map = extract_root_vars(CSS_FILE)
    token_map = {
        token: vars_map[token]
        for token in [t[0] for t in TOKENS]
        if token in vars_map
    }
    if not token_map:
        print("No CSS variables found — check style.css :root block.")
    else:
        update_guideline(GUIDELINE_FILE, token_map)
