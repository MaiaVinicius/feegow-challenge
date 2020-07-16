var ScheduleView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataProducts: function(page=1) {
            var fields = {page: page},
                json = "";
                
            json = _configurationGeneral.submitPost("/api/v1/schedule", fields, "GET");
            _configurationGeneral.createDataTable(json);
        },
    },
    _clickButton = {
        nextPage: function(){
            $("#paginationNav").on("click", ".page-link", function() {
                _autoLoading.dataProducts($(this).attr("page"));
            });
        },
    },
    _configurationGeneral = {
        createDataTable: function(json) {
            var html = "";

            $(json.data).each(function(i, data) {
                html += "<tr>" +
                            "<td>" + data.id + "</td>" +
                            "<td>" + data.name + "</td>" +
                            "<td>" + data.cpf + "</td>" +
                            "<td>" + data.specialty_id + "</td>" +
                            "<td>" + data.professional_id + "</td>" +
                            "<td>" + data.source_id + "</td>" +
                            "<td>" + data.birthdate + "</td>" +
                            "<td>" + data.date_time + "</td>" +
                        "</tr>";
            });

            $("table tbody").html(html);
            createPaginator(json);
        },
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
                    return false;
                }
            });
            
            return json;
        },
    },
    _load = {
        begin: function(){
            _autoLoading.dataProducts();
            _clickButton.nextPage();
        }
    };
    return {
        init: init
    };
})();