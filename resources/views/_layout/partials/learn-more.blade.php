<div class="container px-4 py-5">
    <div class="col-12">
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <div class="page-pretitle">
              Learn more
            </div>
            <h2 class="page-title">
              Documentation
            </h2>
          </div>
        </div>
      </div>
    </div>  
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
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