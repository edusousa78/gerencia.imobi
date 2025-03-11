<?= $this->extend('admin/templates/default') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Prévia do Contrato</h3>
        <div class="card-tools">
            <a href="<?= base_url('admin/contratos/download/' . $locacao->idLocacao) ?>" 
               class="btn btn-primary">
                <i class="fas fa-download"></i> Baixar PDF
            </a>
            <a href="<?= base_url('admin/contratos/enviar/' . $locacao->idLocacao) ?>" 
               class="btn btn-success">
                <i class="fas fa-envelope"></i> Enviar por Email
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="contract-preview">
            <h2 class="text-center mb-4">CONTRATO DE LOCAÇÃO DE IMÓVEL</h2>
            
            <p>Entre as partes:</p>
            
            <p><strong>LOCADOR:</strong> <?= $locacao->locador_nome ?>, 
               portador do documento <?= $locacao->locador_documento ?></p>
            
            <p><strong>LOCATÁRIO:</strong> <?= $locacao->locatario_nome ?>, 
               portador do documento <?= $locacao->locatario_documento ?></p>
            
            <h4>1. DO IMÓVEL</h4>
            <p>Endereço: <?= $locacao->endereco ?>, <?= $locacao->cidade ?>/<?= $locacao->estado ?></p>
            
            <h4>2. DO PRAZO E VALOR</h4>
            <p>Prazo: <?= $locacao->duracao ?> meses</p>
            <p>Valor mensal: R$ <?= number_format($locacao->valorAluguel, 2, ',', '.') ?></p>
            
            <!-- Continua com as demais cláusulas -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>
