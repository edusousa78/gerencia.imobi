<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Vendas</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/vendas/nova') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Venda
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imóvel</th>
                    <th>Cliente</th>
                    <th>Corretor</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Comissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td><?= $venda['imovel'] ?></td>
                    <td><?= $venda['cliente'] ?></td>
                    <td><?= $venda['corretor'] ?></td>
                    <td>R$ <?= number_format($venda['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($venda['dataVenda'])) ?></td>
                    <td><span class="badge badge-info"><?= $venda['status'] ?></span></td>
                    <td>R$ <?= number_format($venda['valorComissao'], 2, ',', '.') ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/vendas/editar/' . $venda['idVenda']) ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/vendas/contrato/' . $venda['idVenda']) ?>" 
                               class="btn btn-secondary btn-sm" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <?php if ($venda['status'] == 'Concluída' && !isset($venda['comissao'])): ?>
                            <a href="<?= base_url('admin/comissoes/gerar/' . $venda['idVenda']) ?>" 
                               class="btn btn-success btn-sm">
                                <i class="fas fa-dollar-sign"></i> Gerar Comissão
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
