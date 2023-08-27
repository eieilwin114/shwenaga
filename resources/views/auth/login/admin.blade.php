@extends('_layout.blank')


@section('content')



<div class="container-fluid p-5 bg-body-tertiary">
  <div class="row">
    <!-- .col-6 -->
    <div class="col-6 align-self-center">
      <p class="hero-description mt-4 mb-0 fw-light">
        Monitor Stuff Activities <i class="ti">&#xf698;</i>
        Real Sales Reports <i class="ti">&#xf698;</i>
        Get Feedback from Partners
      </p>
      <h1 class="display-1 pb-2 mb-0 fw-lighter">
        Admin Dashboard
      </h1>
      <h2 class="h3 pt-0 mt-0 fw-normal">
        Login and start using 
        <u class="fw-bolder">Admin Dashbaord</u>
      </h2>
      <div class="row py-3">
        <a href="#login" class="col btn btn-danger btn-lg me-3">
          Start now
        </button>
        <a href="#login"  class="col btn btn-outline-yellow btn-lg">
          Learn more ...
        </a>
      </div>
    </div>
    <!-- End .col-6 -->
    <!-- .col-6 -->
    <div class="col-6 d-flex">
      <div class="flex-shrink-0 align-self-center">
        <a href="#carousel-controls" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>                      
      </div>
      <div class="flex-fill align-self-center">
        <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img 
                class="d-block w-100 border border-1 rounded-3" alt="" 
                src="https://tabler.io/_next/image?url=%2Fimg%2Femails%2Fhero-5.png&w=1920&q=85">
            </div>
            <div class="carousel-item">
              <img 
              class="d-block w-100 border border-1 rounded-3" alt="" 
              src="https://tabler.io/_next/image?url=%2Fimg%2Femails%2Fhero-2.png&w=1920&q=85">
            </div>
          </div>
        </div>
      </div>
      <div class="flex-shrink-1 align-self-center">
        <a class="" href="#carousel-controls" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
    <!-- End .col-6 -->
  </div>
</div>





{{-- 

<div class="container-fluid bg-dark-subtle py-5" id="login">
  <div class="col-md-4 mx-auto py-5 my-5">
    <div class="card card-md rounded-3 my-5">
      <div class="card-body">
        <h2 class="h2 text-center mb-4">Login</h2>
        <form action="./" method="get" autocomplete="off" novalidate="">
          <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="email" class="form-control" placeholder="90000000" autocomplete="off">
          </div>
          <div class="mb-2">
            <label class="form-label">
              Password
            </label>
            <div class="input-group input-group-flat">
              <input type="password" class="form-control" placeholder="Your password" autocomplete="off">
            </div>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
              Submit
              <i class="ti ms-2">&#xea1f;</i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 --}}

<div class="container-fluid bg-dark-subtle py-5" id="login">
  <div class="col-md-4 mx-auto py-5 my-5">
    <div class="card card-md rounded-3 my-5">
      <div class="card-body">
        @include('vendor.backpack.theme-tabler.auth.login.inc.form')
      </div>
    </div>
  </div>
</div>

@endsection
