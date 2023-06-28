<div class="table-responsive">
  <table class="table table-vcenter card-table">
    <tbody>
      @for ($i = 0; $i < 10; $i++)          
        <tr>
          <td class="w-1">
            @if (env('APP_DEBUG'))
              <span 
                class="avatar avatar-md" style="background-image: url(https://xsgames.co/randomusers/avatar.php?g=male&rand={{mt_rand(0,10000)}})">
              </span>
            @else
              <span class="avatar avatar-md"><i class="ti ti-user"></i></span>
            @endif
          </td>

          <td class="text-muted">
            <b>Paweł Kuna</b> <br>
            <div class="text-muted text-truncate">
              <i class="ti ti-calendar-pin me-1"></i>
              5, Sep, 2023
              <i class="ti ti-map-pin-plus ms-3 me-1"></i> 
              <a href="https://www.google.com/maps/search/?api=1&query=16.89257326342635, 96.06162611954413" target="_blank">
                11:30 PM
              </a>
              <i class="ti ti-map-pin-plus ms-3 me-1"></i> 
              <a href="https://www.google.com/maps/search/?api=1&query=16.89257326342635, 96.06162611954413" target="_blank">
                11:25 PM
              </a>
            </div>
          </td>
        </tr>
      @endfor


    </tbody>
  </table>
</div>