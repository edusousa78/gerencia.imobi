<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<!-- Cards Informativos -->
<div class="row">
    <div class="col-lg 3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $stats->imoveis_disponiveis ?></h3>
                <p>Imóveis Disponíveis</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="<?= base_url('admin/imoveis') ?>" class="small-box-footer">
                Ver todos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg 3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $stats->locacoes_ativas ?></h3>
                <p>Locações Ativas</p>
            </div>
            <div class="icon">
                <i class="fas fa-key"></i>
            </div>
            <a href="<?= base_url('admin/locacoes') ?>" class="small-box-footer">
                Ver todas <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg 3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $stats->vendas_mes ?></h3>
                <p>Vendas no Mês</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <a href="<?= base_url('admin/vendas') ?>" class="small-box-footer">
                Ver todas <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg 3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>R$ <?= number_format($stats->receita_aluguel, 2, ',', '.') ?></h3>
                <p>Receita Mensal (Aluguéis)</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="<?= base_url('admin/financeiro') ?>" class="small-box-footer">
                Ver detalhes <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Gráfico de Vendas -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vendas por Mês</h3>
            </div>
            <div class="card-body">
                <canvas id="vendasChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Locações Recentes -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Locações Recentes</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Imóvel</th>
                                <th>Locatário</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locacoes as $locacao): ?>
                            <tr>
                                <td><?= $locacao->imovel ?></td>
                                <td><?= $locacao->locatario ?></td>
                                <td>
                                    <span class="badge badge-<?= $locacao->status == 'ativa' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($locacao->status) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Gráfico de Vendas
var ctx = document.getElementById('vendasChart').getContext('2d');
var vendasChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_map(function($venda) {
            return date('M', mktime(0, 0, 0, $venda->mes, 1));
        }, $vendas_por_mes)) ?>,
        datasets: [{
            label: 'Vendas',
            data: <?= json_encode(array_map(function($venda) {
                return $venda->total;
            }, $vendas_por_mes)) ?>,
            backgroundColor: 'rgba(0, 123, 255, 0.5)'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
