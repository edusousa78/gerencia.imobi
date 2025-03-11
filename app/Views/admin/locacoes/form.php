<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $titulo ?></h3>
    </div>
    <form action="<?= base_url('admin/locacoes/criar') ?>" method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">ol-md-6">
                    <div class="form-group">roup">
                        <label>Imóvel</label>>
                        <select name="idImovel" class="form-control" required>l" class="form-control" required>
                            <option value="">Selecione...</option>
                            <?php foreach($imoveis as $imovel): ?>
                            <option value="<?= $imovel['idImovel'] ?>">?>">
                                <?= $imovel['titulo'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">lass="col-md-6">
                    <div class="form-group">    <div class="form-group">
                        <label>Locador</label>      <label>Locador</label>
                        <select name="idLocador" class="form-control" required>                        <select name="idLocador" class="form-control" required>
                            <option value="">Selecione...</option>option value="">Selecione...</option>
                            <?php foreach($locadores as $locador): ?>ach($locadores as $locador): ?>
                            <option value="<?= $locador['idClientes'] ?>">?= $locador['idClientes'] ?>">
                                <?= $locador['nomeCliente'] ?>nomeCliente'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- ... resto do formulário ... -->-->
            
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('admin/locacoes') ?>" class="btn btn-default">Cancelar</a>?= base_url('admin/locacoes') ?>" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
