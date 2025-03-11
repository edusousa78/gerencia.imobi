<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nova Ocorrência</h3>
    </div>
    <form action="<?= base_url('admin/ocorrencias/criar') ?>" method="post">
        <input type="hidden" name="idLocacao" value="<?= $locacao['idLocacao'] ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="manutencao">Manutenção</option>
                            <option value="reclamacao">Reclamação</option>
                            <option value="vistoria">Vistoria</option>
                            <option value="notificacao">Notificação</option>
                            <option value="outros">Outros</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="aberto">Aberto</option>
                            <option value="em_andamento">Em Andamento</option>
                            <option value="resolvido">Resolvido</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4" required></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('admin/ocorrencias/' . $locacao['idLocacao']) ?>" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
