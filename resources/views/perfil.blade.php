@extends('layouts.user_type.auth') @section('content')
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm col-lg-4 col-md-6">
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
                        <div class="d-grid gap-2 d-md-block mt-4 d-flex flex-column align-items-center text-center">
                            <button class="btn btn-primary" style="margin-right: 1rem;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</button>
                            <!-- <button class="btn btn-outline-danger" type="button">Button</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
                                        <i class="bi bi-person text-sm me-2"></i>
                                        Visión general
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <i class="bi bi-lock text-sm me-2"></i>
                                        Seguridad
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="card h-100">
                                        <div class="card-header pb-0">
                                            <h6>Actividades</h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="timeline timeline-one-side" id="history">
                                                <!-- <table id="history" class="display">
                                                    <thead>
                                                        <tr>
                                                            <th class="" style="visibility: hidden;">Column 1</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bodyHistory" class="">
                                                        <tr>
                                                            <td>Row 1 Data 1</td>
                                                        </tr>
                                                    </tbody>
                                                </table> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card h-100">
                                        <div class="card-header pb-0">
                                            <h6>Cambia la contraseña</h6>
                                           
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="alert alert-warning" role="alert" style="background-image:none">
                                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                                <strong>Asegúrese de que se cumplan estos requisitos</strong>
                                                </br>
                                                <span class="alert-text">Mínimo 8 caracteres de largo, mayúsculas, numeros y símbolos
                             
                                                </span>
                                            </div>
                                            <form class="row g-3 mb-4 needs-validation" novalidate>
                                                <div class="col-auto">
                                                    <label for="inputPassword1" class="visually-hidden">Password</label>
                                                    <input type="password" class="form-control" id="inputPassword1" placeholder="Password" required>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="inputPassword2" class="visually-hidden">Password</label>
                                                    <input type="password" class="form-control" id="inputPassword2" placeholder="Password" required>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-primary mb-3" onclick="cambiarContrasena()">Cambiar Contraseña</button>
                                                </div>
                                            </form>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                    disabled
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
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    id="boton"
                                    onclick="editarUsuario({{Auth::user()->id}})"
                                    
                                >
                                    Guardar
                                </button>
                            </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('click', function (event) {
            if(event.srcElement.classList[1] == 'btn-success' || event.srcElement.classList[1] == 'btn-primary'){
              
                console.log(validacionContrasena());
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }else if(validacionContrasena() == false){
                    event.preventDefault();
                    event.stopPropagation();
                }


                form.classList.add('was-validated')
            }

        }, false)
        })
})()

function limpiarData(){
    $(".needs-validation").removeClass("was-validated");
}

    $(document).ready(function () {
        bloquearPantalla();
        
        getRol();

        setTimeout(function(){
            getDataUsuario("{{Auth::user()->id}}");
        }, 1000);

        // getHistory("{{Auth::user()->id}}");
        tablaHistory("{{Auth::user()->id}}");


    });



    function getRol(){
        $.ajax({
            url: "{{ route('getRoles') }}",
            type: "get",
        })
            .done(function (resp) {
                console.log(resp);
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
                    getDataUsuario({{Auth::user()->id}});
                    limpiarData();
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
    
    function cambiarContrasena(){

        if(validacionContrasena()){
            bloquearPantalla();
            let data = new Object();
            data.id_usuario = "{{Auth::user()->id}}";
            data.cont = $("#inputPassword1").val();
            
            $.ajax({
                url: "{{ route('changeContrasena') }}",
                type: "get",
                data: data,
            })
            .done(function (resp) {
                desbloquearPantalla();
                if(resp.estado == 1){
                    getHistory();
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.success(resp.mensaje);
                }else{
                    toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                    toastr.error(resp.mensaje);
                }
                limpiarData();
                $("#inputPassword1").val('');
                $("#inputPassword2").val('');
            })
            .fail(function (obj) {
                console.log(obj);
                desbloquearPantalla();
                return false;
            });
        }
    }

    function validacionContrasena(){
        if($("#inputPassword1").val() != $("#inputPassword2").val()){
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error("Contraseña no coincide");
            return false;
        }

        if ($("#inputPassword1").val().length == 0 || $("#inputPassword2").val().length == 0) {
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error("Los campos de la password no pueden quedar vacios");
            return false;
        }

        //validar longitud contraseña
        if ( $("#inputPassword1").val().length < 8 ) {
            toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
            toastr.error("La contraseña debe contener minimo 8 caracteres");
            return false;
        }

            //validar letra
            if (!$("#inputPassword1").val().match(/[A-z]/)) {
                toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                toastr.error("La contraseña debe contener letras");
                return false;
            }

            //validar letra mayúscula
            if (!$("#inputPassword1").val().match(/[A-Z]/) ) {
                toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                toastr.error("La contraseña debe contener mayusculas");
                return false;
            }

            //validar numero
            if (!$("#inputPassword1").val().match(/\d/) ) {
                toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                toastr.error("La contraseña debe contener numeros");
                return false;
            }

            if(!$("#inputPassword1").val().match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)){
                toastr.options.closeHtml = '<button class="closebtn"><i class="bi bi-x"></i></button>';
                toastr.error("La contraseña debe contener caracteres especiales");
                return false;
            }

            return true;
    }

    function getHistory(id_usuario){
        let data = new Object();
        data.id_usuario = id_usuario;
        $.ajax({
            url: "{{ route('getHistory') }}",
            type: "get",
            data: data,
        })
        .done(function (resp) {
            console.log(resp);
            let data = resp.data;
            let html = '';
            data.forEach( function(valor, indice, array) {
                let icono = '';
                let iconoDescription = '';
                let color = '';

                if(valor.acción == 'Ver'){
                    icono = 'bi bi-eye';
                    color = 'style="color: '+colores[1].color+'"';
                }else if (valor.acción == 'Crear'){
                    icono = 'bi bi-plus-circle';
                    color = 'style="color: '+colores[0].color+'"';
                }else if(valor.acción == 'Editar'){
                    icono = 'bi bi-pencil';
                    color = 'style="color: '+colores[6].color+'"';
                }else if(valor.acción == 'Eliminar'){
                    icono = 'bi bi-trash';
                    color = 'style="color: '+colores[4].color+'"';
                }else if(valor.acción == 'Descargar'){
                    icono = 'bi bi-cloud-arrow-down';

                    iconoDescription = '  <img src="../assets/img/icons8-microsoft-excel.svg" style="width:24px; height:24px">';
                    color = 'style="color: '+colores[2].color+'"';

                }
                html += '<div class="timeline-block mb-3">';
                html +=     '<span class="timeline-step">',
                html +=         '<i class="'+icono+'" '+color+'></i>',
                html +=     '</span>',
                html +=     '<div class="timeline-content">',
                html +=         '<h6 class="text-dark text-sm font-weight-bold mb-0">',
                html +=             valor.descripcion;
                html +=             iconoDescription;
                html +=         '</h6>',
                html +=         '<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">',
                html +=             valor.created_at;
                html +=         '</p>';
                html +=     '</div>';
                html +=  '</div>';
            });

            $(".timeline-one-side").append(html);

            desbloquearPantalla();
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