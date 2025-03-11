<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fotos do Imóvel: <?= $imovel['titulo'] ?></h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/imoveis') ?>" class="btn btn-secondary btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUpload">
                <i class="fas fa-upload"></i> Upload de Fotos
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($midias as $midia): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="<?= base_url('uploads/imoveis/' . $midia['url']) ?>" 
                         class="card-img-top" alt="Foto Imóvel"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="btn-group w-100">
                            <?php if (!$midia['thumbnail']): ?>
                            <button type="button" class="btn btn-info btn-sm" 
                                    onclick="definirCapa(<?= $midia['idMidia'] ?>)">
                                <i class="fas fa-star"></i> Definir Capa
                            </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-danger btn-sm" 
                                    onclick="excluirFoto(<?= $midia['idMidia'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <?php if ($midia['thumbnail']): ?>
                            <span class="badge badge-success mt-2">Foto de Capa</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload de Fotos</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/imoveis/upload-midia/' . $imovel['idImovel']) ?>" 
                  method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Selecione as Fotos</label>
                        <input type="file" name="fotos[]" class="form-control" multiple accept="image/*" required>
                        <small class="text-muted">Você pode selecionar várias fotos</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
function excluirFoto(id) {
    if (confirm('Tem certeza que deseja excluir esta foto?')) {
        window.location.href = '<?= base_url('admin/imoveis/excluir-midia/') ?>' + id;
    }
}

function definirCapa(id) {
    if (confirm('Definir esta foto como capa do imóvel?')) {
        window.location.href = '<?= base_url('admin/imoveis/definir-capa/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
