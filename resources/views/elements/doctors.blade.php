<div class="col-lg-12">
    <div class="row">
        @if(!empty($doctors))
            @foreach($doctors as $doctor)
                <div class="col-lg-4">
                    <div class="card" style="margin: 15px 0">
                        <div class="card-body">
                            <div class="media">
                                @if(!empty($doctor->foto) )
                                    <img src="{{ $doctor->foto }}" class="rounded-circle" width="75" height="75">
                                @else
                                    @if(!empty($doctor->sexo) && $doctor->sexo ==='Feminino')
                                        <img src="http://vba.co.mz/assets/img/fmp.jpg" class="rounded-circle" width="75">
                                    @else
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS08pINy7bpPix6uY_aX-HI-c8QYZAWnMO0SZX7CXANngX_GjfQ" class="rounded-circle"  width="75">
                                    @endif

                                @endif
                                <div class="media-body" style="padding-left: 10px">
                                    <h5 class="card-title">Dr{{ (!empty($doctor->sexo) && $doctor->sexo ==='Feminino')?'a':'' }} {{$doctor->nome}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        @if(!empty($doctor->documento_conselho) )
                                            {{ (!empty($doctor->conselho))?$doctor->conselho:'CRM' }} {{ $doctor->documento_conselho }}
                                        @else
                                            CRM não Informado
                                        @endif
                                    </h6>

                                </div>
                            </div>
                            <div class="text-center">
                                <button id="btnSchedule" type="button" class="btn btn-sm btn-success" professional_id="{{ $doctor->profissional_id }}">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            Nenhum médico encontrado para essa especialidade
        @endif
    </div>
</div>



