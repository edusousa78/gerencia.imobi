<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Acompanhamento de Metas - <?= $corretor['nome'] ?></h3>
        <div class="card-tools">
            <form method="get" class="form-inline">
                <select name="mes" class="form-control form-control-sm mr-2">
                    <?php for($i = 1; $i <= 12; $i++): ?>
                        <option value="<?= $i ?>" <?= $i == $mes ? 'selected' : '' ?>>
                            <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>/<?= $ano ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-sm btn-default">Filtrar</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Meta do Mês</span>
                        <span class="info-box-number">R$ <?= number_format($meta['valorMeta'] ?? 0, 2, ',', '.') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Valor Alcançado</span>
                        <span class="info-box-number">R$ <?= number_format($valorVendas, 2, ',', '.') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Percentual Atingido</span>
                        <span class="info-box-number">
                            <?php if ($meta): ?>
                                <?= number_format(($valorVendas / $meta['valorMeta']) * 100, 1) ?>%
                            <?php else: ?>
                                0%
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mt-4">Vendas do Período</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Imóvel</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Comissão</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($venda['dataVenda'])) ?></td>
                    <td><?= $venda['imovel'] ?></td>
                    <td><?= $venda['cliente'] ?></td>
                    <td>R$ <?= number_format($venda['valor'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($venda['valorComissao'], 2, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
