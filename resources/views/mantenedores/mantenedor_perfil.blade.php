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
        <h5 class="">Roles List</h5>
        <p class="">
            Un rol proporciona acceso a menús y funciones predefinidas para que,
            dependiendo del rol asignado, un administrador pueda tener acceso a
            lo que necesita
        </p>
        <div class="row tarjetaAdd">
        <div class="tarjeta col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div
                            class="d-flex justify-content-between align-items-center"
                        >
                            <div class="d-flex justify-content-center">
                                <img
                                    width="65"
                                    height="130"
                                    alt="add-role"
                                    src="https://demos.themeselection.com/marketplace/materio-mui-react-nextjs-admin-template/demo-3/images/cards/pose_m1.png"
                                />
                            </div>
                            <div>
                                <div class="p-4">
                                    <div class="text-center">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            onclick="changeTitulo('Add Role'),  changeSubmit('agregarRol')"
                                            
                                        >
                                            Add Role
                                        </button>
                                        <p>Añadir rol, si no existe.</p>
                                    </div>
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
                    <div class="card-header pb-0">
                        <h6>Usuarios</h6>
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        >
                                            Acciones
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
<!-- Modal AGREGAR Y EDITAR ROL-->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div
                    class="d-flex flex-column justify-content-center text-center"
                >
                    <span
                        class="text-center"
                        id="titulo-modal"
                        style="
                            font-weight: 500;
                            font-size: 1.5625rem;
                            line-height: 1.235;
                            letter-spacing: 0.25px;
                            color: rgba(58, 53, 65, 0.87);
                        "
                    ></span>
                    <p
                        class="text-center"
                        style="
                            font-weight: 400;
                            font-size: 0.875rem;
                            line-height: 1.5;
                            letter-spacing: 0.15px;
                            color: rgba(58, 53, 65, 0.68);
                        "
                    >
                        Establecer los permisos de los roles
                    </p>
                </div>
                <div style="padding: 1rem; padding-top: 0px">
                    <form>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                                placeholder="Nombre del rol"
                            />
                        </div>
                    </form>
                </div>
                @if(session()->get('privilegios')->leer == 1)
                <table id="tabla_privilegios">
                    <thead>
                        <tr>
                            <th scope="col">Rol</th>
                            <th scope="col">Leer</th>
                            <th scope="col">Escribir</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Vigencia</th>
                            @if(session()->get('privilegios')->eliminar == 1)
                            <th scope="col">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                @endif
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-dismiss="modal"
                    onclick="limpiarData()"
                >
                    Close
                </button>
                @if( session()->get('privilegios')->escribir == 1)
                <button type="button" id="sumitModal" class="btn btn-success">
                    Submit
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal DATOS USUARIO-->

