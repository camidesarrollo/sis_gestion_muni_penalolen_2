@extends('layouts.user_type.auth') @section('content')
<?php
    $disableElimiar = '';

    $disableEscribir = '';

    $disableVer = '';

    if(session()->get('privilegios')->eliminar != 1){
        $disableElimiar = 'disabled';
    }
    
    if( session()->get('privilegios')->escribir != 1){
        $disableEscribir = 'disabled';
    }
    
    if(session()->get('privilegios')->leer != 1){
        $disableVer = 'disabled';
    }
    
?>
<main
    class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg"
>
    <div class="container-fluid py-4">
    <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span
                            style="
                                font-weight: 600;
                                font-size: 20px;
                                color: rgba(58, 53, 65, 0.87);
                            "
                            >Filtros de búsqueda</span
                        >
                    </div>
                    
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div class="form-group">
                                        <label for="example-year-input" class="form-control-label">Año</label>
                                        <input class="form-control" type="number" value="" id="example-year-input" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-month-input" class="form-control-label">Mes</label>
                                    <select class="form-select multiple-select" multiple="multiple" id="month_select">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-direccion-input" class="form-control-label">Dirección</label>
                                    <select id="direccion_select" class="form-control multiple-select" multiple="multiple">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-rut-input" class="form-control-label">Rut</label>
                                    <input class="form-control" type="text" value="" id="example-rut-input">
                                </div>
                            </div>
                            <div class="d-flex col-md-12 justify-content-end">
                                <div class="form-group" style="margin-top: 1.7rem;">
                                    <button type="button" class="btn btn-success" onclick="horas_extras()">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between" >
                        <h6>Informe horas extras</h6>
                        <button class=" btn btn-outline-secondary download"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/></svg> Export </button>

                            
                    </div>
                    <div class="card-header pb-0">
                        <div class="table-responsive p-0">
                            <table
                                id="table_id"
                                class="table align-items-center mb-0"
                            >
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Id funcionario
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Rut
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Nombre
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Calidad Contractual
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Direccion
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Estamento
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Grado
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Costo Grado
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            N° de horas en 25
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Monto horas en 25
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            N° de horas en 50
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Monto horas en 50
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Diferencia de horas extras
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Turno
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Total
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Total costo grado
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Año
                                        </th>                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Mes
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection @section('script')

