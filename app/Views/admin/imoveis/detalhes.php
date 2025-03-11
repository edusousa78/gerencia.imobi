<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detalhes do Imóvel</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/imoveis/editar/' . $imovel['idImovel']) ?>" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="<?= base_url('admin/imoveis/midias/' . $imovel['idImovel']) ?>" class="btn btn-success btn-sm">
                <i class="fas fa-images"></i> Fotos
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <!-- Galeria de Fotos -->
                <div id="carouselImovel" class="carousel slide mb-4" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($midias as $key => $midia): ?>
                        <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                            <img src="<?= base_url('uploads/imoveis/' . $midia['url']) ?>" 
                                 class="d-block w-100" style="height: 400px; object-fit: cover;" 
                                 alt="Foto Imóvel">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselImovel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselImovel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>

                <!-- Descrição -->
                <div class="card">
                    <div class="card-header">
                        <h4>Descrição</h4>
                    </div>
                    <div class="card-body">
                        <?= $imovel['descricao'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Informações Básicas -->
                <div class="card">
                    <div class="card-header">
                        <h4>Informações Básicas</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Código:</strong> #<?= $imovel['idImovel'] ?></p>
                        <p><strong>Tipo:</strong> <?= $imovel['tipo'] ?></p>
                        <p><strong>Valor:</strong> R$ <?= number_format($imovel['valor'], 2, ',', '.') ?></p>
                        <p><strong>Status:</strong> 
                            <span class="badge badge-<?= $imovel['status'] == 'disponível' ? 'success' : 'warning' ?>">
                                <?= ucfirst($imovel['status']) ?>
                            </span>
                        </p>
                        <p><strong>Área:</strong> <?= $imovel['metragem'] ?>m²</p>
                        <p><strong>Quartos:</strong> <?= $imovel['quartos'] ?></p>
                        <p><strong>Banheiros:</strong> <?= $imovel['banheiros'] ?></p>
                        <p><strong>Vagas:</strong> <?= $imovel['vagas'] ?></p>
                    </div>
                </div>

                <!-- Localização -->
                <div class="card">
                    <div class="card-header">
                        <h4>Localização</h4>
                    </div>
                    <div class="card-body">
                        <p><?= $imovel['endereco'] ?></p>
                        <p><?= $imovel['cidade'] ?>/<?= $imovel['estado'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
