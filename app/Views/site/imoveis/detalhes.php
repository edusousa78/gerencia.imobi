<?= $this->extend('site/templates/default') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div id="carouselImovel" class="carousel slide mb-4">
                <div class="carousel-inner">
                    <?php foreach ($fotos as $key => $foto): ?>
                    <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('uploads/imoveis/' . $foto['url']) ?>" 
                             class="d-block w-100" alt="Foto <?= $key + 1 ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImovel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImovel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>

            <h1 class="mb-4"><?= $imovel['titulo'] ?></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Descrição</h5>
                    <p><?= nl2br($imovel['descricao']) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="text-primary mb-3">
                        R$ <?= number_format($imovel['valor'], 2, ',', '.') ?>
                    </h3>
                    <div class="mb-3">
                        <strong>Tipo:</strong> <?= $imovel['tipo'] ?>
                    </div>
                    <div class="mb-3">
                        <strong>Área:</strong> <?= $imovel['metragem'] ?>m²
                    </div>
                    <div class="mb-3">
                        <strong>Localização:</strong><br>
                        <?= $imovel['endereco'] ?><br>
                        <?= $imovel['cidade'] ?>/<?= $imovel['estado'] ?>
                    </div>
                    <hr>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalContato">
                            <i class="fas fa-envelope"></i> Entrar em Contato
                        </button>
                        <a href="https://wa.me/<?= $configuracoes['empresa_whatsapp'] ?? '' ?>" 
                           class="btn btn-success" target="_blank">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Contato -->
<div class="modal fade" id="modalContato" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Solicitar Informações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('contato/enviar') ?>" method="post">
                <input type="hidden" name="imovel_id" value="<?= $imovel['idImovel'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control telefone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea name="mensagem" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
