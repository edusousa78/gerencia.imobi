<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $configuracoes['empresa_nome'] ?? 'Imobiliária' ?> - <?= $titulo ?? '' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/site/css/style.css') ?>" rel="stylesheet">
</head>
<body>
    <?= $this->include('site/templates/header') ?>
    
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('site/templates/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
