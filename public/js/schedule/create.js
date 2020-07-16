var ScheduleCreate = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        selectDataSpecialties: function() {
            var html = "<option value='' selected>Selecione a especialidade...</option>",
                json = "";
            
            json = _configurationGeneral.submitPost("/api/v1/specialties", {}, "GET");
            
            $(json.data.content).each(function(i, data) {
                html += "<option value='" + data.especialidade_id + "'>" + data.nome + "</option>";
            });

            $("#specialty_id").html(html);
        },
    },
    _clickButton = {
        specialty: function(){
            $("#specialty_id").change(function() {
                var html = "",
                    json = "",
                    specialty_id = $(this).val();

                if($(this).val() == "") {
                    $("#divProfessional, #divForm").addClass("d-none");
                } else {
                    json = _configurationGeneral.submitPost("/api/v1/professionals", {specialty: specialty_id}, "GET");
                    
                    $(json.data.content).each(function(i, data) {
                        html += "<div class='card' width='400' height='200'>" +
                                    "<img src='" + data.foto + "' class='img-thumbnail' width='400' height='200' />" +
                                    "<div class='card-body'>" +
                                        "<h5 class='card-title'>" + data.tratamento + " " + data.nome + "</h5>";

                        $(data.especialidades).each(function(j, especialidades) {
                            if(especialidades.especialidade_id == specialty_id) {
                                html += "<p class='card-text'>CRM " + especialidades.CBOS + "</p>" +
                                        "<p class='card-text'><button type='button' name='btnScheduleProfessional' class='btn btn-xs btn-outline-primary btnScheduleProfessional' professional_id='" + data.profissional_id + "'>Agendar</button></p>";
                            }
                        });

                        html +=     "</div>" +
                                "</div>";
                    });

                    $("#divProfessional").html(html);
                    $("#divProfessional").removeClass("d-none");
                }
            });
        },
        scheduleProfessional: function(){
            $("form").on("click", ".btnScheduleProfessional", function() {
                var html = "<option value='' selected>Selecione...</option>",
                    json = "";
                
                json = _configurationGeneral.submitPost("/api/v1/patient/list-source", {}, "GET");
                
                $(json.data.content).each(function(i, data) {
                    html += "<option value='" + data.origem_id + "'>" + data.nome_origem + "</option>";
                });

                $("#source_id").html(html);
                $("#professional_id").val($(this).attr("professional_id"));
                $("#divForm").removeClass("d-none");
            });
        },
        saveSchedule: function(){
            $("#btnSaveSchedule").click(function() {
                _configurationGeneral.submitPost("/api/v1/schedule", $("form").serializeArray(), "POST");

                $("#divMessage").removeClass("d-none");
            });
        },
    },
    _configurationGeneral = {
        submitPost: function(url, fields, type){
            var json,
                csrfToken = $('meta[name="csrf-token"]').attr('content');

            Object.assign(fields, {name: "_token", value: csrfToken});

            $.ajax({
                url: url,
                data: fields,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", 'Bearer ' + localStorage.getItem("token-jwt"));
                },
                type: type,
                async: false,
                success: function(data){
                    json = data;

                    $("#divMessage").removeClass("alert-danger");
                    $("#divMessage").addClass("alert-success").text(data.message);
                    return false;
                },
                error: function(data) {
                    $("#divMessage").addClass("alert-danger").text(data.responseText);
                    $("#divMessage").removeClass("d-none");
                }
            });
            
            return json;
        },
    },
    _load = {
        begin: function(){
            _clickButton.specialty();
            _clickButton.scheduleProfessional();
            _clickButton.saveSchedule();
            _autoLoading.selectDataSpecialties();
        }
    };
    return {
        init: init
    };
})();