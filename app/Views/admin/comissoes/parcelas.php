<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Parcelas da Comissão</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/comissoes/recibo-parcela/' . $parcela['idParcela']) ?>" 
               class="btn btn-info btn-sm">
                <i class="fas fa-file-pdf"></i> Gerar Recibo
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Corretor:</strong> <?= $comissao['corretor'] ?><br>
                <strong>Valor Total:</strong> R$ <?= number_format($comissao['valor'], 2, ',', '.') ?><br>
                <strong>Venda:</strong> <?= $comissao['imovel'] ?>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nº Parcela</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Data Pagamento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parcelas as $parcela): ?>
                <tr>
                    <td><?= $parcela['numeroParcela'] ?></td>
                    <td>R$ <?= number_format($parcela['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($parcela['vencimento'])) ?></td>
                    <td><?= $parcela['dataPagamento'] ? date('d/m/Y', strtotime($parcela['dataPagamento'])) : '-' ?></td>
                    <td>
                        <span class="badge badge-<?= $parcela['status'] == 'Pago' ? 'success' : 
                            ($parcela['status'] == 'Pendente' ? 'warning' : 'danger') ?>">
                            <?= $parcela['status'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($parcela['status'] == 'Pendente'): ?>
                        <button class="btn btn-success btn-sm registrar-pagamento-parcela" 
                                data-id="<?= $parcela['idParcela'] ?>"
                                data-valor="<?= $parcela['valor'] ?>">
                            <i class="fas fa-dollar-sign"></i> Pagar
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pagamento Parcela -->
<div class="modal fade" id="modalPagamentoParcela">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Pagamento de Parcela</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/comissoes/pagar-parcela') ?>" method="post">
                <input type="hidden" name="idParcela" id="idParcela">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data do Pagamento</label>
                        <input type="date" name="dataPagamento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Valor da Parcela</label>
                        <input type="text" id="valorParcela" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('.registrar-pagamento-parcela').click(function() {
        var id = $(this).data('id');
        var valor = $(this).data('valor');
        $('#idParcela').val(id);
        $('#valorParcela').val('R$ ' + valor.toFixed(2).replace('.', ','));
        $('#modalPagamentoParcela').modal('show');
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
