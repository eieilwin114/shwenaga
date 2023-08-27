  <div class="list-group list-group-flush">
    <div class="list-group-header sticky-top">A</div>
    @for ($i = 0; $i < mt_rand(50,100); $i++)
      <div class="list-group-item p-2">
        <div class="row">
          <div class="col-auto">
            <a href="#" class="avatar">
              <i class="ti ti-file"></i> 
            </a>
          </div>
          <div class="col text-truncate">
            <a href="#" class="text-body d-block">
              {{fake()->name()}}
            </a>
            <div class="text-muted text-truncate mt-n1">
              {{fake()->name()}}
            </div>
          </div>
        </div>
      </div>
    @endfor
  </div>