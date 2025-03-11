<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gestão de Comissões - Venda #<?= $venda['idVenda'] ?></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Corretor</th>
                        <th>CRECI</th>
                        <th>Valor Venda</th>
                        <th>% Comissão</th>
                        <th>Valor Comissão</th>
                        <th>Status</th>
                        <th>Data Pagamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comissoes as $comissao): ?>
                    <tr>
                        <td><?= $comissao->corretor ?></td>
                        <td><?= $comissao->creci ?></td>
                        <td>R$ <?= number_format($comissao->valorVenda, 2, ',', '.') ?></td>
                        <td><?= $comissao->percentual ?>%</td>
                        <td>R$ <?= number_format($comissao->valor, 2, ',', '.') ?></td>
                        <td>
                            <span class="badge bg-<?= $comissao->status == 'Pago' ? 'success' : 'warning' ?>">
                                <?= $comissao->status ?>
                            </span>
                        </td>
                        <td><?= $comissao->dataPagamento ? date('d/m/Y', strtotime($comissao->dataPagamento)) : '-' ?></td>
                        <td>
                            <div class="btn-group">
                                <?php if ($comissao->status != 'Pago'): ?>
                                <button type="button" class="btn btn-success btn-sm" 
                                        onclick="pagarComissao(<?= $comissao->idComissao ?>)">
                                    <i class="fas fa-dollar-sign"></i>
                                </button>
                                <?php endif; ?>
                                <a href="<?= base_url('admin/vendas/comissoes/recibo/' . $comissao->idComissao) ?>" 
                                   class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
function pagarComissao(id) {
    if (confirm('Confirma o pagamento desta comissão?')) {
        window.location.href = '<?= base_url('admin/vendas/comissoes/pagar/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
