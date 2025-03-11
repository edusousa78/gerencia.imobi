<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registrar Pagamento</h3>
    </div>
    <form action="<?= base_url('admin/pagamentos/criar') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idLocacao" value="<?= $locacao['idLocacao'] ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Competência</label>
                        <input type="month" name="competencia" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Vencimento</label>
                        <input type="date" name="vencimento" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Data Pagamento</label>
                        <input type="date" name="dataPagamento" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pendente">Pendente</option>
                            <option value="pago">Pago</option>
                            <option value="atrasado">Atrasado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Valor Aluguel</label>
                        <input type="number" step="0.01" name="valorAluguel" class="form-control" required
                               value="<?= $locacao['valorAluguel'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Valor IPTU</label>
                        <input type="number" step="0.01" name="valorIPTU" class="form-control"
                               value="<?= $locacao['valorIPTU'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Valor Condomínio</label>
                        <input type="number" step="0.01" name="valorCondominio" class="form-control"
                               value="<?= $locacao['valorCondominio'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Comprovante</label>
                        <input type="file" name="comprovante" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('admin/pagamentos/' . $locacao['idLocacao']) ?>" class="btn btn-default">Cancelar</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
