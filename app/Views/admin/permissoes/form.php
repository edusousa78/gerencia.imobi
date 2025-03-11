<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $titulo ?></h3>
    </div>
    <form action="<?= isset($permissao) ? base_url('admin/permissoes/atualizar/' . $permissao['idPermissao']) : base_url('admin/permissoes/criar') ?>" method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nome da Permissão</label>
                        <input type="text" name="nome" class="form-control" value="<?= isset($permissao) ? $permissao['nome'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Situação</label>
                        <select name="situacao" class="form-control">
                            <option value="1" <?= (isset($permissao) && $permissao['situacao'] == 1) ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= (isset($permissao) && $permissao['situacao'] == 0) ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <?php 
                $permissoesAtuais = isset($permissao) ? unserialize($permissao['permissoes']) : [];
                foreach ($modulos as $modulo => $acoes): 
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white"><?= $modulo ?></h3>
                        </div>
                        <div class="card-body">
                            <?php foreach ($acoes as $acao): ?>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="<?= $acao ?>"
                                       name="permissoes[]" 
                                       value="<?= $acao ?>"
                                       <?= isset($permissoesAtuais[$acao]) ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="<?= $acao ?>">
                                    <?= str_replace(
                                        ['a','e','d','v','c'], 
                                        ['Adicionar ','Editar ','Deletar ','Visualizar ','Configurar '],
                                        $acao
                                    ) ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
            </button>
            <a href="<?= base_url('admin/permissoes') ?>" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </form>
</div>

<?= $this->section('styles') ?>
<style>
.custom-switch .custom-control-label::before {
    width: 2.5rem;
}
.custom-switch .custom-control-label::after {
    left: calc(-2.5rem + 2px);
}
.custom-switch .custom-control-input:checked~.custom-control-label::after {
    transform: translateX(1.5rem);
}
</style>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
