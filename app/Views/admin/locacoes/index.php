<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $titulo ?></h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/locacoes/nova') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Nova Locação
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="tabelaLocacoes">
                <thead>
                    <tr>
                        <th>Imóvel</th>
                        <th>Locador</th>
                        <th>Locatário</th>
                        <th>Valor</th>
                        <th>Início</th>
                        <th>Status</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($locacoes)): ?>
                        <?php foreach($locacoes as $locacao): ?>
                        <tr>
                            <td><?= $locacao['imovel'] ?></td>
                            <td><?= $locacao['locador'] ?></td>
                            <td><?= $locacao['locatario'] ?></td>></td>
                            <td>R$ <?= number_format($locacao['valorAluguel'], 2, ',', '.') ?></td>['valorAluguel'], 2, ',', '.') ?></td>
                            <td><?= date('d/m/Y', strtotime($locacao['dataInicio'])) ?></td>
                            <td>
                                <span class="badge badge-<?= $locacao['status'] == 'ativa' ? 'success' : 'warning' ?>">    <span class="badge badge-<?= $locacao['status'] == 'ativa' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($locacao['status']) ?>
                                </span>
                            </td>
                            <td>td>
                                <div class="btn-group">    <div class="btn-group">
                                    <a href="<?= base_url('admin/locacoes/editar/' . $locacao['idLocacao']) ?>" se_url('admin/locacoes/editar/' . $locacao['idLocacao']) ?>" 
                                       class="btn btn-info btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/contratos/gerar/' . $locacao['idLocacao']) ?>" <a href="<?= base_url('admin/contratos/gerar/' . $locacao['idLocacao']) ?>" 
                                       class="btn btn-secondary btn-sm" title="Contrato">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="<?= base_url('admin/pagamentos/locacao/' . $locacao['idLocacao']) ?>" <a href="<?= base_url('admin/pagamentos/locacao/' . $locacao['idLocacao']) ?>" 
                                       class="btn btn-success btn-sm" title="Pagamentos">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhuma locação encontrada</td>d colspan="7" class="text-center">Nenhuma locação encontrada</td>
                        </tr>  </tr>
                    <?php endif; ?>
                </tbody>    </tbody>
            </table>            </table>
        </div>        </div>
    </div>    </div>
</div></div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#tabelaLocacoes').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        }
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
