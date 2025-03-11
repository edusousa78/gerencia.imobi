<div class="documentos-container" data-tipo="<?= $tipo ?>" data-id="<?= $id ?>">
    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-sm upload-documento">
            <i class="fas fa-upload"></i> Upload Documento
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-documentos">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalDocumento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload de Documento</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formDocumento">
                <div class="modal-body">
                    <input type="hidden" name="tipoReferencia" value="<?= $tipo ?>">
                    <input type="hidden" name="idReferencia" value="<?= $id ?>">
                    
                    <div class="form-group">
                        <label>Tipo do Documento</label>
                        <select name="tipo" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="Contrato">Contrato</option>
                            <option value="Certidão">Certidão</option>
                            <option value="Comprovante">Comprovante</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Arquivo</label>
                        <input type="file" name="documento" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
