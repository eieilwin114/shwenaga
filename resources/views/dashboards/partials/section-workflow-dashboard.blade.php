
<div class="container-fluid mb-4 pb-4">
    <div class="card card-body rounded-3 shadow">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h1 class="display-5">
            Workflow Dashboard
          </h1>    
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            <a href="{{route('dashboards.workflow')}}" class="btn d-none d-sm-inline-block me-2" target="_blank">
              <i class="ti ti-external-link"></i>
              Open Work Flow Dashboard
            </a>
          </div>
        </div>
      </div>
      <div class="markdown">
        Myanma Shwe Naga Workflow Dashboard, provides an 
        overview and management interface for various sales order processes within organization. 
        It allow dashboard admin to monitor and control the entire sales workflow in real-time. 
      </div>
      <div class="row">
        <div class="col-12">
          @include('orders.partials.card-all-active')
        </div>
        <div class="col-3">
          @include('orders.partials.card-selected-orders')
        </div>
        <div class="col-3">
          @include('orders.partials.card-selected-orders')
        </div>
        <div class="col-3">
          @include('orders.partials.card-selected-orders')
        </div>
        <div class="col-3">
          @include('orders.partials.card-selected-orders')
        </div>
      </div>
    </div>
  </div>

