<?= $this->extend('site/templates/default') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Entre em Contato</h2>
            <form action="<?= base_url('contato/enviar') ?>" method="post" class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control telefone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assunto</label>
                        <select name="assunto" class="form-select" required>
                            <option value="">Selecione...</option>
                            <option value="Informações">Informações</option>
                            <option value="Visita">Agendar Visita</option>
                            <option value="Avaliação">Avaliação de Imóvel</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea name="mensagem" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Informações de Contato</h2>
            <div class="card">
                <div class="card-body">
                    <p><i class="fas fa-map-marker-alt"></i> <?= $configuracoes['empresa_endereco'] ?? '' ?></p>
                    <p><i class="fas fa-phone"></i> <?= $configuracoes['empresa_telefone'] ?? '' ?></p>
                    <p><i class="fas fa-envelope"></i> <?= $configuracoes['empresa_email'] ?? '' ?></p>
                    <p><i class="fas fa-clock"></i> Segunda a Sexta: 9h às 18h</p>
                    
                    <div class="mt-4">
                        <h5>Redes Sociais</h5>
                        <div class="social-links">
                            <?php if (!empty($configuracoes['facebook'])): ?>
                                <a href="<?= $configuracoes['facebook'] ?>" class="btn btn-outline-primary me-2">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($configuracoes['instagram'])): ?>
                                <a href="<?= $configuracoes['instagram'] ?>" class="btn btn-outline-danger me-2">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($configuracoes['whatsapp'])): ?>
                                <a href="https://wa.me/<?= $configuracoes['whatsapp'] ?>" class="btn btn-outline-success">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
