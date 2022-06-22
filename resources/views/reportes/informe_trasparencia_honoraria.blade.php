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
                            <div class="col-md-5 mb-md-0 mb-4">
                                <div class="form-group">
                                        <label for="example-month-input" class="form-control-label">Mes</label>
                                        <select class="form-select" aria-label="Default select example" id="month_select">
                                       
                                       </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="example-year-input" class="form-control-label">Año</label>
                                    <input class="form-control" type="number" value="" id="example-year-input">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 1.7rem;">
                                    <button type="button" class="btn btn-success" onclick="informeTrasparenciaHonoraria()">Filtrar</button>
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
                        <h6>Informe Transparencia Honoraria</h6>
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
                                            Tipo Personal
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            ANO
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            MES
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Apellido Paterno
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Apellido Materno
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Nombres
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Grado US
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Descripción Funcional
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Calificación Personal
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Region
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Unidad Monetaria
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Honorario Total Bruto
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Renumeración liquida mensualizada
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Pago Mensual
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Fecha Inicio
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Fecha Termino
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Observaciones
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Declaracion Patrimonio
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Declaracion Intereses
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Viaticos
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

        bloquearPantalla();
        @if(session()->get('privilegios')->leer == 1)
            getMes();
            setTimeout(function(){
                var actualFecha = new Date();
                console.log(actualFecha.getMonth())
                $("#month_select option[value='"+actualFecha.getMonth()+"']").attr("selected", true);
                $("#example-year-input").val(actualFecha.getFullYear());
            }, 1000);
            setTimeout(function(){
                informeTrasparenciaHonoraria();
            }, 2000);
        @else
        alert('El usuario no tiene los permisos suficientes para ver la información');
        desbloquearPantalla();
        @endif



       
    });
    function informeTrasparenciaHonoraria(){
       
        var actualFecha = new Date();

        let mes = $("#month_select").val();
        let agno = $("#example-year-input").val();

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
        let data = new Object();
        data.agno = agno;
        data.mes = mes;



        var dataTable_informeTransparenciaHonoraria = $("#table_id").DataTable();
        dataTable_informeTransparenciaHonoraria.clear().destroy();
        dataTable_informeTransparenciaHonoraria = $("#table_id").DataTable({
            serverSide: false,
            scrollX: true,
            ajax: {
                url: "{{route('getinforme_transparencia_honorarios')}}",
                data: data
            },
            language: {
                url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
            },
            columns: [
                {
                    data: "TIPO_PERSONAL",
                    name: "TIPO_PERSONAL",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "ANO",
                    name: "ANO",
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
                {
                    data: "APELLIDO_PATERNO",
                    name: "APELLIDO_PATERNO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "APELLIDO_MATERNO",
                    name: "APELLIDO_MATERNO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "NOMBRES",
                    name: "NOMBRES",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "GRADO_US",
                    name: "GRADO_US",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "DESCRIPCION_FUNCION",
                    name: "DESCRIPCION_FUNCION",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "CALIFICACION_PROFESIONAL",
                    name: "CALIFICACION_PROFESIONAL",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "REGION",
                    name: "REGION",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "UNIDAD_MONETARIA",
                    name: "UNIDAD_MONETARIA",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "HONORARIO_TOTAL_BERUTO",
                    name: "HONORARIO_TOTAL_BERUTO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "REMUNERACION_LIQUIDA_MENSUALIZADA",
                    name: "REMUNERACION_LIQUIDA_MENSUALIZADA",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "PAGO_MENSUAL",
                    name: "PAGO_MENSUAL",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "FECHA_INICIO",
                    name: "FECHA_INICIO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "FECHA_TERMINO",
                    name: "FECHA_TERMINO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "OBSERVACIONES",
                    name: "OBSERVACIONES",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "DECLARACION_PATRIMONIO",
                    name: "DECLARACION_PATRIMONIO",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "DECLARACION_INTERESES",
                    name: "DECLARACION_INTERESES",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "VIATICOS",
                    name: "VIATICOS",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                }
            ],
            
            drawCallback: function (settings) {

            },
            initComplete: function () {
                desbloquearPantalla();
            },
        });
    }
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
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });

    }

</script>

<script>
        $(".download").click(function(){
            bloquearPantalla();

            let mes = $("#month_select").val();
            let agno = $("#example-year-input").val();

            let data = new Object();
            data.agno = agno;
            data.mes = mes;

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

            let url ="{{route('excel_informe_transparencia_honorarios')}}"; 

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
                    var nombre_archivo = 'InformeTransparenciaHonoraria';
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
