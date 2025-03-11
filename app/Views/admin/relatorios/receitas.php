<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Relatório de Receitas</h3>
        <div class="card-tools">
            <form method="get" class="form-inline">
                <div class="input-group input-group-sm">
                    <input type="date" name="data_inicio" class="form-control" value="<?= $data_inicio ?>">
                    <input type="date" name="data_fim" class="form-control" value="<?= $data_fim ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Recebido</span>
                        <span class="info-box-number">
                            R$ <?= number_format(array_sum(array_column($receitas, 'total_recebido')), 2, ',', '.') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mês/Ano</th>
                    <th>Total Recebido</th>
                    <th>Qtd. Pagamentos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receitas as $receita): ?>
                <tr>
                    <td><?= date('m/Y', strtotime($receita['dataPagamento'])) ?></td>
                    <td>R$ <?= number_format($receita['total_recebido'], 2, ',', '.') ?></td>
                    <td><?= $receita['total_pagamentos'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/relatorios/receitas/detalhes/' . date('Y-m', strtotime($receita['dataPagamento']))) ?>" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-search"></i> Detalhes
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
