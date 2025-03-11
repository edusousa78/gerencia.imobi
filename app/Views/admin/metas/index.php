<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Metas de Vendas</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNovaMeta">
                <i class="fas fa-plus"></i> Nova Meta
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="get" class="form-inline">
                    <select name="ano" class="form-control mr-2">
                        <?php for($i = date('Y')-2; $i <= date('Y')+1; $i++): ?>
                            <option value="<?= $i ?>" <?= $i == $ano ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="submit" class="btn btn-default">Filtrar</button>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Corretor</th>
                    <th>Mês/Ano</th>
                    <th>Meta</th>
                    <th>Realizado</th>
                    <th>%</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metas as $meta): ?>
                <tr>
                    <td><?= $corretores[$meta['idCorretor']]['nome'] ?? '' ?></td>
                    <td><?= str_pad($meta['mes'], 2, '0', STR_PAD_LEFT) ?>/<?= $meta['ano'] ?></td>
                    <td>R$ <?= number_format($meta['valorMeta'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($meta['valorAlcancado'] ?? 0, 2, ',', '.') ?></td>
                    <td><?= number_format(($meta['valorAlcancado'] ?? 0) / $meta['valorMeta'] * 100, 1) ?>%</td>
                    <td><span class="badge badge-<?= $meta['status'] == 'Concluída' ? 'success' : 'info' ?>"><?= $meta['status'] ?></span></td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="editarMeta(<?= $meta['idMeta'] ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nova Meta -->
<div class="modal fade" id="modalNovaMeta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Definir Nova Meta</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/metas/definir') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Corretor</label>
                        <select name="idCorretor" class="form-control" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($corretores as $corretor): ?>
                                <option value="<?= $corretor['idCorretor'] ?>"><?= $corretor['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mês/Ano</label>
                        <div class="row">
                            <div class="col-6">
                                <select name="mes" class="form-control" required>
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="ano" class="form-control" required>
                                    <?php for($i = date('Y'); $i <= date('Y')+1; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Valor da Meta</label>
                        <input type="text" name="valorMeta" class="form-control money" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
