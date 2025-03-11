<?= $this->extend('site/templates/default') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4"><?= $configuracoes['empresa_nome'] ?? 'Nossa Empresa' ?></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4">
                            <?php if (!empty($configuracoes['empresa_logo'])): ?>
                                <img src="<?= base_url('uploads/' . $configuracoes['empresa_logo']) ?>" 
                                     class="img-fluid" alt="Logo">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h5>Quem Somos</h5>
                            <p><?= $configuracoes['empresa_sobre'] ?? 'Texto sobre a empresa' ?></p>
                            <p>
                                <strong>CRECI:</strong> <?= $configuracoes['empresa_creci'] ?? '' ?><br>
                                <strong>CNPJ:</strong> <?= $configuracoes['empresa_cnpj'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Nossa Missão</h5>
                    <p><?= $configuracoes['empresa_missao'] ?? '' ?></p>

                    <h5 class="mt-4">Valores</h5>
                    <ul>
                        <li>Transparência em todas as negociações</li>
                        <li>Compromisso com nossos clientes</li>
                        <li>Excelência no atendimento</li>
                        <li>Ética profissional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
