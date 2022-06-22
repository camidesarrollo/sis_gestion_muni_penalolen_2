  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
  <!--     Fonts and icons     -->
  <link href="../assets/css/fonts.googleapis/OpenSans.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="../assets/js/plugins/kit.fontawesome/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
 
  <link rel="stylesheet" type="text/css" href="../assets/css/toastr.css"  rel="stylesheet"/>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-icons-1.8.3/bootstrap-icons.css"  rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../assets/css/configToastr.css"  rel="stylesheet"/>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/js/plugins/multiple-select-1.5.2/dist/multiple-select.min.css">
  <!-- <link rel="stylesheet" href="../assets/js/core/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

  <style>
    .badge-verde{
      color: rgb(86, 202, 0);
      background-color: rgba(86, 202, 0, 0.12);
    }
    .badge-segundo{
      color: rgb(138, 141, 147);
      background-color: rgba(138, 141, 147, 0.12);
    }

    .badge-amarillo{
      color: rgb(255, 180, 0);
      background-color: rgba(255, 180, 0, 0.12);
    }

    .callout {
    padding: 0.8em 1em;
    line-height: 1.2;
    text-align: center;
    position: relative;
    clear: both;
    border-radius: 0 10px 10px 0;
}

.callout::before {
  width: 35px;
  height: 35px;
  display: inline-flex;
  justify-content: center;
  position: absolute;
  font-size: 1.5em;
  left: -1.2rem;
  content: "🙋🏾‍♀️";
  background-color: #b4aaff;
  border-radius: 50%;
  align-items: center;
  top: -0.8rem;
}

.callout {
  background: rgba(224, 226, 255, 0.5);
  border-left: 4px solid #b4aaff;
  color: #242424;
  margin: 1em;
}

.callout.warning::before {
  content: "⚠️";
  background-color: orangered;
  border-radius: 50%;
  align-items: center;
  top: -0.8rem;
}

.callout.success::before {
  content: "🎉";
  background-color: #3cc3c3;
  border-radius: 50%;
  align-items: center;
  top: -0.8rem;
}

.callout.warning {
  background-color: #ffe5d9;
  border-left: 4px solid orangered;
}

.callout.success {
  background-color: #edf3ed;
  border-left: 4px solid #3cc3c3;
}

.iconEditar:hover{
  color: #0d6efd !important;
}
.iconEliminar:hover{
  color: #dc3545 !important;
}
</style>
<style>
    .ms-choice {    
        border: none;
    }
    .ms-choice>span {
        top: 9px;
    }
</style>