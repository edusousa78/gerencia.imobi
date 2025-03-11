<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gerenciar Permissões</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/permissoes/nova') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Permissão
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Situação</th>
                    <th>Data Cadastro</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permissoes as $permissao): ?>
                <tr>
                    <td><?= $permissao['nome'] ?></td>
                    <td>
                        <?php if($permissao['situacao'] == 1): ?>
                            <span class="badge badge-success">Ativo</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Inativo</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('d/m/Y', strtotime($permissao['data'])) ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/permissoes/editar/' . $permissao['idPermissao']) ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <?php if($permissao['idPermissao'] != 1): // Não permite excluir Admin ?>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="confirmarExclusao(<?= $permissao['idPermissao'] ?>)">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
function confirmarExclusao(id) {
    if (confirm('Tem certeza que deseja excluir esta permissão?')) {
        window.location.href = '<?= base_url('admin/permissoes/excluir/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
