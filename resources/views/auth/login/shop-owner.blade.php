@extends('_layout.blank')


@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-lighter display-1 text-danger">
            Reseller Dashboard
        </h1>
        <p class="text-muted">
            Real-time order status 
            <i class="ti">&#xefb1;</i>
            Monitor your orders
            <i class="ti">&#xefb1;</i>
            Feedback listening
            <i class="ti">&#xefb1;</i>
            And much more ...
        <p>
          <a href="#login" class="btn btn-orange btn-lg px-5 my-2">
            Login
          </a>
        </p>
      </div>
    </div>
  </section>
@php
$cols = [
  [
    'title'=>'Shipping',
    'desc'=>'Real-time shipping status',
    'icon'=>'&#xed46;',
  ],
  [
    'title'=>'Products',
    'desc'=>'Over 500++ products',
    'icon'=>'&#xec45;',
  ],
  [
    'title'=>'Orders',
    'desc'=>'Monitor your orders',
    'icon'=>'&#xfa4a;',
  ],
  [
    'title'=>'Rate SRDs',
    'desc'=>'We value your feedback',
    'icon'=>'&#xea99;',
  ]
]
@endphp

<div class="container-fluid px-4 py-5 bg-body-secondary">
    <div class="col-12 text-center my-5">
        <h2 class="h1">
            Features
        </h2>
    </div>  
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 g-4 pt-5 pb-5">
        @foreach ($cols as $col)
          <div class="col">
            <a href="#" class="card card-body rounded-3">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 avatar avatar-lg me-3 rounded-3">
                    <i class="ti text-muted">{!!$col['icon']!!}</i> 
                </div>
                <div>
                    <h2 class="fw-bold mb-0 h2">
                      {{$col['title']}}
                    </h2>
                    <p class="mb-0 text-muted">
                      {!!$col['desc']!!}
                    </p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
    </div>
  </div>




  <div class="col-md-4 mx-auto py-5 my-5" id="login">

    <div class="card card-md rounded-3 my-5">
      <div class="card-body">
        <h2 class="h2 text-center mb-4">Login</h2>
        <form method="POST" action="/admin/login" autocomplete="off" novalidate="">
          @csrf
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
@endsection