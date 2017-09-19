<!-- Modal content-->
<div class="panel panel-primary">
    <div class="panel-heading">
        <button type="button" class="close" onclick="clearModal('modalQueues', 'div.dialogQueuesLarge')">&times;</button>
        <h4 class="modal-title">Assign Queue [{{ $nameQueue }}]</h4>
    </div>
    <div class="modal-body">
        <form id="formQueuesUser">
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Ingrese el nombre o usuario para buscar">
                </div>
            </div>
            <div class="col-xs-12">
                <input type="hidden" value="{{$list_users}}" id="list_users" name="list_users">
                <table id="table-agents-queue" class="table table-fixed" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center col-xs-2">
                            <input type="checkbox" class="checkGeneral" onclick="mark_all('.checkGeneral')">
                        </th>
                        <th class="col-xs-5">Nombre Usuario</th>
                        <th class="col-xs-3">Username</th>
                        <th class="col-xs-2">Prioridad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Users as $user)
                        <?php $ifExistUser = (isset($user['UserQueues']) ? true : false) ?>
                        <tr class="@if($ifExistUser) success @else info @endif @if(!$ifExistUser) trNew @endif" id="tr_{{ $user['id'] }}">
                            <td class="col-xs-2 text-center">
                                <input type="checkbox" name="checkQueue[]" value="{{ $user['id'] }}" id="checkbox_{{ $user['id'] }}" class="@if(!$ifExistUser) checkNew @endif"
                                    @if($ifExistUser)
                                            @if($user['id'] == $user['UserQueues']['user_id'])
                                                checked
                                            @endif
                                    @endif onclick="markCheck('{{ $user['id'] }}')">
                            </td>
                            <td class="col-xs-5">
                                {{$user['primer_nombre'].' '.$user['apellido_paterno'].' '.$user['apellido_materno']}}
                            </td>
                            <td class="col-xs-3">
                                {{ $user['username'] }}
                            </td>
                            <td class="col-xs-2">
                                <select id="select_{{ $user['id'] }}" name="selectPriority[]" class="@if(!$ifExistUser) selectNew @endif" @if(!$ifExistUser) disabled @endif>
                                    <option selected disabled> - </option>
                                    @foreach ($Priority as $priority)
                                        <option value="{{ $priority['id'] }}"
                                                @if($ifExistUser)
                                                    @if($priority['id'] == $user['UserQueues']['priority'])
                                                    selected
                                                    @endif
                                                @endif>
                                            {{ $priority['description'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="alert alert-danger formError" style="display: none"></div>
            <input type="hidden" name="queueID" value="{{ $idQueue }}">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnForm"><i class="fa fa-save"></i> Guardar</button>
                <button type="submit" class="btn btn-info btnLoad" style="display: none"><i class="fa fa-spin fa-spinner"></i> Cargando</button>
                <button type="button" class="btn btn-default" onclick="clearModal('modalQueues', 'div.dialogQueuesLarge')"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </form>
    </div>
</div>
{!!Html::script('js/form/formQueues.min.js?version='.date('YmdHis')) !!}
<script>
    hideErrorForm('.formError')
    searchTable('#table-agents-queue','#search')
    clearModalClose('modalQueues', 'div.dialogQueuesLarge')
</script>