<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Vistorias da Locação #<?= $locacao['idLocacao'] ?></h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/vistorias/nova/' . $locacao['idLocacao']) ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Vistoria
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Observações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vistorias as $vistoria): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($vistoria['data'])) ?></td>
                    <td><?= $vistoria['tipo'] ?></td>
                    <td><?= $vistoria['observacoes'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/vistorias/editar/' . $vistoria['idVistoria']) ?>" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/vistorias/imprimir/' . $vistoria['idVistoria']) ?>" 
                           class="btn btn-secondary btn-sm" target="_blank">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
