<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Clientes</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/clientes/novo') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Novo Cliente
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['nomeCliente'] ?></td>
                    <td><?= $cliente['tipo'] ?></td>
                    <td><?= $cliente['documento'] ?></td>
                    <td><?= $cliente['telefone'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['status'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/clientes/editar/' . $cliente['idClientes']) ?>" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm btn-excluir" 
                                data-id="<?= $cliente['idClientes'] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
