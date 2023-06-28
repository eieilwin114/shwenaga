<div class="container-fluid mb-4">
  <div class="card card-body rounded-3 shadow">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h1 class="display-5">
          Daily Sales Report
        </h1>    
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="#" class="btn btn-primary">
            <i class="ti ti-download me-2"></i>
            Download Sales Report
          </a>
          <a href="{{route('dashboards.daily-sales-report')}}" class="btn d-none d-sm-inline-block me-2" target="_blank">
            <i class="ti ti-external-link"></i>
            Open Daily Sales Report
          </a>
        </div>
      </div>
    </div>
    <div class="markdown">
      Provides a comprehensive overview of the sales transactions conducted within a specified day. 
      Empowering businesses to track and analyze Shwe Nagar daily sales performance efficiently. 
      The Daily Sales Report software module offers real-time visibility into daily sales activities, 
      facilitating effective decision-making and performance evaluation.
    </div>
    <div class="row mt-3 mb-2">
      <div class="col-md-12 col-lg-8">
        <div class="card">
          <div class="card-header py-2">
            Last 15 Days
          </div>              
          <div class="card overflow-hidden" style="max-height:220px;">
            @include('orders.partials.card-table')
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header py-2">
            Last 30 Days
          </div>
          <div class="card overflow-hidden" style="max-height:220px;">
            <div class="table-responsive">
              @include('orders.partials.card-table-small')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>