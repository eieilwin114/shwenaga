<div class="table-responsive">
  <table class="table table-vcenter card-table">
    <thead>
      <tr>
        <th>#</th>
        <th class="w-1"></th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < 10; $i++)          
        <tr>
          <td>
            Paweł Kuna
            <span class="text-muted">
                UI Designer, Training
            </span>
          </td>
          <td>
            <a class="btn btn-sm px-2 py-1 btn-outline-primary dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              Actions
            </a>
            <div class="dropdown-menu dropdown-menu-left">
              <div class="nav-item dropdown">
                <a href="#" class="dropdown-item">
                  <i class="la la-eye me-2 text-primary"></i> Preview
                </a>
                <a href="#" class="dropdown-item">
                  <i class="la la-edit me-2 text-primary"></i> Edit
                </a>
                <a href="#" class="dropdown-item">
                  <i class="la la-trash me-2 text-primary"></i> Delete
                </a>
              </div>
            </div>
          </td>
        </tr>
      @endfor


    </tbody>
  </table>
</div>