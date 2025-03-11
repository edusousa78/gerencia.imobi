<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Empreendimentos</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/empreendimentos/novo') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Novo Empreendimento
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Cidade/UF</th>
                    <th>Status</th>
                    <th>Valor Médio</th>
                    <th>Unidades</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empreendimentos as $empreendimento): ?>
                <tr>
                    <td><?= $empreendimento['nome'] ?></td>
                    <td><?= $empreendimento['tipo'] ?></td>
                    <td><?= $empreendimento['cidade'] ?>/<?= $empreendimento['estado'] ?></td>
                    <td><span class="badge badge-info"><?= ucfirst($empreendimento['status']) ?></span></td>
                    <td>R$ <?= number_format($empreendimento['valorMedio'], 2, ',', '.') ?></td>
                    <td><?= $empreendimento['numUnidades'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/empreendimentos/editar/' . $empreendimento['idEmpreendimento']) ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/empreendimentos/imoveis/' . $empreendimento['idEmpreendimento']) ?>" 
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-building"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