<div
    class="modal fade"
    id="UsuarioModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="UsuarioModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    style="color: black"
                >
                    ✖
                </button>
            </div>
            <div class="modal-body">
            <div class="card mb-4">
                    @include('components.infoUsuario')
                    <div class="card-body p-3">
                        <h5>Detalles</h5>
                        <hr class="" style="
                                            flex-shrink: 0;
                                            border-width: 0px 0px thin;
                                            border-style: solid;
                                            border-color: rgba(
                                                58,
                                                53,
                                                65,
                                                0.12
                                            );
                                            margin: 0.5rem 0px;
                                        ">
                        @include('components.detallesUsuario')
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ELIMINAR ROL-->



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
                    Eliminar Rol!
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
                    un rol no podra volver a recuperarlo.
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

    $(document).ready(function () {
        @if(session()->get('privilegios')->leer == 1)

        getUsuario();
        getRol();
        getPrivilegiosRoles();
        @else
            alert('El usuario no tiene los permisos suficientes para ver la información')
        @endif
    });

    function getUsuario() {
        var dataTable_usuarios = $("#table_id").DataTable();
        dataTable_usuarios.clear().destroy();
        dataTable_usuarios = $("#table_id").DataTable({
            processing: true,
            serverSide: false,
            scrollX: true,
            autoWidth: false,
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
                            '<span class="text-secondary text-xs font-weight-bold">' +
                            row.run +
                            "-" +
                            row.dv +
                            "</span>";
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
                        let html =
                            '<div class="d-flex px-2 py-1"><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' +
                            row.nombre +
                            " " +
                            row.ap_paterno +
                            " " +
                            row.ap_materno +
                            "</h6></div></div>";
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
                                '<span class="badge badge-success badge-verde">' +
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
                {
                    data: "acciones",
                    name: "acciones",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let disable = "";
                        let html =
                            '<a href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEditar" onclick="getDataUsuario(' +
                            row.user_id +
                            '), tablaHistory('+row.user_id+')" data-bs-toggle="modal"  data-bs-target="#UsuarioModal" ' +
                            disable +
                            '> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg></a>';
                        return html;
                    },
                },
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

    function botonAgregarPerfil() {
        $("#sumitModal").attr("onclick", "agregarPerfil()");
    }

    function botonEditarPerfil(id_perfil) {}

    function getRol() {
        var dataTable_rol = $("#tabla_privilegios").DataTable();
        dataTable_rol.clear().destroy();
        dataTable_rol = $("#tabla_privilegios").DataTable({
            processing: true,
            serverSide: false,
            bLengthChange: false,
            bInfo: false,
            bFilter: false,
            autoWidth: true,
            ajax: {
                url: "{{route('getPrivilegiosRoles')}}",
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
                    render: function (data, type, row) {
                        return (
                            '<div class="d-flex px-2 py-1"><div class="d-flex flex-column justify-content-center"><h6 class="mb-0 text-sm">' +
                            data +
                            "</h6></div></div>"
                        );
                    },
                },
                {
                    data: "leer",
                    name: "leer",
                    className: "text-center",
                    visible: true,
                    render: function (data, type, row) {
                        let checked = "";
                        if (data === "1") {
                            checked = "checked";
                        }
                        let html =
                            '<div class="form-check" style="display: flex;text-align: center;"><input class="form-check-input" style="margin-left: -19px;" type="checkbox" value="1" id="fcustomCheckLeer' +
                            row.id +
                            '" ' +
                            checked +
                            " /></div>";
                        return html;
                    },
                },
                {
                    data: "escribir",
                    name: "escribir",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let checked = "";
                        if (data === "1") {
                            checked = "checked";
                        }
                        let html =
                            '<div class="form-check" style="display: flex;text-align: center;"><input class="form-check-input" style="margin-left: -19px;" type="checkbox" value="1" id="fcustomCheckEscribir' +
                            row.id +
                            '" ' +
                            checked +
                            " /></div>";
                        return html;
                    },
                },
                {
                    data: "eliminar",
                    name: "eliminar",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let checked = "";
                        if (data === "1") {
                            checked = "checked";
                        }
                        let html =
                            '<div class="form-check" style="display: flex;text-align: center;"><input class="form-check-input" style="margin-left: -19px;" type="checkbox" value="1" id="fcustomCheckEliminar' +
                            row.id +
                            '" ' +
                            checked +
                            ' onclick="handleClick(this,fcustomCheckEliminar' +
                            row.id +
                            ' );"/></div>';
                        return html;
                    },
                },
                {
                    data: "vigencia_id",
                    name: "vigencia_id",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let checked = "";
                        if (data === "1") {
                            checked = "checked";
                        }
                        let html =
                            '<div class="form-check" style="display: flex;text-align: center;"><input class="form-check-input" style="margin-left: -19px;" type="checkbox" value="1" id="fcustomCheckVigencia'+row.id+'" '+
                            checked +
                            ' onclick="handleClick(this,fcustomCheckVigencia' +
                            row.id +
                            ' );"/> <label class="custom-control-label" for="customCheck1">Vigencia</label></div>';
                        return html;
                    },
                },
                @if(session()->get('privilegios')->eliminar == 1)
                {
                    data: "accion",
                    name: "accion",
                    className: "text-center",
                    visible: true,
                    orderable: true,
                    searchable: true,
                    render: function (data, type, row) {
                        let disable = "";
                        let disableEliminar = "";
                        let html =
                            '<div class="d-flex flex-row" ><a href="javascript: void(0);" class="nav-link text-body p-0 px-3 iconEliminar" ' +
                            disableEliminar +
                            ' onclick="elimiarRol(' +
                            row.id +
                            ')"> <i class="bi bi-trash"></i></a></div>';
                        return html;
                    },
                },
                @endif
            ],
            drawCallback: function (settings) {},
            initComplete: function () {},
        });

        // $('#tabla_privilegios').on( 'click', 'tbody td:not(:first-child)', function (e) {
        //     editor.inline( this );
        // } );
    }

    function limpiarData() {
        $("#exampleFormControlInput1").val("");
    }

    function eliminarPerfil(id_perfil) {}

    function agregarRol() {
        let dataEnviar = [];
        var table = [];
        if($("#tabla_privilegios").length){
            table = $("#tabla_privilegios").DataTable();

            table
                .rows()
                .eq(0)
                .each(function (index) {
                    var row = table.row(index);

                    var data = row.data();

                    let idLeer = "fcustomCheckLeer" + data.id;
                    let idEscribir = "fcustomCheckEscribir" + data.id;
                    let idEliminar = "fcustomCheckEliminar" + data.id;
                    let idVigencia = "fcustomCheckVigencia" + data.id;
    
                    if ($('input:checkbox[id="' + idLeer + '"]:checked').val()) {
                        data.leer = 1;
                    } else {
                        data.leer = 0;
                    }

                    if (
                        $('input:checkbox[id="' + idEscribir + '"]:checked').val()
                    ) {
                        data.escribir = 1;
                    } else {
                        data.escribir = 0;
                    }

                    if (
                        $('input:checkbox[id="' + idEliminar + '"]:checked').val()
                    ) {
                        data.eliminar = 1;
                    } else {
                        data.eliminar = 0;
                    }

                    if (
                        $('input:checkbox[id="' + idVigencia + '"]:checked').val()
                    ) {
                        data.vigencia_id = 1;
                    } else {
                        data.vigencia_id = 2;
                    }
                    dataEnviar.push(data);
                });

        }
        
            let data = new Object();
        
        data.name = $("#exampleFormControlInput1").val();
        data.tabla = dataEnviar;

        $.ajax({
            url: "{{ route('addRole') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                if (resp.estado == 1) {
                    toastr.options.closeHtml =
                        '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.success(resp.mensaje);
                    getRol();
                    getPrivilegiosRoles();
                    limpiarData();
                }
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

    function editarPerfil(id_Perfil) {}

    function changeTitulo(titulo) {
        $("#titulo-modal").html(titulo);
    }

    function changeSubmit(submit) {
        let name_function = submit + "()";
        $("#sumitModal").attr("onclick", name_function);
    }

    function getPrivilegiosRoles() {
        $.ajax({
            url: "{{ route('getPrivilegios') }}",
            type: "get",
        })
            .done(function (resp) {
                let tarjeta = $(".tarjeta").html();
                $(".tarjetaAdd").html('');
                let html = '';
                resp.data.forEach(function (valor, indice, array) {
                    if(indice < 7){

                  
                        html +=
                            '<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4"><div class="card mb-4"><div class="card-header pb-0"><div class="">';
                        html +=
                            "<p>Total " +
                            valor.total +
                            ' users</p></div></div><div class="card-header pb-0">';
                        html +=
                            "<h6>" +
                            valor.name +
                            '</h6><div class="d-flex justify-content-between align-items-center"><p style="font-weight: 400;font-size: 0.875rem;line-height: 1.5;letter-spacing: 0.15px;color: rgb(145, 85, 253);cursor: pointer;">Edit Role</p>';
                        html +=
                            '<a style="margin-bottom: 1rem"><svgxmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bounding-box" viewBox="0 0 16 16"><path d="M5 2V0H0v5h2v6H0v5h5v-2h6v2h5v-5h-2V5h2V0h-5v2H5zm6 1v2h2v6h-2v2H5v-2H3V5h2V3h6zm1-2h3v3h-3V1zm3 11v3h-3v-3h3zM4 15H1v-3h3v3zM1 4V1h3v3H1z"></path></svg>';
                        html +=
                            '<span class="visually-hidden" onclick="changeTitulo(Editar Role), changeSubmit(editarRol)" data-bs-toggle="modal"data-bs-target="#exampleModal">Button</span>';
                        html += "</a></div></div></div></div>";

                    }
                });
         
                html += '<div class="tarjeta col-xl-4 col-sm-6 mb-xl-0 mb-4">'
                html += tarjeta;
                html += '</div>'
                $(".tarjetaAdd").prepend(html);
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }
    function handleClick(cb, id) {
        console.log("Click, new value = " + cb.checked);
        if (cb.checked == true) {
            $('input:checkbox[name="' + id + '"]').attr("checked", true);
        } else {
            $('input:checkbox[name="' + id + '"]').attr("checked", false);
        }
    }

    function elimiarRol(id_rol) {
        $("#exampleModal").modal("hide");
        $("#exampleModalWarning").modal("show");
        $(".successEliminar").attr(
            "onclick",
            "successEliminar(" + id_rol + ")"
        );
    }

    function successEliminar(id) {
        let data = new Object();
        data.id = id;
        $.ajax({
            url: "{{ route('delete_rol') }}",
            type: "get",
            data: data,
        })
            .done(function (resp) {
                $("#exampleModalWarning").modal("hide");
                toastr.options.closeHtml =
                    '<button class="closebtn"><i class="bi bi-x-square"></i></button>';
                if (resp.estado == 1) {
                    toastr.success(resp.mensaje);
                } else {
                    toastr.error(resp.mensaje);
                }

                getRol();
                getPrivilegiosRoles();
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }
</script>

<style>

#history {
    border-bottom: none !important;
    }
table.dataTable tbody td {
     padding: 0px 0px !important; 
}
table.dataTable.display tbody td {
     border-top: none  !important; 
}
table.dataTable.stripe > tbody > tr.odd > *, table.dataTable.display > tbody > tr.odd > * {
     box-shadow: none  !important; 
}
table.dataTable.order-column > tbody tr > .sorting_1, table.dataTable.order-column > tbody tr > .sorting_2, table.dataTable.order-column > tbody tr > .sorting_3, table.dataTable.display > tbody tr > .sorting_1, table.dataTable.display > tbody tr > .sorting_2, table.dataTable.display > tbody tr > .sorting_3 {
    box-shadow: none  !important; 
}
table.dataTable.display > tbody > tr.odd > .sorting_1, table.dataTable.order-column.stripe > tbody > tr.odd > .sorting_1 {
    box-shadow: none  !important; 
}

table.dataTable.display > tbody > tr.odd > .sorting_1, table.dataTable.order-column.stripe > tbody > tr.odd > .sorting_1 {
    box-shadow: none  !important; 
}
table.dataTable.no-footer {
    border-bottom: none !important;
}
td.text-center {
    text-align: initial!important;
}
.dataTables_wrapper .dataTables_paginate {
    font-family: Inter, sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-weight: 400;
    font-size: 0.875rem;
    line-height: 1.5;
    letter-spacing: 0.15px;
    flex-shrink: 0;
    color: rgba(58, 53, 65, 0.87);
}

</style>
@endsection
