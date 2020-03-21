<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">@lang('schedule.schedule')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('save.schedule')}}" id="formSchedule">
                    @csrf
                    <h3>@lang('schedule.fill_data')</h3>
                    <input type="hidden" id="specialty_id" name="specialty_id" value=""/>
                    <input type="hidden" id="professional_id" name="professional_id" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">@lang('schedule.complete_name')</label>
                                <input type="text" class="form-control" name="name" id="name" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_id">@lang('schedule.how_know')</label>
                                <select id="source_id" name="source_id" class="form-control">
                                    @foreach($howknows as $howknow)
                                    <option value="{{$howknow['origem_id']}}">{{$howknow['nome_origem']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthdate">@lang('schedule.birthdate')</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">@lang('schedule.cpf')</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" value=""/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('schedule.close')</button>
                <button type="button" class="btn btn-primary" id="saveSchedule">@lang('schedule.save')</button>
            </div>
        </div>
    </div>
</div>