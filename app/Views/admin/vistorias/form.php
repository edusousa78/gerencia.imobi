<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nova Vistoria</h3>
    </div>
    <form action="<?= base_url('admin/vistorias/criar') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idLocacao" value="<?= $locacao['idLocacao'] ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="entrada">Vistoria de Entrada</option>
                            <option value="saida">Vistoria de Saída</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data</label>
                        <input type="date" name="data" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Observações Gerais</label>
                <textarea name="observacoes" class="form-control" rows="3"></textarea>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Itens da Vistoria</h4>
                </div>
                <div class="card-body">
                    <div id="itens-vistoria">
                        <div class="item-vistoria">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cômodo</label>
                                        <input type="text" name="itens[comodo][]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Item</label>
                                        <input type="text" name="itens[item][]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select name="itens[estado][]" class="form-control" required>
                                            <option value="Ótimo">Ótimo</option>
                                            <option value="Bom">Bom</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Ruim">Ruim</option>
                                            <option value="Péssimo">Péssimo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" name="itens[foto][]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm mt-2" id="adicionar-item">
                        <i class="fas fa-plus"></i> Adicionar Item
                    </button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('admin/vistorias/' . $locacao['idLocacao']) ?>" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#adicionar-item').click(function() {
        var clone = $('.item-vistoria:first').clone();
        clone.find('input').val('');
        $('#itens-vistoria').append(clone);
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
