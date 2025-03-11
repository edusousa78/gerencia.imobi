<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Relatório de Inadimplência</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" onclick="window.print()">
                <i class="fas fa-print"></i> Imprimir
            </button>
            <button type="button" class="btn btn-tool" id="exportarPDF">
                <i class="fas fa-file-pdf"></i> Exportar PDF
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imóvel</th>
                    <th>Cliente</th>
                    <th>Competência</th>
                    <th>Vencimento</th>
                    <th>Valor</th>
                    <th>Dias Atraso</th>
                    <th>Total com Multa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inadimplentes as $item): ?>
                <tr>
                    <td><?= $item['imovel'] ?></td>
                    <td><?= $item['nomeCliente'] ?></td>
                    <td><?= date('m/Y', strtotime($item['competencia'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($item['vencimento'])) ?></td>
                    <td>R$ <?= number_format($item['valorTotal'], 2, ',', '.') ?></td>
                    <td><?= floor((time() - strtotime($item['vencimento'])) / (60 * 60 * 24)) ?></td>
                    <td>R$ <?= number_format($item['valorTotal'] + $item['valorMulta'] + $item['valorJuros'], 2, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
