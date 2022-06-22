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
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"
/>

<main
    class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg"
>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm">
                <div class="card mb-4">
                    <div class="card-header pb-0 tree"></div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card mb-4">
                    <div class="card-header pb-0">
     
                        <form class="needs-validation" novalidate>
                            <div class="form-group">
                                <input id="editar_id" value="" class="d-none"/>
                                <label
                                    for="tipo_select"
                                    class="form-control-label"
                                    >Tipo</label
                                >

                                <select id="tipo_select" class="form-control" required {{ $disableEscribir}}>
                                    
                                    <option  value="" >Seleccione Tipo</option>
                                    <option value="0">Menu</option>
                                    <option value="1">Submemu</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, Ingrese titulo.
                                </div>
                            </div>
                            <div class="form-group d-none si-menu">
                                <label
                                    for="menu_select"
                                    class="form-control-label"
                                    >Menu</label
                                >
                                <select id="menu_select" class="form-control" {{ $disableEscribir}}>
                                    <option value="">Seleccione Menu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="example-text-input-titulo"
                                    class="form-control-label"
                                    >Titulo</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="titulo"
                                    value=""
                                    id="example-text-input-titulo"
                                    onkeyup="generarPath()"
                                    onkeydown="generarPath()"
                                    required
                                    {{ $disableEscribir}}
                                />
                                <div class="invalid-feedback">
                                    Por favor, Ingrese titulo.
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label
                                        for="example-text-input-icono"
                                        class="form-control-label"
                                        >Icono
                                    </label>
                                    <i
                                        class="bi bi-info-circle"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        title="Solo ingrese clases de iconos de boostrap"
                                    ></i>
                                </div>

                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Icono"
                                    value=""
                                    id="example-text-input-icono"
                                    {{ $disableEscribir}}
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="example-text-input-descripcion"
                                    class="form-control-label"
                                    >Descripción</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Descripción"
                                    value=""
                                    id="example-text-input-descripcion"
                                    {{ $disableEscribir}}
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="ordens_select"
                                    class="form-control-label"
                                    >Orden</label
                                >
                                <select class="form-select" aria-label="Default select example" id="ordens_select" required {{ $disableEscribir}}>
                                    <option value="">Seleccione orden</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, Seleccione el orden.
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    for="example-text-input-url"
                                    class="form-control-label"
                                    >URL</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="URL"
                                    value=""
                                    id="example-text-input-url"
                                    disabled

                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="perfil_select"
                                    class="form-control-label"
                                    >Perfil</label
                                >
                                <select
                                    multiple="multiple"
                                    id="perfil_select"
                                    class="form-select multiple-select "
                                    style="width: 100%"
                                    required
                                    {{ $disableEscribir}}
                                ></select>
                                <div class="invalid-feedback">
                                    Por favor, Seleccione el perfil.
                                </div>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    id="fcustomCheck1"
                                    {{ $disableEscribir}}
                                />
                                <label
                                    class="custom-control-label"
                                    for="fcustomCheck1"
                                    >Vigencia</label
                                >
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button
                                    type="button"
                                    class="btn btn-outline-danger"
                                    onclick="limpiarData()"
                                    style="margin-right: 11px;"
                                >
                                    Limpiar
                                </button>
                                @if( session()->get('privilegios')->escribir == 1)
    
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    id="boton"
                                    onclick="validacion()"
                                  
                                    
                                >
                                    Guardar
                                </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Menu</h6>
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
                                            Nombre
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Path
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Icono
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Tipo Menu
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Roles
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Orden
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Vigencia
                                        </th>
                                        @if(session()->get('privilegios')->eliminar == 1 || session()->get('privilegios')->escribir == 1 ||  session()->get('privilegios')->leer == 1 )
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
</main>
<!-- Modal -->
<div
    class="modal fade"
    id="exampleModalWarning"
    tabindex="-1"
    aria-labelledby="exampleModalWarningLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalWarningLabel">
                    Eliminar Menu!
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <aside class="callout warning">
                    <b> Espera, espera un minuto.☝🏾</b>
                    Estas seguro que deseas realizar esta operación, al eliminar
                    un menu no podra volver a recuperarlo.
                </aside>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button
                    type="button"
                    class="btn btn-danger successEliminar"
                    onclick="successEliminar()"
                >
                    Save changes
                </button>
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

    function validacion(){
        toastr.options.closeHtml =
                '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
        if($("#tipo_select").val() == ""){
            toastr.error('Debe seleccionar tipo');
            return false;
        }else if($("#tipo_select").val() == "1"){
            if($("#menu_select").val() == ""){
                toastr.error('Debe seleccionar Menu');
                return false;
            }
        }

        if($("#example-text-input-titulo").val() == ""){
            toastr.error('Debe ingresar Titulo');
            return false;
        }

        if($("#ordens_select").val() == ""){
            toastr.error('Debe seleccionar orden');
            return false;
        }

        if($("#editar_id").val() == ""){
            guardarMenu()
        }else{
            editarMenu($("#editar_id").val());
        }
    }


    $(document).ready(function () {

        @if(session()->get('privilegios')->leer == 1)
        getMenu();
        menuTree();
        getRol();
        @else
            alert('El usuario no tiene los permisos suficientes para ver la información')
        @endif

        @if(session()->get('privilegios')->escribir == 1)
            getRol();
            getMenuPadre();
        @endif
    });

    function getOrden(padre, orden = null){

        let data = new Object();
        data.id = padre;
        if($("#editar_id").val() != ""){
            data.editar = 'si';
        }else{
            data.editar = 'no';
        }

        if($("#tipo_select").val() == "1"){
            data.menu_padre = $("#menu_select").val();
        }else{
            data.menu_padre = "";
        }

        $.ajax({
            url: "{{ route('obtenerOrden') }}",
            type: "get",
            data: data,
        })
        .done(function (resp) {
            $("#ordens_select").empty();
            $("#ordens_select").append(
                        $("<option>", {
                            value: '',
                            text: 'Seleccione Orden',
                        })
                    );
                $.each(resp.data, function (i, item) {
                    $("#ordens_select").append(
                        $("<option>", {
                            value: item.orden,
                            text: item.orden,
                        })
                    );
                    // $('#ordens_select option[value="' + item.id + '"]').attr(
                    //     "selected",
                    //     "selected"
                    // );
                });
                console.log(orden);
                $(
                    '#ordens_select option[value="' +
                        $("#ordens_select").val() +
                        '"]'
                    ).attr("selected", false);
                if(orden != null){
         
                    $('#ordens_select option[value="'+orden+'"]').attr("selected", true);
                }else{
                    $('#ordens_select option[value=""]').attr("selected", true);
                }

        })
        .fail(function (obj) {
            console.log(obj);
            return false;
        });
    }
    function getMenu() {
        var dataTable_menu = $("#table_id").DataTable();
        dataTable_menu.clear().destroy();
        dataTable_menu = $("#table_id").DataTable({
            serverSide: false,
            scrollX: true,
            ajax: {
                url: "{{route('getMenu')}}",
            },
            language: {
                url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
            },
            columns: [
                {
                    data: "name",
                    name: "name",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "path",
                    name: "path",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "icon",
                    name: "icon",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html = "";
                        if (data) {
                            html =
                                '<i class="' +
                                data +
                                ' text-dark " style="width: 12px;height: 12px;"></i>';
                        } else {
                            html = "No corresponde";
                        }

                        return html;
                    },
                },
                {
                    data: "padre",
                    name: "padre",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let nombre = "subMenu";
                        let className = "badge badge-success badge-amarillo";
                        if (data === "0") {
                            nombre = "Menu";
                            className = "badge badge-success badge-verde";
                        }
                        let html =
                            '<span class="' +
                            className +
                            '">' +
                            nombre +
                            "</span>";
                        return html;
                    },
                },
                {
                    data: "role",
                    name: "role",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html = "";
                        data.forEach(function (valor, indice, array) {
                            html +=
                                '<span class="badge badge-success" style="color: ' +
                                colores[indice].color +
                                "; background-color: " +
                                colores[indice].backgroundcolor +
                                ' ;margin-left: 3px;margin-right: 3px;" >' +
                                valor.name +
                                "</span>";
                        });
                        return html;
                    },
                },
                {
                    data: "orden",
                    name: "orden",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true
                   
                },
                {
                    data: "nombre_vigencia",
                    name: "nombre_vigencia",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let html = "";
                        if (data === "Vigente") {
                            html =
                                '<span class="badge badge-success badge-verde">' +
                                data +
                                "</span>";
                        } else {
                            html =
                                '<span class="badge badge-secondary badge-segundo">' +
                                data +
                                "</span>";
                        }
                        html += '<div class="d-none">'+data+'</div>';
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
                           html += '<a href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEditar" onclick="botonEditarMenu(' +
                            row.id +
                            ')"> <i class="fa fa-pencil"></i></a>';                             
                        @endif
                        
                    
                        
                        @if(session()->get('privilegios')->eliminar == 1)
                        html +=  '<a href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEliminar"  onclick="eliminarMenu(' +
                            row.id +
                            ')"> <i class="bi bi-trash"></i></a>';
                        
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
            initComplete: function () {},
        });
    }

    function botonEditarMenu(id) {
        $("#editar_id").val(id);
        let data = new Object();
        data.id = id;
        $.ajax({
            url: "{{ route('findMenu') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
               
                if (resp.estado == 0) {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.error(resp.mensaje);
                } else {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.success(
                        "Se ha obtenido información de menu con exito!"
                    );

                    let data = resp.data;
                    getOrden(data.padre, data.orden);
                    $(
                        '#tipo_select option[value="' +
                            $("#tipo_select").val() +
                            '"]'
                    ).attr("selected", false);
                    if (data.padre != 0) {
                        obtenerMenuPadre(data.padre);
                        $('#tipo_select option[value="1"]').attr("selected", true);
                       
                
                        $(".si-menu").removeClass("d-none");
                    } else {
                        $('#tipo_select option[value="0"]').attr("selected", true);
                    }

                    $("#example-text-input-icono").val(data.icon);
                    $("#example-text-input-descripcion").val(data.descripcion);
                    $("#example-text-input-titulo").val(data.name);
                    $("#example-text-input-url").val(data.path);
                    if (data.vigencia_id == 1) {
                        $("#fcustomCheck1").prop("checked", true);
                    } else {
                        $("#fcustomCheck1").prop("checked", false);
                    }

                    let array = [];
                    $.each(data.roles, function (i, item) {
                        array.push(item.rol_id);
                    });

                    $("#perfil_select").multipleSelect("setSelects", array);
             

                }
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function successEliminar(id) {
        let data = new Object();
        data.id = id;
        $.ajax({
            url: "{{ route('delete_menu') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                $("#exampleModalWarning").modal("hide");
                if (resp.estado == 1) {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.success(resp.mensaje);
                    getMenu();
                }
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function eliminarMenu(id) {
        $("#exampleModalWarning").modal("show");
        $(".successEliminar").attr("onclick", "successEliminar(" + id + ")");
    }

    function obtenerMenuPadre(id) {
        let data = new Object();
        data.id = id;
        $.ajax({
            url: "{{ route('findMenu') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                $("#menu_select").empty();
                $.each(resp, function (i, item) {
                    $("#menu_select").append(
                        $("<option>", {
                            value: item.id,
                            text: item.name,
                        })
                    );
                    $('#menu_select option[value="' + item.id + '"]').attr(
                        "selected",
                        "selected"
                    );
                });
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function limpiarData() {
        $("#editar_id").val("");
        $(".si-menu").addClass("d-none");
        $('#tipo_select option[value="' + $("#tipo_select").val() + '"]').attr(
            "selected",
            false
        );
        $('#tipo_select option[value=""]').attr(
            "selected",
            true
        );
        $("#example-text-input-icono").val("");
        $("#example-text-input-descripcion").val("");
        $("#example-text-input-titulo").val("");
        $("#example-text-input-url").val("");
        $("#fcustomCheck1").prop("checked", false);
        $("#perfil_select").multipleSelect("setSelects", []);
        $('#ordens_select option[value="' + $("#ordens_select").val() + '"]').attr(
            "selected",
            false
        );
        $('#ordens_select option[value=" "]').attr(
            "selected",
            true
        );

        $(".needs-validation").removeClass("was-validated");
    }

    $("#tipo_select").on("change", function () {
        if ($("#tipo_select").val() == "1") {
            $(".si-menu").removeClass("d-none");
        } else {
            $(".si-menu").addClass("d-none");
        }
        getOrden($("#tipo_select").val());
    });

    $("#menu_select").on("change", function () {
        getOrden($("#tipo_select").val());
    });


    function generarPath() {
        let menu_title = '/' + $("#example-text-input-titulo").val().toLowerCase();
        let result = menu_title.indexOf(" ");
        let resultado = "";

        if (result > 0) {
            resultado = menu_title.replace(" ", "_");
        } else {
            resultado = menu_title;
        }

        $("#example-text-input-url").val(resultado);
    }

    function getRol() {
        $.ajax({
            url: "{{ route('getRoles') }}",
            type: "get",
        })
            .done(function (resp) {
                $.each(resp, function (i, item) {
                    $("#perfil_select").append(
                        $("<option>", {
                            value: item.id,
                            text: item.name,
                        })
                    );
                });
                $("#perfil_select").multipleSelect();
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function getMenuPadre() {
        $.ajax({
            url: "{{ route('getMenuPadre') }}",
            type: "get",
        })
            .done(function (resp) {
                $("#menu_select").html('');
                $.each(resp.data, function (i, item) {
                    $("#menu_select").append(
                        $("<option>", {
                            value: item.id,
                            text: item.name,
                        })
                    );
                });
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function boton(id = null) {
        event.preventDefault();
        if (id == null) {
            guardarMenu();
        } else {
            editarMenu(id);
        }
    }

    function guardarMenu() {
        event.preventDefault();
        let data = new Object();
        data.padre = $("#tipo_select").val();
        if ($("#tipo_select").val() == "1") {
            data.padre = $("#menu_select").val();
        }
        data.icon = $("#example-text-input-icono").val();
        data.descripcion = $("#example-text-input-descripcion").val();
        data.name = $("#example-text-input-titulo").val();
        data.path = $("#example-text-input-url").val();
        data.orden = $("#ordens_select").val();
        if ($('input:checkbox[id="fcustomCheck1"]:checked').val() != "1") {
            data.vigencia_id = 2;
        } else {
            data.vigencia_id = 1;
        }

        data.role = $("#perfil_select").multipleSelect("getSelects");

        $.ajax({
            url: "{{ route('save_menu') }}",
            type: "get",

            data: data,
        })
            .done(function (resp) {
                // $('#exampleModal').modal('hide');
                if (resp.estado == 1) {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.success(resp.mensaje);
                    getMenu();
                    getMenuPadre();
                    limpiarData();
                    html = "";
                    $("#jstree").html("");
                    menuTree();
                } else {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.error(resp.mensaje);
                }
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function editarMenu(id) {
        event.preventDefault();
        let data = new Object();
        data.id = id;
        data.padre = $("#tipo_select").val();
        data.orden = $("#ordens_select").val();
        if ($("#tipo_select").val() == "1") {
            data.padre = $("#menu_select").val();
        }
        data.icon = $("#example-text-input-icono").val();
        data.descripcion = $("#example-text-input-descripcion").val();
        data.name = $("#example-text-input-titulo").val();
        data.path = $("#example-text-input-url").val();
        if ($('input:checkbox[id="fcustomCheck1"]:checked').val() != "1") {
            data.vigencia_id = 2;
        } else {
            data.vigencia_id = 1;
        }

        data.role = $("#perfil_select").multipleSelect("getSelects");

        $.ajax({
            url: "{{ route('editar_menu') }}",
            type: "get",

            data: data,
        })
            .done(function (resp) {
                if (resp.estado == 1) {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.success(resp.mensaje);
                    getMenu();
                    limpiarData();
                    html = "";
                    $("#jstree").html("");
                    menuTree();
                } else {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                    toastr.error(resp.mensaje);
                }
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }
</script>

<script>
    let html = "";
    function menuTree() {
        $.ajax({
            url: "{{ route('MenuTreeRol') }}",
            type: "get",
        })
            .done(function (resp) {
                recursivosTree(resp.data);
                $(".tree").html('<div id="jstree"></div>');
                $("#jstree").html("");
                $("#jstree").html(html);
                $("#jstree").jstree();
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }
    function recursivosTree(data) {
        html += "<ul>";
        for (var i = 0; i < data.length; i++) {
            if (data[i].tipo == "Menu") {
                padre(data[i]);
                if (i != data.length - 1) {
                    html += "</li>";
                }
            } else {
                hijo(data[i]);
            }

            if (i == data.length - 1) {
                html += "</ul>";
            }
        }
    }

    function padre(data) {
        html += '<li id="padre_' + data.id + '">' + data.name;

        if (data.subMenu) {
            recursivosTree(data.subMenu);
        } else {
            html += "</li>";
        }
    }
    function hijo(data) {
        html += '<li id="padre_' + data.id + '">' + data.name;
        if (data.subMenu) {
            recursivosTree(data.subMenu);
        } else {
            html += "</li>";
        }
    }
</script>

@endsection
