<footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>Contato</h5>
                <p>
                    <i class="fas fa-phone"></i> <?= $configuracoes['empresa_telefone'] ?? '' ?><br>
                    <i class="fas fa-envelope"></i> <?= $configuracoes['empresa_email'] ?? '' ?><br>
                    <i class="fas fa-map-marker-alt"></i> <?= $configuracoes['empresa_endereco'] ?? '' ?>
                </p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Redes Sociais</h5>
                <div class="social-links">
                    <?php if (!empty($configuracoes['facebook'])): ?>
                        <a href="<?= $configuracoes['facebook'] ?>" target="_blank" class="text-light me-2">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($configuracoes['instagram'])): ?>
                        <a href="<?= $configuracoes['instagram'] ?>" target="_blank" class="text-light me-2">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Informações</h5>
                <p>
                    CRECI: <?= $configuracoes['empresa_creci'] ?? '' ?><br>
                    CNPJ: <?= $configuracoes['empresa_cnpj'] ?? '' ?>
                </p>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <small>&copy; <?= date('Y') ?> <?= $configuracoes['empresa_nome'] ?? 'Imobiliária' ?>. Todos os direitos reservados.</small>
        </div>
    </div>
</footer>
