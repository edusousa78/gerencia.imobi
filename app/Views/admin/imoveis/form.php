<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $titulo ?></h3>
    </div>
    <form action="<?= isset($imovel) ? base_url('admin/imoveis/atualizar/' . $imovel['idImovel']) : base_url('admin/imoveis/criar') ?>" 
          method="post" enctype="multipart/form-data">
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="titulo" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['titulo'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Empreendimento</label>
                        <select name="idEmpreendimento" class="form-control">
                            <option value="">Selecione...</option>
                            <?php foreach ($empreendimentos as $emp): ?>
                                <option value="<?= $emp['idEmpreendimento'] ?>" 
                                    <?= (isset($imovel) && $imovel['idEmpreendimento'] == $emp['idEmpreendimento']) ? 'selected' : '' ?>>
                                    <?= $emp['nome'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="disponível" <?= (isset($imovel) && $imovel['status'] == 'disponível') ? 'selected' : '' ?>>
                                Disponível
                            </option>
                            <option value="vendido" <?= (isset($imovel) && $imovel['status'] == 'vendido') ? 'selected' : '' ?>>
                                Vendido
                            </option>
                            <option value="alugado" <?= (isset($imovel) && $imovel['status'] == 'alugado') ? 'selected' : '' ?>>
                                Alugado
                            </option>
                            <option value="inativo" <?= (isset($imovel) && $imovel['status'] == 'inativo') ? 'selected' : '' ?>>
                                Inativo
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control summernote" rows="5"><?= isset($imovel) ? $imovel['descricao'] : '' ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="Apartamento" <?= (isset($imovel) && $imovel['tipo'] == 'Apartamento') ? 'selected' : '' ?>>
                                Apartamento
                            </option>
                            <option value="Casa" <?= (isset($imovel) && $imovel['tipo'] == 'Casa') ? 'selected' : '' ?>>
                                Casa
                            </option>
                            <option value="Terreno" <?= (isset($imovel) && $imovel['tipo'] == 'Terreno') ? 'selected' : '' ?>>
                                Terreno
                            </option>
                            <option value="Comercial" <?= (isset($imovel) && $imovel['tipo'] == 'Comercial') ? 'selected' : '' ?>>
                                Comercial
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Removendo seção duplicada de quartos/banheiros/vagas e mesclando em uma única row -->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Área (m²)</label>
                        <input type="number" step="0.01" name="metragem" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['metragem'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Quartos</label>
                        <input type="number" name="quartos" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['quartos'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Banheiros</label>
                        <input type="number" name="banheiros" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['banheiros'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Vagas</label>
                        <input type="number" name="vagas" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['vagas'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="text" name="valor" class="form-control money" required
                               value="<?= isset($imovel) ? number_format($imovel['valor'], 2, ',', '.') : '' ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['endereco'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" required
                               value="<?= isset($imovel) ? $imovel['cidade'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" class="form-control" required>
                            <?php foreach($estados as $uf => $estado): ?>
                                <option value="<?= $uf ?>" <?= (isset($imovel) && $imovel['estado'] == $uf) ? 'selected' : '' ?>>
                                    <?= $uf ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
            </button>
            <a href="<?= base_url('admin/imoveis') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </form>
</div>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });

    $('.money').inputmask('decimal', {
        radixPoint: ",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        prefix: 'R$ '
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
