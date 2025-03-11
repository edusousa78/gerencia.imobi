<?php

namespace App\Libraries;

class UploadHandler
{
    protected $uploadPath;
    protected $allowedTypes;
    protected $maxSize;

    public function __construct($config = [])
    {
        $this->uploadPath = $config['upload_path'] ?? WRITEPATH . 'uploads/';
        $this->allowedTypes = $config['allowed_types'] ?? 'gif|jpg|jpeg|png|pdf';
        $this->maxSize = $config['max_size'] ?? 2048;
    }

    public function handleUpload($file, $newName = '')
    {
        if (!$file->isValid() || $file->hasMoved()) {
            return ['success' => false, 'error' => 'Arquivo inválido'];
        }

        if (!in_array($file->getClientMimeType(), explode('|', $this->allowedTypes))) {
            return ['success' => false, 'error' => 'Tipo de arquivo não permitido'];
        }

        if ($file->getSize() / 1024 > $this->maxSize) {
            return ['success' => false, 'error' => 'Arquivo muito grande'];
        }

        $fileName = $newName ?: $file->getRandomName();

        try {
            $file->move($this->uploadPath, $fileName);
            return [
                'success' => true,
                'fileName' => $fileName,
                'originalName' => $file->getClientName(),
                'type' => $file->getClientMimeType(),
                'size' => $file->getSize()
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
