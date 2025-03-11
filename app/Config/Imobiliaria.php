<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Imobiliaria extends BaseConfig
{
    public string $nome = 'Nome da Imobiliária';
    public string $cnpj = '';
    public string $creci = '';
    public string $telefone = '';
    public string $email = '';
    public string $endereco = '';
    public string $logo = 'assets/img/logo.png';
    public string $descricao = '';
    public array $redesSociais = [
        'facebook' => '',
        'instagram' => '',
        'whatsapp' => ''
    ];
}
