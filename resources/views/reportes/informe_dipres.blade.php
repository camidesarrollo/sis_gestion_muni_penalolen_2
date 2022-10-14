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
                    <form class="needs-validation" novalidate>
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
                                    <input class="form-control" type="number" value="" id="example-year-input" required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, Ingrese AÑO.
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 1.7rem;">
                                    <button type="button" class="btn btn-success" onclick="informeDipres()">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between" >
                        <h6>Informe Dipres</h6>
                            <button class=" btn btn-outline-secondary download"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/></svg> Export </button>
                    </div>
                    <div class="card-header pb-0">
                        <div class="table-responsive p-0">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Partida Ley
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Capitulo Ley
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Programa Ley
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Area Transaccional
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Nombre Intitución Pagadora
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Rut Intitución Pagadora
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            DV Intitución Pagadora
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Nombre Intitución Trabaja
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Rut Intitución Trabaja
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            DV Intitución Trabaja
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Region
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Año
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Mes
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Rut Trabajador
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Dv Trabajador
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
                                            Nombre
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Sexo
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Calidad Juridica
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Estamento
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Grado Nivel Renumeracion
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Jornada Contrato
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Cargo
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Fecha Ingreso Intitución
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Unidad Monetaria
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Renumeración Bruta Total
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Renumeración Liquida Legal
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Renumeración Liquida Efectiva
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Montos Pagados Trabajos Extraordinarios
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            N° de horas extraordinarias pagadas
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Aportes Patronales
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Remuneracion Percibida
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Viaticos
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Confidencial
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

            let url ="{{route('excel_informe_dipres')}}"; 

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
                    var nombre_archivo = 'InformeDipres';
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





<script type="text/javascript">




(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('click', function (event) {
            
            if(event.srcElement.classList[1] == 'btn-success'){
                
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                


                form.classList.add('was-validated')
            }

        }, false)
        })
    })()

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
                informeDipres(); 
            }, 2000);
        @else
        alert('El usuario no tiene los permisos suficientes para ver la información');
        desbloquearPantalla();
        @endif
        
       



    });

    function informeDipres(){
        if(validation() != false){
            bloquearPantalla();
            var actualFecha = new Date();

            let mes = $("#month_select").val();
            let agno = $("#example-year-input").val();

            let data = new Object();
            data.agno = agno;
            data.mes = mes;

            let url ="{{route('excel_informe_dipres')}}"; 

            $("#descarga").attr("href", url + "/" + agno + "/" + mes );

            $("#example").DataTable().clear().destroy();
            $("#example").DataTable({

                scrollX: true,
                ajax: {
                    url: "{{route('getinformeDipres_2022')}}",
                    data: data,
                },
                language: {
                    url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
                },
                columns: [
                    {
                        data: "Partida_Ley",
                        name: "Partida_Ley",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Capitulo_Ley",
                        name: "Capitulo_Ley",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Programa_Ley",
                        name: "Programa_Ley",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Area_Transaccional",
                        name: "Area_Transaccional",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Nombre_Institucion_Pagadora",
                        name: "Nombre_Institucion_Pagadora",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Rut_institucion_Pagadora",
                        name: "Rut_institucion_Pagadora",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "DV_institucion_Pagadora",
                        name: "DV_institucion_Pagadora",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Nombre_Institucion_Trabaja",
                        name: "Nombre_Institucion_Trabaja",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Rut_Institucion_Trabaja",
                        name: "Rut_Institucion_Trabaja",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "DV_Institucion_Trabaja",
                        name: "DV_Institucion_Trabaja",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Region",
                        name: "Region",
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
                        data: "RUT_TRABAJADOR",
                        name: "RUT_TRABAJADOR",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "DV_Trabajador",
                        name: "DV_Trabajador",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Apellido_Paterno",
                        name: "Apellido_Paterno",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Apellido_Materno",
                        name: "Apellido_Materno",
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
                        data: "Sexo",
                        name: "Sexo",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Calidad_Juridica",
                        name: "Calidad_Juridica",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Estamento",
                        name: "Estamento",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Grado_Nivel_Remuneraciones",
                        name: "Grado_Nivel_Remuneraciones",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Jornada_Contrato",
                        name: "Jornada_Contrato",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Cargo",
                        name: "Cargo",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Fecha_Ingreso_Institucion",
                        name: "Fecha_Ingreso_Institucion",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Unidad_Monetaria",
                        name: "Unidad_Monetaria",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Remuneracion_Bruta_Total",
                        name: "Remuneracion_Bruta_Total",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Remuneracion_Liquida_Legal",
                        name: "Remuneracion_Liquida_Legal",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Remuneracion_Liquida_Efectiva",
                        name: "Remuneracion_Liquida_Efectiva",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Monto_Pagado_Trabajos_Extraordinarios",
                        name: "Monto_Pagado_Trabajos_Extraordinarios",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "N_Horas_Extraordinarias_Pagadas",
                        name: "N_Horas_Extraordinarias_Pagadas",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Aportes_Patronales",
                        name: "Aportes_Patronales",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Remuneracion_Percibida_Area_Geografica_Trabajo",
                        name: "Remuneracion_Percibida_Area_Geografica_Trabajo",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "Viaticos",
                        name: "Viaticos",
                        className: "text-center",
                        visible: true,
                        orderable: true,
                        searchable: true,
                    },
                    
                    {
                        data: "Confidencial",
                        name: "Confidencial",
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
        
    }

    function validation(){
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
        return true;
    }

    function getMes(){
        $.ajax({
            url: "{{ route('getMes') }}",
            type: "get"
        })
            .done(function (resp) {
                let data = resp.data;
                let select = [];
                
                var options = $("#month_select");
                $.each( data, function(key, val) {
                    select.push(val.COD_SUB_TABLA);
                    options.append(new Option(val.DESCRIPCION, val.COD_SUB_TABLA));
                });
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });

    }


</script>


@endsection
