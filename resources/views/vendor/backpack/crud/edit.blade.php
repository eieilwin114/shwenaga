@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.edit') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
	@if ($crud->hasAccess('list'))
		<p class="row p-3">
			<small><a href="{{ url($crud->route) }}" class="d-print-none font-sm"><i class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
		</p>
	@endif
	<section class="page-header p-3 pb-0">
		<div clas="col">
			<h3 class="page-title text-capitalize pb-0 mb-0">
				{!! $crud->getHeading() ?? $crud->entity_name_plural !!}
			</h3>
			<p class="page-pretitle" id="datatable_info_stack">
				{!! $crud->getSubheading() ?? trans('backpack::crud.edit').' '.$crud->entity_name !!}
			</p>
		</div>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="{{ $crud->getEditContentClass() }}">
		{{-- Default box --}}

		@include('crud::inc.grouped_errors')

		  <form method="post"
		  		action="{{ url($crud->route.'/'.$entry->getKey()) }}"
				@if ($crud->hasUploadFields('update', $entry->getKey()))
				enctype="multipart/form-data"
				@endif
		  		>
		  {!! csrf_field() !!}
		  {!! method_field('PUT') !!}

		  	@if ($crud->model->translationEnabled())
		    <div class="mb-2 text-right">
		    	{{-- Single button --}}
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[request()->input('_locale')?request()->input('_locale'):App::getLocale()] }} &nbsp; <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
					  	<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?_locale={{ $key }}">{{ $locale }}</a>
				  	@endforeach
				  </ul>
				</div>
		    </div>
		    @endif
		      {{-- load the view from the application if it exists, otherwise load the one in the package --}}
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
              @endif
              {{-- This makes sure that all field assets are loaded. --}}
            <div class="d-none" id="parentLoadedAssets">{{ json_encode(Basset::loaded()) }}</div>
            @include('crud::inc.form_save_buttons')
		  </form>
	</div>
</div>
@endsection

