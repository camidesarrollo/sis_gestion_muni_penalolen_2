    <!--   Core JS Files   -->
<script type="text/javascript" language="javascript" src="..\assets\js\core\jquery-3.5.1.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../assets/js/core/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/fullcalendar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/plugins/toastr.min.js"></script>
<script src="../assets/js/configuraciones.js"></script>
<script src="../assets/js/colores.js"></script>
<script src="../assets/js/plugins/jquery.rut.chileno.min.js"></script>
<script src="../assets/js/plugins/jquery.rut.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="../assets/js/plugins/multiple-select-1.5.2/dist/multiple-select.min.js"></script>
<script src="../assets/js/plugins/bootstrap-autocomplete.min.js"></script>
<script src="../assets/js/plugins/jstree/3.2.1/jstree.min.js"></script>
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

<script>
function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date) {
  return [
    padTo2Digits(date.getDate()),
    padTo2Digits(date.getMonth() + 1),
    date.getFullYear(),
  ].join('-');
}

function menu(item, children){ 
  if(item.ariaExpanded == 'true'){
    item.ariaExpanded = false;
    var arrayChildren = children.split(" ");
    console.log(arrayChildren);
    for (var i = 0; i < arrayChildren.length; i++){
      if(arrayChildren[i] != ''){
        $("#" +arrayChildren[i]).addClass( "d-none");
        console.log($("#" +arrayChildren[i]));
      }
    }
  }else{
    item.ariaExpanded = true;
    var arrayChildren = children.split(" ");
    console.log(arrayChildren);
    for (var i = 0; i < arrayChildren.length; i++){
      if(arrayChildren[i] != ''){
        $("#" +arrayChildren[i]).addClass( "collapsing");
        $("#" +arrayChildren[i]).removeClass( "collapsing");
        $("#" +arrayChildren[i]).addClass( "collapse show");
         
        $("#" +arrayChildren[i]).removeClass( "d-none" )
        console.log($("#" +arrayChildren[i]));
      }
    }
  }
}


</script>

