<div class="container-fluid mb-4 pb-4">
  <div class="card card-body rounded-3 shadow">

    <!-- start card-stamp -->
    <div class="card-body pt-5 mt-3 mb-1 bg-primary text-white rounded-top-3 text-white">
      <div class="card-stamp">
        <div class="card-stamp-icon bg-white text-primary">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
        </div>
      </div>
      <h1 class="display-5">
        Software Documentation
      </h1>
      <div class="markdown text-light">
        We're glad you're here to explore and understand our software system. 
        This comprehensive documentation will guide you through the various 
        components, functionalities, and usage instructions, ensuring 
        a smooth and efficient experience. Feel free to explore and reach out 
        if you need assistance. Enjoy!
      </div>
    </div>
    <!-- end card-stamp -->
  
    <!-- start card-body -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-3 pt-0 mt-0 pb-3">
      <div class="col">
        <a href="#" class="card card-body rounded-2 p-2">
          <div class="d-flex align-items-center">
              <div class="flex-shrink-0 avatar avatar-lg me-3 rounded-3">
                <i class="ti text-muted"></i> 
              </div>
              <div>
                <p class="mb-0 text-muted">
                  Summary of a docs
                </p>
                <h2 class="mb-0 fs-2 fw-bold text-primary">
                  <i class="ti ti-link"></i>
                  Overview
                </h2>
              </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a href="#" class="card card-body rounded-2 p-2">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 avatar avatar-lg me-3 rounded-3">
                  <i class="ti text-muted"></i> 
                </div>
                <div>
                  <p class="mb-0 text-muted">
                    Start using the system
                  </p>
                  <h2 class="mb-0 fs-2 fw-bold text-primary">
                    <i class="ti ti-link"></i>
                    Get Started
                  </h2>
                </div>
            </div>
          </a>
      </div>
      <div class="col">
        <a href="#" class="card card-body rounded-2 p-2">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 avatar avatar-lg me-3 rounded-3">
                  <i class="ti text-muted ti-files"></i> 
                </div>
                <div>
                  <p class="mb-0 text-muted">
                    Full detail on documentation.
                  </p>
                  <h2 class="mb-0 fs-2 fw-bold text-primary">
                    <i class="ti ti-link"></i>
                    See more
                  </h2>
                </div>
            </div>
          </a>
      </div>
    </div>
    <!-- end card-body -->

    <!-- start card-body -->
    <div class="pb-2">
      <div class="row">
        @for ($i = 0; $i < 4; $i++)
          <div class="col">
            @include('docs.partials.card-list')
          </div>
        @endfor
      </div>
    </div>
    <!-- end card-body -->

  </div>
</div>