@extends('layouts.app')

@section('content')
    <div class="row dvSelect">
        <div class="col-md-12">
            <label for="specialtiesList">@lang('home.select_specialtie')</label>
            <select id="specialtiesList" name="specialtiesList" class="form-control">
                <option value="">@lang('home.select')</option>
            @foreach($specialties as $specialty)
                <option value="{{$specialty['especialidade_id']}}">{{$specialty['nome']}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <h3 class='titleHidden'>@lang('home.select_professionals')</h3>
    
    <div class="text-center dvLoading">
        <div class="spinner-border" style="width: 3rem; height: 3rem; margin-top: 40px;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="row" id="dvDoctors">
        
    </div>

    @include('modals.schedule')
@endsection

@section('scripts')
    <script>
        lang_agendar = "@lang('home.schedule')";
    </script>
@endsection