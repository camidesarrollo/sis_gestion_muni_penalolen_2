@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <!-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                <h5 class="font-weight-bolder mb-0">
                  2,300
                  <span class="text-success text-sm font-weight-bolder">+3%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                <h5 class="font-weight-bolder mb-0">
                  +3,462
                  <span class="text-danger text-sm font-weight-bolder">-2%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

@endsection
@push('dashboard')
  <script>

$(document).ready(function () {
    getMenu();

});

    function getMenu(){
        $.ajax({
            url: "{{ route('obtenerMenuHijo') }}",
            type: "get",
        })
            .done(function (resp) {
                let html = '';
                $.each(resp.data, function (i, item) {
                  console.log(item);
                    let url = "{{ url("") }}"  + item.path_edit;
                    html += '<div class="col-xl-3 col-sm-6 mb-xl-2 mb-4"><div class="card"><div class="card-body p-3"><div class="row"><div class="col-8"><div class="numbers"><p class="text-sm mb-0 text-capitalize font-weight-bold">'+item.menu_name+
                    '</p><h5 class="font-weight-bolder mb-0">'+item.name+'</h5> </div></div><div class="col-4 text-end"><a class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" href="'+url+'" ><i class="'+item.icon+' text-lg opacity-10" aria-hidden="true"></i></a></div></div></div></div></div>';
                });
                if(resp.data.length > 0){
                  $(".row").html(html);
                }else{
                  html+='<div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">';
                  html+=          '<span class="alert-text text-white">';
                           
                  html+=          'El usuario no contiene ningun menu asociado';
                           
                  html+=        '</span>';
                      
                  html+=          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">';
                  html+=              '<i class="fa fa-close" aria-hidden="true"></i>';
                  html+=          '</button>';
                  html+=      '</div>';

                  $(".row").html(html);
                }
               
            })
            .fail(function (obj) {
                console.log(obj);
                return false;
            });
    }

  </script>
@endpush

