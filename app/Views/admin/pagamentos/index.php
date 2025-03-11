<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pagamentos da Locação</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/pagamentos/novo/' . $locacao['idLocacao']) ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Novo Pagamento
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Imóvel:</strong> <?= $locacao['imovel'] ?>
            </div>
            <div class="col-md-4">
                <strong>Locatário:</strong> <?= $locacao['cliente'] ?>
            </div>
            <div class="col-md-4">
                <strong>Valor Aluguel:</strong> R$ <?= number_format($locacao['valorAluguel'], 2, ',', '.') ?>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Competência</th>
                    <th>Vencimento</th>
                    <th>Valor Total</th>
                    <th>Data Pagamento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagamentos as $pagamento): ?>
                <tr>
                    <td><?= date('m/Y', strtotime($pagamento['competencia'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($pagamento['vencimento'])) ?></td>
                    <td>R$ <?= number_format($pagamento['valorTotal'], 2, ',', '.') ?></td>
                    <td><?= $pagamento['dataPagamento'] ? date('d/m/Y', strtotime($pagamento['dataPagamento'])) : '-' ?></td>
                    <td>
                        <span class="badge badge-<?= $pagamento['status'] == 'pago' ? 'success' : 
                            ($pagamento['status'] == 'pendente' ? 'warning' : 'danger') ?>">
                            <?= ucfirst($pagamento['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/pagamentos/editar/' . $pagamento['idPagamento']) ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/pagamentos/recibo/' . $pagamento['idPagamento']) ?>" 
                               class="btn btn-secondary btn-sm" target="_blank">
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
<?= $this->endSection() ?>
