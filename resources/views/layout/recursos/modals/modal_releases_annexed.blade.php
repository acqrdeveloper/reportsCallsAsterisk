<!-- Modal -->
<div :class="showReleasesAnnexedModal"  data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showReleasesAnnexedModal = 'modal fade'" >
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Liberación de Anexo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" >
                        <p>¿Desea liberar su anexo?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Aceptar</button> <button class="btn btn-danger" type="submit" @click="showReleasesAnnexedModal = 'modal fade'">Cancelar</button>
            </div>
        </div>
    </div>
</div>
