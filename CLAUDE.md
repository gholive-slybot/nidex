# CLAUDE.md — Nidex Site

Você está construindo o site da **Nidex**, uma plataforma SaaS brasileira de gestão para empreendedores. Este arquivo define as diretrizes visuais e técnicas do projeto. A estrutura de páginas e seções será definida durante o desenvolvimento — siga sempre as instruções do usuário sobre o que construir.

---

## Sobre o Produto

**Nidex** é um ecossistema inteligente all-in-one para empreendedores: CRM, financeiro, cobranças, tarefas, projetos e IA integrada em um único lugar.

**Público-alvo**: empreendedores, pequenas e médias empresas.  
**Objetivo do site**: conversão — leads, demos ou trial.

---

## Identidade Visual

### Cores

| Token | Hex | Uso |
|---|---|---|
| `primary` | `#2563EB` | Botões principais, links, destaques |
| `primary-dark` | `#1D4ED8` | Hover de botões, gradientes |
| `accent` | `#38BDF8` | Palavras em destaque nas headlines, ícones |
| `bg-dark` | `#0F172A` | Fundo de seções escuras (IA, mobile, hero overlay) |
| `bg-light` | `#F8FAFC` | Fundo de seções claras |
| `bg-white` | `#FFFFFF` | Cards, navbar, footer |
| `text-primary` | `#0F172A` | Texto principal |
| `text-muted` | `#64748B` | Texto secundário, subtítulos |
| `border` | `#E2E8F0` | Bordas de cards e divisores |

### Gradientes

```css
/* Gradiente principal — usar em botões CTA e destaques */
background: linear-gradient(135deg, #2563EB, #1D4ED8);

/* Gradiente hero — overlay sobre foto de fundo */
background: linear-gradient(to bottom, rgba(15,23,42,0.7), rgba(15,23,42,0.85));

/* Gradiente sutil de seção escura */
background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%);
```

### Tipografia

- **Fonte**: Inter (via `next/font/google`)
- **Headline grande**: `font-size: 3.5rem–5rem`, `font-weight: 700–800`, `line-height: 1.1`
- **Headline médio**: `font-size: 2rem–2.75rem`, `font-weight: 700`
- **Corpo**: `font-size: 1rem–1.125rem`, `font-weight: 400`, `line-height: 1.7`
- **Labels de seção**: `font-size: 0.75rem`, `font-weight: 600`, `letter-spacing: 0.1em`, `text-transform: uppercase`, cor `primary`
- **Destaque em headline**: palavras-chave em `accent` (`#38BDF8`) ou `primary` (`#2563EB`)

### Logo

- Texto "nidex" sempre em **minúsculo**
- Cor: `#2563EB` em fundos claros / branco em fundos escuros
- Nunca distorcer, rotacionar ou alterar as cores

---

## Elementos Visuais

### Cards
- `border-radius: 12px–16px`
- `border: 1px solid #E2E8F0` em fundos claros
- `border: 1px solid rgba(255,255,255,0.08)` em fundos escuros
- Sombra suave: `box-shadow: 0 4px 24px rgba(0,0,0,0.06)`
- Padding interno: `24px–32px`

### Botões
- **Primário**: fundo `#2563EB`, texto branco, `border-radius: 8px`, padding `12px 24px`, hover escurece para `#1D4ED8`
- **Secundário/Outline**: borda `#2563EB`, texto `#2563EB`, fundo transparente, hover com fundo `#EFF6FF`
- **Ghost (fundo escuro)**: borda branca semitransparente, texto branco
- Todos os botões com `font-weight: 600` e transição suave `transition: all 0.2s`

### Seções
- Alternar entre fundos claros (`#F8FAFC` / `#FFFFFF`) e escuros (`#0F172A`)
- Padding vertical padrão: `80px–120px`
- Container máximo: `max-width: 1200px`, centralizado com `margin: 0 auto`

### Mockups de Produto
- Usar screenshots reais do dashboard Nidex quando disponíveis (pasta `public/images/mockups/`)
- Exibir com sombra destacada: `box-shadow: 0 24px 64px rgba(0,0,0,0.2)`
- Em seções escuras, adicionar brilho sutil na borda: `border: 1px solid rgba(255,255,255,0.1)`
- Preferir disposição em ângulo/perspectiva leve para efeito premium

### Animações
- Usar **Framer Motion** para scroll reveals
- Padrão: `opacity: 0 → 1`, `y: 24 → 0`, `duration: 0.5s`, `ease: easeOut`
- Não exagerar — animações devem ser sutis e rápidas
- `staggerChildren: 0.1` para listas de cards

---

## Stack Tecnológica

- **Backend**: PHP 8+
- **Frontend**: HTML5, CSS3 (custom, sem framework), JavaScript (vanilla)
- **CMS**: PHP + MySQL (pasta `cms/`)
- **Animações**: CSS transitions + IntersectionObserver (`script.js`)
- **Deploy**: Apache + mod_rewrite

## Estrutura de Arquivos

```
index.php          — Homepage principal
style.css          — Todos os estilos
script.js          — JavaScript global
paginas/           — Páginas internas
  ├── blog.php
  ├── post.php
  ├── treinamento.php
  ├── desenvolvimento.php
  ├── consultoria.php
  ├── servicos.php
  └── guideline.php
cms/               — Painel administrativo
api/               — Endpoints PHP (contato, etc.)
uploads/           — Uploads de imagens
```

---

## Regras de Desenvolvimento

1. **Mobile-first** — responsivo em 375px / 768px / 1280px
2. **Performance** — atributo `loading="lazy"` em todas as imagens
3. **Acessibilidade** — tags semânticas (`<section>`, `<nav>`, `<main>`), aria-labels
4. **Caminhos absolutos** — páginas em `paginas/` usam `/style.css` e `/script.js`
5. **Seções novas** — adicionar em `index.php` + estilos em `style.css`
6. **PHP includes** — páginas em `paginas/` usam `dirname(__DIR__)` para includes do config

---

## Tom de Voz

- Direto, empoderador, focado em resultado
- Fala com o empreendedor, não com o TI
- Evitar jargão técnico e frases genéricas
- Headlines curtas e impactantes com palavra de destaque colorida