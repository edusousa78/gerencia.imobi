<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestão de Comissões</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Corretor</th>
                    <th>Venda</th>
                    <th>Valor Comissão</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                    <th>Data Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comissoes as $comissao): ?>
                <tr>
                    <td><?= $comissao['corretor'] ?></td>
                    <td>R$ <?= number_format($comissao['valorVenda'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($comissao['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($comissao['dataVencimento'])) ?></td>
                    <td>
                        <span class="badge badge-<?= $comissao['status'] == 'Pago' ? 'success' : 
                            ($comissao['status'] == 'Pendente' ? 'warning' : 'danger') ?>">
                            <?= $comissao['status'] ?>
                        </span>
                    </td>
                    <td><?= $comissao['dataPagamento'] ? date('d/m/Y', strtotime($comissao['dataPagamento'])) : '-' ?></td>
                    <td>
                        <div class="btn-group">
                            <?php if ($comissao['status'] == 'Pendente'): ?>
                            <button type="button" class="btn btn-success btn-sm registrar-pagamento" 
                                    data-id="<?= $comissao['idComissao'] ?>">
                                <i class="fas fa-dollar-sign"></i> Registrar Pagamento
                            </button>
                            <?php endif; ?>
                            <a href="<?= base_url('admin/comissoes/recibo/' . $comissao['idComissao']) ?>"
                               class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-file-pdf"></i> Recibo
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Registrar Pagamento -->
<div class="modal fade" id="modalPagamento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Pagamento de Comissão</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/comissoes/pagar') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idComissao" id="idComissao">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data do Pagamento</label>
                        <input type="date" name="dataPagamento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Forma de Pagamento</label>
                        <select name="formaPagamento" class="form-control" required>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="PIX">PIX</option>
                            <option value="Transferência">Transferência</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Comprovante</label>
                        <input type="file" name="comprovante" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('.registrar-pagamento').click(function() {
        var id = $(this).data('id');
        $('#idComissao').val(id);
        $('#modalPagamento').modal('show');
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
