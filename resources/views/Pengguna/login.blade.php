@extends('Pengguna.Partials.index')
@section('container')
<section id="hero" class="hero">
    <div class="container position-relative">
        <div class="row gy-5" data-aos="fade-in">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <div class="card mb-3 shadow-lg p-3 mb-5 bg-body rounded">

                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        <p class="text-center small">Enter your username & password to login</p>
                      </div>

                      @if($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>
                                {{ $item }}
                            </li>
                                
                            @endforeach
                        </ul>
                      </div>
                      @endif

                      <form class="row g-3 needs-validation" action=" " method="POST">
                        @csrf

                        <div class="col-12">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                        </div>
    
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="yourPassword" required>
                          <div class="invalid-feedback">Please enter your password!</div>
                        </div>
    
                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                        <div class="col-12">
                          <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                        </div>
                      </form>
    
                    </div>
                  </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <img src="assets/img/log.png" style="width: 80%" class="img-fluid ms-5 ps-5 mt-5" alt="" data-aos="zoom-in"
                    data-aos-delay="100">
            </div>
        </div>
    </div>
</section>
@endsection