<script>
      
      function getDataUsuario(id_usuario) {
        let data = new Object();
        data.id_usuario = id_usuario;
        $.ajax({
            url: "{{ route('findUser') }}",
            type: "get",
            data: data,
        })
        .done(function (resp) {
            console.log(resp);
            let data = resp.data[0];
            $(".reportes_descargados").html('');
            $(".reportes_vistos").html('');
            $(".reportes_descargados").html(resp.dataHistoryDescaga);
            $(".reportes_vistos").html(resp.dataHistoryVer);
                $("#usuarioModalName").html(
                    data.nombre +
                        " " +
                        data.ap_paterno +
                        " " +
                        data.ap_materno
                );

                $("#detalleNombre").html(
                    data.nombre +
                        " " +
                        data.ap_paterno +
                        " " +
                        data.ap_materno
                );
                $("#detalleEmail").html(data.email);
                $("#detalleContacto").html(data.phone);

                $("#usuarioModalPerfil").html(data.rol_name);
                style = {
                    color: colores[data.rol_id - 1].color,
                    backgroundColor:
                        colores[data.rol_id - 1].backgroundcolor,
                };
                $("#usuarioModalPerfil").css(style);
                let html = "";

                if (data.leer === "1") {
                    html +=
                        '<span class="badge badge-success badge-verde" style="margin-right: 5px; color:' +
                        colores[0].color +
                        " ;background-color:" +
                        colores[0].backgroundcolor +
                        '">Leer</span>';
                }

                if (data.escribir === "1") {
                    html +=
                        '<span class="badge badge-success badge-verde" style="margin-right: 5px; color:' +
                        colores[1].color +
                        " ;background-color:" +
                        colores[1].backgroundcolor +
                        '">Escribir</span>';
                }

                if (data.eliminar === "1") {
                    html +=
                        '<span class="badge badge-success badge-verde" style="margin-right: 5px; color:' +
                        colores[2].color +
                        " ;background-color:" +
                        colores[2].backgroundcolor +
                        '">Eliminar</span>';
                }

                if (html == "") {
                    html =
                        '<span class="badge badge-success badge-verde" style="color:' +
                        colores[6].color +
                        " ;background-color:" +
                        colores[6].backgroundcolor +
                        '">Ninguno</span>';
                }

                let htmlRole =
                    '<span class="badge badge-success badge-verde" style="margin-right: 5px; color:' +
                    colores[data.rol_id - 1].color +
                    " ;background-color:" +
                    colores[data.rol_id - 1].backgroundcolor +
                    '">' +
                    data.rol_name +
                    "</span>";
                $("#detallePermisos").html(html);
                $("#detalleRol").html(htmlRole);
                let htmlEstado =
                    '<span class="badge badge-success badge-verde" style="margin-right: 5px; color:' +
                    colores[data.vigencia_id - 1].color +
                    " ;background-color:" +
                    colores[data.vigencia_id - 1].backgroundcolor +
                    '">' +
                    data.vige_name +
                    "</span>";
                $("#detalleEstado").html(htmlEstado);
                
                let datosUsuario =  resp.data[0];
                
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
                desbloquearPantalla();
        })
        .fail(function (obj) {
            console.log(obj);
            return false;
        });
    }
    //LLENAR TABLA CON LA INFORMACION DE LO QUE HA REALIZADO EL USUARIO
      function tablaHistory(id_usuario) {

        let data = new Object();
        data.id_usuario = id_usuario;

        $.ajax({
            url: "{{route('getHistory')}}",
            type: "get",
            data: data
        })
            .done(function (resp) {
                console.log(resp);
                let html = '';
                resp.data.forEach(function(row){
                  let icono = '';
                  let iconoDescription = '';
                  let color = '';

                  if(row.accion == 'Ver'){
                      icono = 'bi bi-eye';
                      color = 'style="color: '+colores[1].color+'"';
                  }else if (row.accion == 'Crear'){
                      icono = 'bi bi-plus-circle';
                      color = 'style="color: '+colores[0].color+'"';
                  }else if(row.accion == 'Editar'){
                      icono = 'bi bi-pencil';
                      color = 'style="color: '+colores[6].color+'"';
                  }else if(row.accion == 'Eliminar'){
                      icono = 'bi bi-trash';
                      color = 'style="color: '+colores[4].color+'"';
                  }else if(row.accion == 'Descargar'){
                      icono = 'bi bi-cloud-arrow-down';

                      iconoDescription = '  <img src="../assets/img/icons8-microsoft-excel.svg" style="width:24px; height:24px">';
                      color = 'style="color: '+colores[2].color+'"';

                  }else if (row.accion == 'Iniciar Sesión'){
                      icono = 'bi bi-person-workspace';
                      color = 'style="color: '+colores[3].color+'"';
                  }
 
                  html += '<div class="timeline-block mb-3">';
                  html +=     '<span class="timeline-step">',
                  html +=         '<i class="'+icono+'" '+color+'></i>',
                  html +=     '</span>',
                  html +=     '<div class="timeline-content">',
                  html +=         '<h6 class="text-dark text-sm font-weight-bold mb-0">',
                  html +=             row.descripcion;
                  html +=             iconoDescription;
                  html +=         '</h6>',
                  html +=         '<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">',
                  html +=             row.created_at;
                  html +=         '</p>';
                  html +=     '</div>';
                  html +=  '</div>';
                });
                $("#history").html(html);
            })

            .fail(function (obj) {
                console.log(obj);
                return false;
            });

        // let data = new Object();
        // data.id_usuario = id_usuario;
        // var dataTable_menu = $("#history").DataTable();
        // dataTable_menu.clear().destroy();
        // dataTable_menu = $("#history").DataTable({
        //     processing: true,
        //     serverSide: false,
        //     scrollX: true,
        //     ajax: {
        //         url: "{{route('getHistory')}}",
        //         data: data
        //     },
        //     language: {
        //         url: "{{ route('index') }}/assets/js/core/dataTables.spanish.json",
        //     },
        //     dom: "tpr",
        //     bLengthChange : "false",
        //     columnDefs: [
        //         {
        //             targets: 0,
        //             className: 'text-right'
        //         }
        //     ],
        //     createdCell: function (td, cellData, rowData, row, col) {
        //             $(td).css('text-align', 'left');
        //     },
        //     columns: [
        //         {
        //             data: "descripcion",
        //             name: "descripcion",
        //             className: "text-center",
        //             visible: true,
        //             orderable: true,
        //             searchable: true,
        //             render: function (data, type, row) {
        //                 let icono = '';
        //                 let iconoDescription = '';
        //                 let color = '';

        //                 if(row.accion == 'Ver'){
        //                     icono = 'bi bi-eye';
        //                     color = 'style="color: '+colores[1].color+'"';
        //                 }else if (row.accion == 'Crear'){
        //                     icono = 'bi bi-plus-circle';
        //                     color = 'style="color: '+colores[0].color+'"';
        //                 }else if(row.accion == 'Editar'){
        //                     icono = 'bi bi-pencil';
        //                     color = 'style="color: '+colores[6].color+'"';
        //                 }else if(row.accion == 'Eliminar'){
        //                     icono = 'bi bi-trash';
        //                     color = 'style="color: '+colores[4].color+'"';
        //                 }else if(row.accion == 'Descargar'){
        //                     icono = 'bi bi-cloud-arrow-down';

        //                     iconoDescription = '  <img src="../assets/img/icons8-microsoft-excel.svg" style="width:24px; height:24px">';
        //                     color = 'style="color: '+colores[2].color+'"';

        //                 }else if (row.accion == 'Iniciar Sesión'){
        //                     icono = 'bi bi-person-workspace';
        //                     color = 'style="color: '+colores[3].color+'"';
        //                 }
        //                 let html = '';
        //                 html += '<div class="timeline-block mb-3">';
        //                 html +=     '<span class="timeline-step">',
        //                 html +=         '<i class="'+icono+'" '+color+'></i>',
        //                 html +=     '</span>',
        //                 html +=     '<div class="timeline-content">',
        //                 html +=         '<h6 class="text-dark text-sm font-weight-bold mb-0">',
        //                 html +=             row.descripcion;
        //                 html +=             iconoDescription;
        //                 html +=         '</h6>',
        //                 html +=         '<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">',
        //                 html +=             row.created_at;
        //                 html +=         '</p>';
        //                 html +=     '</div>';
        //                 html +=  '</div>';
        //                 return html;
        //             }
        //         },
        //     ],
        //     drawCallback: function (settings) {
        //         // $(settings.nTHead).hide();
        //     },
        //     initComplete: function () {
        //     },
        // });
    }
</script>
