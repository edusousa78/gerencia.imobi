<?php
$permissaoModel = new \App\Models\PermissaoModel();
$idPermissao = session()->get('permissoes_id');
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('admin') ?>" class="brand-link">
        <img src="<?= base_url('assets/admin/img/AdminLTELogo.png') ?>" 
             alt="AdminLTE Logo" 
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">CRM Imobiliário</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($permissaoModel->verificarPermissao($idPermissao, 'vCliente')): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/clientes') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($permissaoModel->verificarPermissao($idPermissao, 'vImovel')): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/imoveis') ?>" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Imóveis</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($permissaoModel->verificarPermissao($idPermissao, 'vLocacao')): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/locacoes') ?>" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Locações</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($permissaoModel->verificarPermissao($idPermissao, 'cUsuario')): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/usuarios') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Usuários</p>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($permissaoModel->verificarPermissao($idPermissao, 'cPermissao')): ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/permissoes') ?>" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Permissões</p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>
