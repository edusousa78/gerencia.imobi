<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ocorrências da Locação</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/ocorrencias/nova/' . $locacao['idLocacao']) ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Ocorrência
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Imóvel:</strong> <?= $locacao['imovel'] ?? '' ?>
            </div>
            <div class="col-md-6">
                <strong>Locatário:</strong> <?= $locacao['cliente'] ?? '' ?>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ocorrencias as $ocorrencia): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($ocorrencia['data'])) ?></td>
                    <td><?= ucfirst($ocorrencia['tipo']) ?></td>
                    <td><?= $ocorrencia['descricao'] ?></td>
                    <td><?= ucfirst(str_replace('_', ' ', $ocorrencia['status'])) ?></td>
                    <td>
                        <a href="<?= base_url('admin/ocorrencias/editar/' . $ocorrencia['idOcorrencia']) ?>" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
