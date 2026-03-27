<?php
// head-page.php — usado pelas páginas internas (site/paginas/)
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $page_title ?? 'nidex' ?></title>
  <meta name="description" content="<?= $page_description ?? '' ?>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/site/assets/css/variables.css" />
  <link rel="stylesheet" href="/site/assets/css/reset.css" />
  <link rel="stylesheet" href="/site/assets/css/global.css" />
  <link rel="stylesheet" href="/site/assets/css/components.css" />
  <link rel="stylesheet" href="/site/assets/css/sections.css" />
  <link rel="stylesheet" href="/site/assets/css/inner-pages.css" />
  <link rel="stylesheet" href="/site/assets/css/responsive.css" />
  <link rel="icon" href="/site/uploads/favicon.png" type="image/png" />
</head>
