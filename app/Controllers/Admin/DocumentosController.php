<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentoModel;

class DocumentosController extends BaseController
{
    protected $documentoModel;

    public function __construct()
    {
        $this->documentoModel = new DocumentoModel();
    }

    public function upload()
    {
        $arquivo = $this->request->getFile('documento');
        if ($arquivo->isValid() && !$arquivo->hasMoved()) {
            $novoNome = $arquivo->getRandomName();
            $arquivo->move(WRITEPATH . 'uploads/documentos', $novoNome);
            
            $this->documentoModel->insert([
                'tipo' => $this->request->getPost('tipo'),
                'idReferencia' => $this->request->getPost('idReferencia'),
                'tipoReferencia' => $this->request->getPost('tipoReferencia'),
                'nomeArquivo' => $novoNome,
                'idUsuario' => session()->get('idUsuario')
            ]);
            
            return $this->response->setJSON(['success' => true]);
        }
        
        return $this->response->setJSON(['success' => false]);
    }

    public function listar($tipo, $id)
    {
        $documentos = $this->documentoModel
            ->where('tipoReferencia', $tipo)
            ->where('idReferencia', $id)
            ->findAll();

        return $this->response->setJSON($documentos);
    }
}
