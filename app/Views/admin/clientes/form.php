<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $titulo ?></h3>
    </div>
    <form action="<?= isset($cliente) ? base_url('admin/clientes/atualizar/' . $cliente['idClientes']) : base_url('admin/clientes/criar') ?>" method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nomeCliente" class="form-control" required 
                               value="<?= isset($cliente) ? $cliente['nomeCliente'] : old('nomeCliente') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="Pessoa Física">Pessoa Física</option>
                            <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Documento (CPF/CNPJ)</label>
                        <input type="text" name="documento" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control telefone" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telefone 2</label>
                        <input type="text" name="telefone2" class="form-control telefone">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('admin/clientes') ?>" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
