<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Notificações do Sistema</h3>
    </div>
    <div class="card-body">
        <div class="list-group">
            <?php foreach ($notificacoes as $notificacao): ?>
                <a href="<?= $notificacao['link'] ?>" 
                   class="list-group-item list-group-item-action <?= $notificacao['lida'] ? '' : 'active' ?>">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $notificacao['titulo'] ?></h5>
                        <small><?= date('d/m/Y H:i', strtotime($notificacao['data'])) ?></small>
                    </div>
                    <p class="mb-1"><?= $notificacao['mensagem'] ?></p>
                    <?php if (!$notificacao['lida']): ?>
                        <button class="btn btn-sm btn-success marcar-lida" 
                                data-id="<?= $notificacao['idNotificacao'] ?>">
                            Marcar como lida
                        </button>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('.marcar-lida').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.post('<?= base_url('admin/notificacoes/marcar-lida/') ?>' + id, function() {
            location.reload();
        });
    });
});
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
