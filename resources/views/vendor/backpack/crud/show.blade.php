@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <div class="container-fluid d-flex justify-content-between my-3">
        <section class="header-operation animated fadeIn d-flex mb-2 align-items-end d-print-none">            
            <p class="ms-2 ml-2 mb-0">{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}</p>
            @if ($crud->hasAccess('list'))
                <p class="ms-2 ml-2 mb-0">
                    <small><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
                </p>
            @endif
        </section>
        <a href="javascript: window.print();" class="btn float-end float-right"><i class="la la-print"></i></a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="{{ $crud->getShowContentClass() }}">

	{{-- Default box --}}
	<div class="">
	@if ($crud->model->translationEnabled())
		<div class="row">
			<div class="col-md-12 mb-2">
				{{-- Change translation button group --}}
				<div class="btn-group float-right">
				<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[request()->input('_locale')?request()->input('_locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?_locale={{ $key }}">{{ $locale }}</a>
					@endforeach
				</ul>
				</div>
			</div>
		</div>
	@endif
		@if($crud->tabsEnabled() && count($crud->getUniqueTabNames('columns')))
			@include('crud::inc.show_tabbed_table')
		@else
			<div class="card no-padding no-border mb-0">
				@include('crud::inc.show_table', ['columns' => $crud->columns()])
			</div>
		@endif
	</div>
	</div>
</div>
@endsection
