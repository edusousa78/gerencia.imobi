<?= $this->extend('site/templates/default') ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h1>Encontre o Imóvel dos Seus Sonhos</h1>
                <form action="<?= base_url('imoveis') ?>" method="get" class="search-form">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="tipo" class="form-select">
                                <option value="">Tipo de Imóvel</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Casa">Casa</option>
                                <option value="Terreno">Terreno</option>
                                <option value="Comercial">Comercial</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cidade" class="form-control" placeholder="Cidade">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="featured-properties py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Imóveis em Destaque</h2>
        <div class="row">
            <?php foreach ($destaques as $imovel): ?>
            <div class="col-md-4 mb-4">
                <div class="card property-card">
                    <img src="<?= base_url('uploads/imoveis/' . ($imovel['thumb'] ?? 'default.jpg')) ?>" 
                         class="card-img-top" alt="<?= $imovel['titulo'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $imovel['titulo'] ?></h5>
                        <p class="card-text"><?= substr($imovel['descricao'], 0, 100) ?>...</p>
                        <div class="property-details">
                            <span><i class="fas fa-bed"></i> <?= $imovel['quartos'] ?> quartos</span>
                            <span><i class="fas fa-car"></i> <?= $imovel['vagas'] ?> vagas</span>
                            <span><i class="fas fa-ruler-combined"></i> <?= $imovel['metragem'] ?>m²</span>
                        </div>
                        <div class="property-price">
                            R$ <?= number_format($imovel['valor'], 2, ',', '.') ?>
                        </div>
                        <a href="<?= base_url('imovel/' . $imovel['idImovel']) ?>" 
                           class="btn btn-primary w-100">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
