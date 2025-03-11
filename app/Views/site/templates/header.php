<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <?php if (!empty($configuracoes['empresa_logo'])): ?>
                    <img src="<?= base_url('uploads/' . $configuracoes['empresa_logo']) ?>" height="40" alt="Logo">
                <?php else: ?>
                    <?= $configuracoes['empresa_nome'] ?? 'Imobiliária' ?>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('imoveis') ?>">Imóveis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('sobre') ?>">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contato') ?>">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
