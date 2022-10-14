@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <a class="align-items-center d-flex m-0 navbar-brand text-wrap  flex-column">
                      <img src="../img/muni-sis.png" class="navbar-brand-img" alt="..." style="width: 100px;">
                      <span class="ms-3 font-weight-bold">Sistema de Gestion</span>
                  </a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            
                            @error('error')
                              {{ $message }}
                            @enderror

                            @error('email')
                              {{ $message }}
                            @enderror
                           
                            @error('password')
                              {{ $message }}
                            @enderror
                          </span>
                      
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="" aria-label="Email" aria-describedby="email-addon">
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <!-- <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div> -->
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Iniciar sesión</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">¿Ha olvidado su contraseña? Restablece tu contraseña  
                  <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">aquí</a>
                </small>
                  <!-- <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
