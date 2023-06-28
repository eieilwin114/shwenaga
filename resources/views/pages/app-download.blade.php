@extends('_layout.blank')


@section('content')



<div class="container-fluid px-4 px-5 my-5 border-secondary border-1 border-bottom">
    <div class="col-xxl-10 mx-auto row flex-lg-row-reverse align-items-center gx-5">
      <div class="col-10 col-sm-8 col-lg-5 align-items-bottom">
        <img 
          src="/assets/img/app-install-mockup.png" 
          class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-7">
        <p class="text-muted">
          Get it on one click.
        </p>
        <h1 class="display-5 fw-light lh-1 text-orange">
          Myanmar Shwe Naga <br />
          Staff Application
        </h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-5">
          <button type="button" class="btn btn-orange btn-lg px-4 me-md-2">
            <i class="ti ti-download me-2"></i> 
            Download APK
          </button>
          <button type="button" class="btn btn-outline-red btn-lg px-4">
            Learn more
          </button>
        </div>
      </div>
    </div>
</div>



@php
$cols = [
  [
    'title'=>'Overview',
    'desc'=>'At a glance',
    'icon'=>'&#xed46;',
  ],
  [
    'title'=>'Get Started',
    'desc'=>'Get started with simple docs.',
    'icon'=>'&#xec45;',
  ],
  [
    'title'=>'Screenshots',
    'desc'=>'Screenshot gallaries.',
    'icon'=>'&#xfa4a;',
  ],
  [
    'title'=>'More',
    'desc'=>'Many more on <b>Docs</b>.',
    'icon'=>'&#xea99;',
  ]
]
@endphp

@include('_layout.partials.learn-more')




</div>

@endsection