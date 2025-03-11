<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Configurações da Empresa</h3>
            </div>
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nome da Empresa</label>
                        <input type="text" name="empresa_nome" class="form-control" value="<?= $configuracoes['empresa_nome'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" name="empresa_cnpj" class="form-control cnpj" value="<?= $configuracoes['empresa_cnpj'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>CRECI</label>
                        <input type="text" name="empresa_creci" class="form-control" value="<?= $configuracoes['empresa_creci'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="empresa_telefone" class="form-control telefone" value="<?= $configuracoes['empresa_telefone'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="empresa_email" class="form-control" value="<?= $configuracoes['empresa_email'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="empresa_logo" class="form-control">
                        <?php if (!empty($configuracoes['empresa_logo'])): ?>
                            <img src="<?= base_url('uploads/' . $configuracoes['empresa_logo']) ?>" 
                                 alt="Logo" class="mt-2" style="max-height: 100px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
