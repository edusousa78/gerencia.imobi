<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Propostas</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/propostas/nova') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Proposta
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Imóvel</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Válido até</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($propostas as $proposta): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($proposta['dataProposta'])) ?></td>
                    <td><?= $proposta['imovel'] ?></td>
                    <td><?= $proposta['cliente'] ?></td>
                    <td><?= ucfirst($proposta['tipo']) ?></td>
                    <td>R$ <?= number_format($proposta['valor'], 2, ',', '.') ?></td>
                    <td>
                        <span class="badge badge-<?= $proposta['status'] == 'aprovada' ? 'success' : 
                            ($proposta['status'] == 'em_analise' ? 'info' : 'danger') ?>">
                            <?= ucfirst(str_replace('_', ' ', $proposta['status'])) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($proposta['dataValidade'])) ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/propostas/editar/' . $proposta['idProposta']) ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/propostas/visualizar/' . $proposta['idProposta']) ?>" 
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
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
