<div class="container-fluid mb-4 pb-4">
  <div class="card card-body rounded-3 shadow">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h1 class="display-5">
          Workflow Manager
        </h1>    
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a 
            href="{{route('dashboards.workflow-manager')}}" 
            class="btn d-none d-sm-inline-block me-2" target="_blank">
            <i class="ti ti-external-link"></i>
            Open Workflow Manager
          </a>
        </div>
      </div>
    </div>
    <div class="row my-3">
      @for ($j = 0; $j < 4; $j++)
        <div class="col-3">
          <div class="card">
            <div class="card-header">
              Oeder Status {{mt_rand(10,30)}}
            </div>
            <div class="overflow-y-auto overflow-x-hidden" style="max-height: 220px">
              @include('orders.partials.list-group')
            </div>
          </div>
        </div>
      @endfor
    </div>
  </div>
</div>