<script type="text/javascript">
    $(document).ready(function () {
        @if(session()->get('privilegios')->leer == 1)
        
        bloquearPantalla();
        getMes();
        getDireccion();

        var actualFecha = new Date();
        $("#example-year-input").val(actualFecha.getFullYear());
        
        setTimeout(function(){
            $("#month_select").multipleSelect("setSelects", [actualFecha.getMonth()]);
            $("#direccion_select").multipleSelect("setSelects", [1]);
        }, 1000);
        setTimeout(function(){
            horas_extras();
        }, 3000);
        
        @else
        alert('El usuario no tiene los permisos suficientes para ver la información');
        desbloquearPantalla();
        @endif



    });

    function getMes(){
        $.ajax({
            url: "{{ route('getMes') }}",
            type: "get"
        })
            .done(function (resp) {
                let data = resp.data;
                
                var options = $("#month_select");
                $.each( data, function(key, val) {
                    console.log(val);
                    options.append(new Option(val.DESCRIPCION, val.COD_SUB_TABLA));
                });
                $("#month_select").multipleSelect();
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });

    }

    function getDireccion(){
        $.ajax({
            url: "{{ route('getDireccion') }}",
            type: "get"
        })
            .done(function (resp) {
                let data = resp.data;
                
                var options = $("#direccion_select");
                $.each( data, function(key, val) {
                    options.append(new Option(val.DESCRIPCION, val.COD_SUB_TABLA));
                });

                $("#direccion_select").multipleSelect();
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
        
    }


    function horas_extras(){
        
        var actualFecha = new Date();

        let mes = $("#month_select").multipleSelect("getSelects");
        let agno = $("#example-year-input").val();
        let direccion = $("#direccion_select").multipleSelect("getSelects");
        let rut = $("#example-rut-input").val();
        if(agno === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar año');
            return false;
        }

        if(mes === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar mes');
            return false;
        }
        
        bloquearPantalla();

        if(direccion === 0){
            direccion = 1;
        }

        let data = new Object();
        data.agno = agno;
        data.mes = mes.join(";");
        data.run = rut;
        


        data.direccion = direccion.join(";");

        for (var i = 0; i < 1; i++){
            data.direccion = ';' +   data.direccion;
            data.mes = ';' +  data.mes;
        }

        for (var i = 0; i < 1; i++){
            data.direccion =    data.direccion + ';' ;
            data.mes =    data.mes + ';' ;
        }


        let url ="{{route('excelInformeHorasExtras')}}"; 

        $("#descarga").attr("href", url + "/" + agno + "/" + mes + "/" + direccion + "/" +  data.run);
        var dataTable_horaExtra = $("#table_id").DataTable();
        dataTable_horaExtra.clear().destroy();
        dataTable_horaExtra = $("#table_id").DataTable({
            serverSide: false,
            scrollX: true,
            sScrollXInner: "400%",
            fixedHeader: {
                header: false,
                footer: true
           },
            ajax: {
                url: "{{route('getInfomeHoraExtra')}}",
                data: data,
            },
            language: {
                url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
            },
            columns: [
                {
                    data: "Id_Funcionario",
                    name: "Id_Funcionario",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "Rut",
                    name: "Rut",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "NOMBRE",
                    name: "NOMBRE",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "CALIDAD_CONTRACTUAL",
                    name: "CALIDAD_CONTRACTUAL",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "DIRECCION",
                    name: "DIRECCION",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "ESTAMENTO",
                    name: "ESTAMENTO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "GRADO",
                    name: "GRADO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "COSTO_GRADO",
                    name: "COSTO_GRADO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "N_H_E_25",
                    name: "N_H_E_25",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "MONTO_H_E_25",
                    name: "MONTO_H_E_25",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "N_H_E_50",
                    name: "N_H_E_50",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "MONTO_H_E_50",
                    name: "MONTO_H_E_50",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "DIF_HRS_EXTRAS",
                    name: "DIF_HRS_EXTRAS",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "TURNO",
                    name: "TURNO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "TOTAL",
                    name: "TOTAL",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "TOTAL_COSTO_GRADO",
                    name: "TOTAL_COSTO_GRADO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "Ano",
                    name: "Ano",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "MES",
                    name: "MES",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
            ],

                drawCallback: function (settings) {},
                initComplete: function () {
                    desbloquearPantalla();
                },
            });

    }
</script>

<script>
    $(".download").click(function(){

        bloquearPantalla();

        let mes = $("#month_select").multipleSelect("getSelects");
        let agno = $("#example-year-input").val();
        let direccion = $("#direccion_select").multipleSelect("getSelects");
        let rut = $("#example-rut-input").val();

        if(agno === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar año');
            return false;
        }

        if(mes === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar mes');
            return false;
        }

        if(agno === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar año');
            return false;
        }

        if(mes === ''){
            desbloquearPantalla();
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error('Debe ingresar mes');
            return false;
        }
        

        if(direccion === 0){
            direccion = 1;
        }

        let data = new Object();
        data.agno = agno;
        data.mes = mes.join(";");
        data.run = rut;
        


        data.direccion = direccion.join(";");

        for (var i = 0; i < 1; i++){
            data.direccion = ';' +   data.direccion;
            data.mes = ';' +  data.mes;
        }

        for (var i = 0; i < 1; i++){
            data.direccion =    data.direccion + ';' ;
            data.mes =    data.mes + ';' ;
        }


        let url ="{{route('excelInformeHorasExtras')}}"; 

            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    var nombre_archivo = 'InformeHorasExtras';
                    link.download =  nombre_archivo + formatDate(new Date()) + ".xlsx";
                    link.click();
                    desbloquearPantalla();
                },
                error: function(blob){
                    console.log(blob);
                }
            });
            });


</script>

@endsection
