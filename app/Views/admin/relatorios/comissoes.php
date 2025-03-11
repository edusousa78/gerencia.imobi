<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Relatório de Comissões por Corretor</h3>
        <div class="card-tools">
            <form method="get" class="form-inline">
                <div class="input-group input-group-sm">
                    <input type="date" name="data_inicio" class="form-control" value="<?= $data_inicio ?>">
                    <input type="date" name="data_fim" class="form-control" value="<?= $data_fim ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <button type="button" class="btn btn-default" onclick="window.print()">
                            <i class="fas fa-print"></i> Imprimir
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Corretor</th>
                    <th>CRECI</th>
                    <th>Total Vendas</th>
                    <th>Valor Vendas</th>
                    <th>Valor Comissões</th>
                    <th>Pendentes</th>
                    <th>% Média</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comissoes_por_corretor as $item): ?>
                <tr>
                    <td><?= $item['corretor'] ?></td>
                    <td><?= $item['creci'] ?></td>
                    <td><?= $item['total_vendas'] ?></td>
                    <td>R$ <?= number_format($item['valor_vendas'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($item['valor_comissoes'], 2, ',', '.') ?></td>
                    <td><?= $item['comissoes_pendentes'] ?></td>
                    <td><?= number_format(($item['valor_comissoes'] / $item['valor_vendas']) * 100, 2) ?>%</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
