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
            <div class="col-12 ">
                <div class="card mb-4" >
                    <div class="card-header pb-0 info-user" style="display: flex;justify-content: space-between;">
                        <div> <h6>Usuarios</h6></div>
                        
                    </div>
                    <div class="card-body px-0 pt-2 pb-2">
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
                                            Run
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            User
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Email
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Telefono
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Roles
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Vigencia
                                        </th>
                                        @if(session()->get('privilegios')->eliminar == 1 || session()->get('privilegios')->escribir == 1 || session()->get('privilegios')->leer == 1)
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Acciones
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
  </div>

  
</main>
<!-- Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input
                    type="hidden"
                    class="form-control"
                    id="id_usuario"
                    name="id_usuario"
                />
                    <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="example-text-input-run"
                                    class="form-control-label"
                                    >Run</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="12.345.678-9"
                                    value=""
                                    id="example-text-input-run"
                                    required
                                />
                                <div class="invalid-feedback">
                                    Por favor, Ingrese RUN.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="example-text-input-nombres"
                                    class="form-control-label"
                                    >Nombres</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="John Snow"
                                    value=""
                                    id="example-text-input-nombres"
                                    required
                                />
                                <div class="invalid-feedback">
                                    Por favor, Ingrese NOMBRES.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="paterno-example-text-input"
                                    class="form-control-label"
                                    >Apellido Paterno</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="John Snow"
                                    value=""
                                    id="paterno-example-text-input"
                                    required
                                />
                                <div class="invalid-feedback">
                                    Por favor, Ingrese APELLIDO PATERNO.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="materno-example-text-input"
                                    class="form-control-label"
                                    >Apellido Materno</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="John Snow"
                                    value=""
                                    id="materno-example-text-input"
                                    required
                                />
                                <div class="invalid-feedback">
                                    Por favor, Ingrese APELLIDO MATERNO.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="example-email-input"
                            class="form-control-label"
                            >Email</label
                        >
                        <input
                            class="form-control"
                            type="email"
                            placeholder="@example.com"
                            value=""
                            id="example-email-input"
                            required
                        />
                        <div class="invalid-feedback">
                            Por favor, Ingrese EMAIL.
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="example-tel-input"
                            class="form-control-label"
                            >Phone</label
                        >
                        <input
                            class="form-control"
                            type="tel"
                            placeholder="40-(770)-888-444"
                            value=""
                            id="example-tel-input"
                            required
                        />
                        <div class="invalid-feedback">
                            Por favor, Ingrese TELEFONO.
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="example-text-input"
                            class="form-control-label"
                            >Rol</label
                        >
                        <select id="rol_select" class="form-control" required>
                            <option value="">Seleccione rol</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, Ingrese ROL.
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="flexCheckDefault">
                        <label class="custom-control-label" for="vigenciaCheck1"
                            >Vigencia</label
                        >
                    </div>
                            <div class="form-group d-flex justify-content-end">
                                <button
                                    type="button"
                                    class="btn btn-outline-danger"
                                    data-bs-dismiss="modal"
                                    style="margin-right: 1rem"
                                    onclick ="limpiarData()"
                                >
                                    Cerrar
                                </button>
                                @if( session()->get('privilegios')->escribir == 1)
                                        
    
                                    <button
                                        type="button"
                                        class="btn btn-success"
                                        id="boton"
                                        onclick="agregarUsuario()"
                                        
                                    >
                                        Guardar
                                    </button>
                                @endif
                            </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalWarning" tabindex="-1" aria-labelledby="exampleModalWarningLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalWarningLabel">Eliminar Usuario!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <aside class="callout warning">
            <b> Espera, espera un minuto.☝🏾</b>
            Estas seguro que deseas realizar esta operación, al eliminar un usuario no podra volver a recuperarlo.
        </aside>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger successEliminar" onclick="successEliminar()">Eliminar usuario</button>
      </div>
    </div>
  </div>
</div>


@endsection @section('script')

