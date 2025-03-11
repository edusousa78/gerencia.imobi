<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestão de Imóveis</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/imoveis/novo') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Novo Imóvel
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="80">Foto</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($imoveis as $imovel): ?>
                    <tr>
                        <td>
                            <?php if(isset($imovel['foto_capa'])): ?>
                                <img src="<?= base_url('uploads/imoveis/' . $imovel['foto_capa']) ?>" 
                                     alt="Thumbnail" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/no-image.jpg') ?>" 
                                     alt="Sem foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?= $imovel['titulo'] ?></td>
                        <td><?= $imovel['tipo'] ?></td>
                        <td>R$ <?= number_format($imovel['valor'], 2, ',', '.') ?></td>
                        <td>
                            <span class="badge badge-<?= $imovel['status'] == 'disponível' ? 'success' : 
                                ($imovel['status'] == 'alugado' ? 'info' : 'warning') ?>">
                                <?= ucfirst($imovel['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/imoveis/detalhes/' . $imovel['idImovel']) ?>" 
                                   class="btn btn-info btn-sm" title="Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/imoveis/editar/' . $imovel['idImovel']) ?>" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/imoveis/midias/' . $imovel['idImovel']) ?>" 
                                   class="btn btn-success btn-sm" title="Fotos">
                                    <i class="fas fa-images"></i>
                                </a>
                                <button onclick="excluirImovel(<?= $imovel['idImovel'] ?>)" 
                                        class="btn btn-danger btn-sm" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('#tabelaImoveis').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        }
    });
});

function excluirImovel(id) {
    if (confirm('Tem certeza que deseja excluir este imóvel?')) {
        window.location.href = '<?= base_url('admin/imoveis/excluir/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
