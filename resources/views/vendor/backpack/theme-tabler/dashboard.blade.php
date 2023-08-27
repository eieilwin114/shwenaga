@extends(backpack_view('blank'))

@php
    // if (backpack_theme_config('show_getting_started')) {
    //     $widgets['before_content'][] = [
    //         'type'        => 'view',
    //         'view'        => backpack_view('inc.getting_started'),
    //     ];
    // } else {
    //     $widgets['before_content'][] = [
    //         'type'        => 'jumbotron',
    //         'heading'     => trans('backpack::base.welcome'),
    //         'content'     => trans('backpack::base.use_sidebar'),
    //         'button_link' => backpack_url('logout'),
    //         'button_text' => trans('backpack::base.logout'),
    //     ];
    // }
@endphp

@section('content')
{{-- 
<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>




<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>






<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>






<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>







<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Custom jumbotron</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
</div>






<div class="container-fluid mb-5 pb-5">
    <div class="card card-body rounded-3">
        <h1 class="display-5 fw-bold">Documentation</h1>
        <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>


    <div class="row mt-5 pt-5">
      @for ($i = 0; $i < 4; $i++)
        <div class="col">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Web</h3>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                The current link item
                </a>
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
            </div>
          </div>
        </div>
      @endfor
    </div>

    
</div>
 --}}





@endsection