<script type="text/javascript">
    
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            console.log("aca");
        form.addEventListener('click', function (event) {
            console.log(event.srcElement.classList);
            if(event.srcElement.classList[1] == 'btn-success'){
                
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }else{

                }
                


                form.classList.add('was-validated')
            }

        }, false)
        })
    })()

    
    $(document).ready(function () {

  
        $('#example-text-input-run').rut({
            fn_error: function(input) {
                console.log("Error");
            }
        });

        @if(session()->get('privilegios')->leer == 1)
        getRol();
        llenarDataTables();
        @else
        alert('El usuario no tiene los permisos suficientes para ver la información')
        @endif

        @if(session()->get('privilegios')->escribir == 1 && session()->get('privilegios')->leer == 0 && session()->get('privilegios')->eliminar == 0)
        $(".info-user").append(
        '<button type="button" class="btn btn-info" style="margin-bottom: 0rem;font-size: 0.6rem;margin-left: 0.5rem;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="botonAgregarUsuario(); limpiarData()">Add Usuario</button>');
        @endif

        

    });

    function llenarDataTables(){
        bloquearPantalla();
        var dataTable_usuarios = $("#table_id").DataTable();
        dataTable_usuarios.clear().destroy();

        dataTable_usuarios = $("#table_id").DataTable({
            serverSide: false,
            scrollX: true,
            "autoWidth": false,
            ajax: {
                url: "{{route('getAllUsers')}}",
            },
            language: {
                url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
            },
            columns: [
                {
                    data: "run",
                    name: "run",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                       
                        let html =
                            '<span class="text-secondary text-xs font-weight-bold">' + $.formatRut(row.run +row.dv);+"</span>";
                        return html;
                    },
                },
                {
                    data: "nombre",
                    name: "nombre",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        // let html =
                        //     '<div class="d-flex px-2 py-1"><div><img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"></div><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' +
                        //     row.nombre +
                        //     " " +
                        //     row.ap_paterno +
                        //     " " +
                        //     row.ap_materno +
                        //     '</h6><p class="text-xs text-secondary mb-0">john@creative-tim.com</p></div></div>';
                        let html =
                            '<div class="d-flex px-2 py-1"><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' +
                            row.nombre +
                            " " +
                            row.ap_paterno +
                            " " +
                            row.ap_materno;
                        return html;
                    },
                },
                {
                    data: "email",
                    name: "email",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html =
                            '<span class="text-secondary text-xs font-weight-bold">' +
                            row.email +
                            "</span>";
                        return html;
                    },
                },
                {
                    data: "phone",
                    name: "phone",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html =
                            '<span class="text-secondary text-xs font-weight-bold">' +
                            data +
                            "</span>";
                        return html;
                    },
                },
                {
                    data: "rol_name",
                    name: "rol_name",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let svg = "";
                        if (data === "Administrador") {
                            svg =
                                '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16" style=" font-size: 1.25rem;margin-right: 0.75rem; color: rgb(86, 202, 0);"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>';
                        }
                        let html =
                            '<div class="d-flex align-items-center">' +
                            svg +
                            '<p style="margin-bottom:0px" class="text-secondary text-xs font-weight-bold" >' +
                            data +
                            "</p></div>";
                        return html;
                    },
                },
                {
                    data: "vige_name",
                    name: "vige_name",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html = "";
                        if (data === "Vigente") {
                            html =
                                '<span class="badge badge-success" style="color: '+colores[0].color+'; background-color: '+colores[0].backgroundcolor+'">' +
                                data +
                                "</span>";
                        } else {
                            html =
                                '<span class="badge badge-secondary badge-segundo">' +
                                data +
                                "</span>";
                        }

                        return html;
                    },
                },
                @if(session()->get('privilegios')->eliminar == 1 || session()->get('privilegios')->escribir == 1 || session()->get('privilegios')->leer == 1)
                {
                    data: "acciones",
                    name: "acciones",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html =
                            '<div class="d-flex flex-row" >';


                        @if(session()->get('privilegios')->leer == 1 || session()->get('privilegios')->escribir == 1)
                           html += '<a {{$disableEscribir}} href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEditar" onclick="botonEditarUsuario(' +
                            row.user_id +
                            ')"> <i class="fa fa-pencil"></i></a>';                             
                        @endif
                        
                    
                        
                        @if(session()->get('privilegios')->eliminar == 1)
                        html +=  '<a href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEliminar"  onclick="eliminarUsuario('+row.user_id +')"> <i class="bi bi-trash"></i></a>';
      

                            @endif
                            html += '</div>';
                        return html;
                    },
                },
                @endif
            ],
            drawCallback: function (settings) {
                $("#table_id_info").addClass(
                    "dataTables_info text-secondary text-xs font-weight-bold"
                );
                $("#table_id_paginate").addClass(
                    "dataTables_info text-secondary text-xs font-weight-bold"
                );
            },
            initComplete: function () {
                if('{{$disableEscribir}}' == 'disabled') {
                    $("#table_id_filter").append(
                    '<button type="button" {{$disableEscribir}} class="btn btn-info" style="margin-bottom: 0rem;font-size: 0.6rem;margin-left: 0.5rem;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Usuario</button>'
                );
                }else{
                    $("#table_id_filter").append(
                    '<button type="button" class="btn btn-info" style="margin-bottom: 0rem;font-size: 0.6rem;margin-left: 0.5rem;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="botonAgregarUsuario(); limpiarData()">Add Usuario</button>'
                );
                }
                
                $(".dataTables_length").addClass("p-4");
                $(".dataTables_filter ").addClass("p-4");
                $("p").css("background-color");
                desbloquearPantalla();
            },
        });
    }
    
    function botonAgregarUsuario() {
        $("#boton").attr("onclick", "agregarUsuario()");
    }

    function botonEditarUsuario(id_usuario) {
        $( "#example-text-input-run" ).prop( "disabled", true );
        let data = new Object();
        data.id_usuario = id_usuario;
        $.ajax({
            url: "{{ route('findUser') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                let datosUsuario = resp.data[0];
                $("#example-text-input-run").val($.formatRut(datosUsuario.run + "-" + datosUsuario.dv ));
                $("#example-text-input-nombres").val(datosUsuario.nombre);
                $("#paterno-example-text-input").val(datosUsuario.ap_paterno);
                $("#materno-example-text-input").val(datosUsuario.ap_materno);
                $("#example-email-input").val(datosUsuario.email);
                $("#example-tel-input").val(datosUsuario.phone);
                console.log(datosUsuario.vigencia_id);
                if(datosUsuario.vigencia_id == 1){
                    $('input:checkbox[name="flexCheckDefault"]').attr('checked',true);
                }else{
                    $('input:checkbox[name="flexCheckDefault"]').attr('checked',false);
                }
                $('#rol_select option[value="'+datosUsuario.rol_id+'"]').attr("selected", "selected")
           
            })
            .fail(function (obj) {
                console.log(obj);
                return false;

            });
           
        $("#boton").attr("onclick", "editarUsuario("+id_usuario+")");
        $('#exampleModal').modal('show');
    }

    function getRol(){
        $.ajax({
            url: "{{ route('getRoles') }}",
            type: "get",
        })
            .done(function (resp) {
                $('#rol_select').html('');
                $.each(resp, function (i, item) {
                    $('#rol_select').append($('<option>', { 
                        value: item.id,
                        text : item.name 
                    }));
                });
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function limpiarData(){
        $( "#example-text-input-run" ).prop( "disabled", false );
        $("#example-text-input-run").val("");
        $("#example-text-input-nombres").val("");
        $("#paterno-example-text-input").val("");
        $("#materno-example-text-input").val("");
        $("#example-email-input").val("");
        $("#example-tel-input").val("");
        $('#rol_select option[value="'+$('#rol_select').val()+'"]').attr("selected", false)
        $('input:checkbox[name="flexCheckDefault"]').attr('checked',false);
        $(".needs-validation").removeClass("was-validated");
    }

    function eliminarUsuario(id_usuario){
        $('#exampleModalWarning').modal('show');
        $('.successEliminar').attr('onclick', 'successEliminar('+id_usuario+')');
 
    }

    function successEliminar(id_usuario){
        bloquearPantalla();
        let data = new Object();
        data.id_usuario = id_usuario;
        $.ajax({
            url: "{{ route('delete_user') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                desbloquearPantalla();
                $('#exampleModalWarning').modal('hide');
                if(resp.estado == 1){
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.success(resp.mensaje);
                    llenarDataTables();
                
                }

            })
            .fail(function (obj) {
                desbloquearPantalla();
                console.log(obj);
                
                return false;
            });
    }

    function agregarUsuario(){
        if(validacion()){
            bloquearPantalla();
            let data = new Object();
            data.run = $("#example-text-input-run").val().split(".").join("").split("-").join("").substring(0, $("#example-text-input-run").val().length-1);
            data.dv = data.run[data.run.length - 1];
            data.name = $("#example-text-input-nombres").val();
            data.ap_paterno = $("#paterno-example-text-input").val();
            data.ap_materno = $("#materno-example-text-input").val();
            data.email = $("#example-email-input").val();
            data.phone = $("#example-tel-input").val();
            data.rol_id = $('#rol_select').val();
            if($('input:checkbox[name="flexCheckDefault"]:checked').val() != '1'){
                data.vigencia_id = 0;
            }else{
                data.vigencia_id = 1;
            }

        
            $.ajax({
                url: "{{ route('save_user') }}",
                type: "get",
                
                data: data,
            })
            .done(function (resp) {

                desbloquearPantalla();
                if(resp.estado == 1){
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.success(resp.mensaje);
                    llenarDataTables();
                    $('#exampleModal').modal('hide');
                }else{
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.error(resp.mensaje);

                }

            })
            .fail(function (obj) {
                desbloquearPantalla();
                console.log(obj);
                return false;
            });
        }
        
    }

    function editarUsuario(id_usuario){
        if(validacion()){
            bloquearPantalla();
            let data = new Object();
            data.id_usuario = id_usuario;
            data.run = $("#example-text-input-run").val().split(".").join("").split("-").join("").substring(0, $("#example-text-input-run").val().length-2);
            data.dv = $("#example-text-input-run").val()[$("#example-text-input-run").length];

            data.name = $("#example-text-input-nombres").val();
            data.ap_paterno = $("#paterno-example-text-input").val();
            data.ap_materno = $("#materno-example-text-input").val();
            data.email = $("#example-email-input").val();
            data.phone = $("#example-tel-input").val();
            data.rol_id = $('#rol_select').val();
            if($('input:checkbox[name="flexCheckDefault"]:checked').val() != '1'){
                data.vigencia_id = 2;
            }else{
                data.vigencia_id = 1;
            }
        
            $.ajax({
                url: "{{ route('update_user') }}",
                type: "get",
                
                data: data,
            })
            .done(function (resp) {
                $('#exampleModal').modal('hide');
                desbloquearPantalla();
                if(resp.estado == 1){
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.success(resp.mensaje);
                    llenarDataTables();
                }else{
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.error(resp.mensaje);
                }
            })
            .fail(function (obj) {
                console.log(obj);
                desbloquearPantalla();
                return false;
            });
        }
        
    }

    function validacion(){
       let run = $("#example-text-input-run").val();
       let name = $("#example-text-input-nombres").val();
       let ap_paterno = $("#paterno-example-text-input").val();
       let ap_materno = $("#materno-example-text-input").val();
       let email = $("#example-email-input").val();
       let phone = $("#example-tel-input").val();
       let rol_id = $('#rol_select').val();

       if (run === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar run');
        return false;
       }else if (name === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar nombres');
        return false;
       }else if (phone === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar telefono');
        return false;
       }else if (rol_id === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar rol');
        return false;
       }else if (ap_paterno === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar apellido paterno');
        return false;
       }else if (ap_materno === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar apellido materno');
        return false;
       }else if (email === ""){
        toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
        toastr.error('Debe ingresar apellido email');
        return false;
       }

       return true;
    }


</script>

@endsection
