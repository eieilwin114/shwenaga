

@extends('_layout.blank')

@section('content')


    <div class="page-wrapper">
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="card">


            <div class="p-5 m-4 bg-dark-subtle rounded-3">
              <div class="container-fluid py-5">
                <p class="fs-4 mb-0">
                  Performance Appraisal manager for dealers.
                </p>
                <h1 class="display-5 mt-0 fw-bold">
                  Appraisal
                </h1>
                <div 
                  class="btn btn-orange btn-lg px-3"
                  data-bs-toggle="modal" data-bs-target="#modalId">
                  Create Appraisal
                </div>
              </div>
            </div>


            <div class="card-body">
              <h3>
                Your Submitted Appraisals
              </h3>  
            </div>


            <div class="card-footer p-0">
              <div class="card-table table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Title</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @for ($i = 0; $i < 10; $i++)
                    <tr>
                      <td>{{date("d F, Y",mt_rand(1262055681,9262055681))}}</td>
                      <td class="text-muted">
                        UI Designer, Training
                      </td>
                      <td class="text-muted"><a href="#" class="text-reset">paweluna@howstuffworks.com</a></td>
                      <td class="text-muted">
                        User
                      </td>
                      <td>
                        <a href="#">Edit</a>
                      </td>
                    </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- End Page body -->
    </div>




<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body" style="min-height:550px;">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div id="carousel-default" class="carousel slide" data-bs-ride="false">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <h4>Choose Employee</h4>
              <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                @foreach (__('appraisal.questions') as $question)
                  <label class="form-selectgroup-item flex-fill">
                    <input type="radio" name="radio" value="1" class="form-selectgroup-input">
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                      <div class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </div>
                      <div class="form-selectgroup-label-content d-flex align-items-center">
                        <span class="avatar me-3">
                          <i class="icon ti ti-user"></i>
                        </span>
                        <div>
                          <div class="font-weight-medium">Mg Mg</div>
                          <div class="text-muted">UI Designer</div>
                        </div>
                      </div>
                    </div>
                  </label>
                @endforeach
              </div>
              <a class="mt-3 w-100 btn btn-primary" data-bs-target="#carousel-default" data-bs-slide="next">
                Next
              </a>
            </div>

            @foreach (__('appraisal.questions') as $question)  
              <div class="carousel-item">
                <button class="btn mb-4" type="button" data-bs-target="#carousel-default" data-bs-slide="prev">
                  <i class="ti ti-arrow-left"></i>
                  Back
                </button>
                <label for="customRange1" class="form-label">
                  {{$question}}
                </label>
                <output class="form-check-description">&nbsp;</output>                  
                <input 
                    type="range" class="form-range" id="customRange1" min="0" max="20"
                    oninput="this.previousElementSibling.value = this.value">
                <p>
                <a class="btn btn-primary w-100" data-bs-target="#carousel-default" data-bs-slide="next">
                  Next
                </a>
              </div>
            @endforeach


            <div class="carousel-item">
              <div class="h2 text-center mt-5">Are you sure?</div>
              <div class="text-center">If you proceed, you can't un-change data.</div>

              <div class="mt-3 d-flex">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-target="#carousel-default" data-bs-slide="prev">
                  <i class="ti ti-arrow-left"></i>
                  Back
                </button>
                <button type="button" class="btn btn-success flex-grow-1" data-bs-dismiss="modal">
                  Submit
                </button>
              </div>
            </div>
          </div>




        </div>


      </div>


    </div>
  </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
  const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

</script>









@endsection