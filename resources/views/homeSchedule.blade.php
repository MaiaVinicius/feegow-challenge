@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        let urlGetSpecialties = "{{ route('professionals.show') }}";
        let doctorAvatar = "{{ URL::asset('img/doctor.png') }}";
        let schedulingSave = "{{ route('scheduling.save') }}";
    </script>

    <script type="text/javascript" src="{{ URL::asset('js/scheduling.js') }}"></script>
<div class="container">
    <div id="success"></div>
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-12">
                <label for="validationDefault04">Especialidades</label>
                <select class="custom-select" id="choosenSpecialty" required>
                        <option selected disabled value="">Escolha</option>
                        @foreach($specialties["specialties"]["content"] as $spec)
                            <option value="{{$spec["especialidade_id"]}}">{{$spec["nome"]}}</option>
                        @endforeach
                </select>
            </div>

    </div>
    <h3 id="resultsFound"></h3>
    <div class="row justify-content-center" id="doctorsCase">

    </div>
    @include('modal._form')
</div>
@endsection

<style>
    .drCell{
        background-color: white;
        border-radius: 40px;
        text-align: center;
        padding: 10px;
        margin: 10px;
    }
    .drCell img{
        float:left;
        width: 50px;
        height: 50px;
    }
    .drCell button{
        width: 50%;
        border-radius: 20px;
    }
    .drCell p{
        color: darkgray;
        font-weight: 400;
    }
</style>

