<?= $this->extend('site/templates/default') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filtros</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('imoveis') ?>" method="get">
                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select">
                                <option value="">Todos</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Casa">Casa</option>
                                <option value="Terreno">Terreno</option>
                                <option value="Comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cidade</label>
                            <input type="text" name="cidade" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($imoveis as $imovel): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="<?= base_url('uploads/imoveis/' . ($imovel['thumb'] ?? 'default.jpg')) ?>" 
                             class="card-img-top" alt="<?= $imovel['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $imovel['titulo'] ?></h5>
                            <p class="card-text text-muted"><?= $imovel['cidade'] ?>/<?= $imovel['estado'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="features">
                                    <span class="me-2"><i class="fas fa-bed"></i> <?= $imovel['quartos'] ?></span>
                                    <span class="me-2"><i class="fas fa-bath"></i> <?= $imovel['banheiros'] ?></span>
                                    <span><i class="fas fa-car"></i> <?= $imovel['vagas'] ?></span>
                                </div>
                                <div class="price">
                                    <strong>R$ <?= number_format($imovel['valor'], 2, ',', '.') ?></strong>
                                </div>
                            </div>
                            <a href="<?= base_url('imovel/' . $imovel['idImovel']) ?>" 
                               class="btn btn-primary w-100 mt-3">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
