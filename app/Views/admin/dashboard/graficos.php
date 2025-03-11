<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vendas por Mês</h3>
            </div>
            <div class="card-body">
                <canvas id="graficoVendas"></canvas>
            </div>
        </div>
    </div>
    <!-- Adicionar mais gráficos -->
</div>
<?= $this->endSection() ?>
