@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'monthly-performance' => '/admin/monthlyperformance',
    'Update' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@php
  $from_date = session()->get(SR_FROMDATE_FILTER);
  $to_date = session()->get(SR_TODATE_FILTER);
@endphp

<style>
  div.dataTables_wrapper div.dataTables_filter input {
    margin-right: 4px;
  }
  #DataTables_Table_0_info {
    text-transform: uppercase;
    font-size: .625rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .04em;
    line-height: 1rem;
    color: #616876;
    padding-left: 7px;
  }

  .dataTables_wrapper .bottom {
    display: flex;
    justify-content: space-between;
    background: white;
    padding: 14px;
  }

  table.dataTable.custom-table{
    margin-bottom: 0px!important;
  }

  .dataTables_filter {
    margin-bottom: 16px;
  }

  .paginate_button.previous,
  .paginate_button.next {
    color: #c8d3e1;
  }

  .paginate_button.current{
    min-width: 1.75rem;
    border-radius: 4px;
    color: #fff;
    background-color: #206bc4;
    padding: 5px 12px;
    margin: 0 5px;
  }
  .text-right{
    text-align:right;
  }
</style>
@php
  $month = date('Y-m',strtotime($monthlyperformance->month));
@endphp

@section('header')
    <section class="page-header p-3">
      <div clas="col text-center">
        <h3 class="page-title text-capitalize pb-0 mb-2">
          မြန်မာ့ရွှေနဂါးစိုက်ပျိုးရေးကုမ္ပဏီမှ အရောင်းမြှင့်တင်ရေးဝန်ထမ်းများအပေါ် အရောင်းဆိုင်ရှင်ကြီး၏ အကဲဖြတ် သုံးသပ် အမှတ်ပေးသည့်မှတ်တမ်း
        </h3>
      </div>
    </section>
@endsection
@section('content')
@if($errors->has('month'))
      <div class="alert alert-danger">
          {{ $errors->first('month') }}
      </div>
  @endif

  @if ($errors->has('employee_id'))
      <div  class="alert alert-danger">
          {{ $errors->first('employee_id') }}
      </div>
  @endif

  @if ($errors->has('shop_id'))
      <div  class="alert alert-danger">
          {{ $errors->first('shop_id') }}
      </div>
  @endif
  {!! Form::model($monthlyperformance,['method' => 'PATCH','route' => ['monthlyperformance.update',$monthlyperformance->id]]) !!}
      <div class="row justify-content-center">
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">    
                <strong>လ ၊ ခုနှစ်</strong>
                {!! Form::month('month', $month, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>ဆိုင်အမည်</strong>
                {!! Form::select('shop_id', $shops, $monthlyperformance->shop_id,array('placeholder' => 'Choose Shop','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>ဝန်ထမ်းအမည်</strong>
                {!! Form::select('employee_id', $employees, $monthlyperformance->employee_id,array('placeholder' => 'Choose Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-md-10 col-lg-10">
          <table class="table table-bordered my-5">
            <tr>
                <th class="text-center">စဥ်</th>
                <th class="text-center">အရောင်းမြှင့်တင်ရေးဝန်ထမ်းအပေါ် သုံးသပ်ချက်များ</th>
                <th class="text-center">ရမှတ်</th>
            </tr>
            <tr>
                <td>၁</td>
                <td>အလုပ်တက်ရက်မှန်ကန်၍ အချိန်မှန်‌ရောက်ရှိခြင်း၊ ယူနီဖောင်းဝတ်ဆင်မှု သပ်သပ်ရပ်ရပ်ရှိကာ တစ်ကိုယ်ရည်သန့်ရှင်းမှုရှိပြီး လုပ်ငန်းအပေါ်စိတ်ပါဝင်စားတန်ဖိုးထားခြင်း <b>(၂၀ မှတ်)</b></td>
                <td>{!! Form::number('mark1', $monthlyperformance->mark1,array('placeholder' => '','class' => 'form-control text-right','id'=>'mark1','min'=>0,'max'=>20,'required')) !!}</td>
            </tr>
            <tr>
                <td>၂</td>
                <td>စကားပြောချိုသာပြေပြစ်၍ ဆိုင်သို့လာရောက်သည့် ဖောက်သည်များနှင့် ဝယ်ယူအသုံးပြုမည့်တောင်သူဦးကြီးများကို တန်ဖိုးထားဆက်ဆံပြီး ထုတ်ကုန်ပစ္စည်းများအကြောင်း သေချာစွာရှင်းပြပြောဆိုရောင်းချနိုင်ခြင်း <b>(၂၀ မှတ်)</b></td>
                <td>{!! Form::number('mark2', $monthlyperformance->mark2,array('placeholder' => '','class' => 'form-control text-right','id'=>'mark2','min'=>0,'max'=>20,'required')) !!}</td>
            </tr>
            <tr>
                <td>၃</td>
                <td>ပွင့်လင်းရိုးသားပြီး ပေးအပ်သောတာဝန်များကို လိုလိုလားလားဆောင်ရွက်လိုစိတ်ရှိ၍ ညွှန်ကြားချက်များကိုအချိန်နှင့်တပြေးညီဆောင်ရွက်နိုင်ပြီး၊ စည်းကမ်းလိုက်နာမှုအားကောင်းခြင်း <b>(၂၀ မှတ်)</b></td>
                <td>{!! Form::number('mark3', $monthlyperformance->mark3,array('placeholder' => '','class' => 'form-control text-right','id'=>'mark3','min'=>0,'max'=>20,'required')) !!}</td>
            </tr>
            <tr>
                <td>၄</td>
                <td>အမြင်မတော်သောကိစ္စများကို မခိုင်းစေရဘဲ ဆောင်ရွက်လိုစိတ်ရှိ၍၊ ဆိုင်ရှိပစ္စည်းများနှင့် ကုမ္ပဏီပိုင်ပစ္စည်းများကို အကျိုးရှိစွာအသုံးပြုပြီး လေလွင့်ဆုံးရှုံးမှုမရှိအောင်ထိန်းသိမ်းစောင့်ရှောက်နိုင်ခြင်း <b>(၂၀ မှတ်)</b></td>
                <td>{!! Form::number('mark4', $monthlyperformance->mark4,array('placeholder' => '','class' => 'form-control text-right','id'=>'mark4','min'=>0,'max'=>20,'required')) !!}</td>
            </tr>
            <tr>
                <td>၅</td>
                <td>ဦးဆောင်နိုင်မှု ကိုယ်ရည်ကိုယ်သွေးရှိခြင်း၊ လုပ်ငန်းနှင့်ပါတ်သတ်သော ဗဟုသုတအားကောင်း၍ ဖြစ်ပေါ်လာသည့်ကိစ္စများအပေါ်တွင် ထောင့်ပေါင်းစုံမှ ခြုံငုံသုံးသပ်နိုင်ပြီး မှန်ကန်စွာဆုံးဖြတ်နိုင်ခြင်း <b>(၂၀ မှတ်)</b></td>
                <td>{!! Form::number('mark5', $monthlyperformance->mark5,array('placeholder' => '','class' => 'form-control text-right','id'=>'mark5','min'=>0,'max'=>20,'required')) !!}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-right"><b>စုစုပေါင်းရမှတ်</b></td>
                <td>{!! Form::number('total_mark', $monthlyperformance->total_mark,array('placeholder' => '','class' => 'form-control text-right','id'=>'total_mark','required','readonly')) !!}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-right"><b>၁ မှတ်လျှင် ၂၀၀ ကျပ်နှုန်းဖြင့် မြှောက်၍ ရရှိသော စုစုပေါင်း ငွေပမာဏ</b></td>
                <td>{!! Form::number('total', $monthlyperformance->total,array('placeholder' => '','class' => 'form-control text-right','id'=>'total','required','readonly')) !!}</td>
            </tr>
        </table>
        <div class="col-xs-2 col-sm-2 col-md-2 d-flex gap-1">
            <button type="submit" class="btn btn-success">
              <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
              Save
            </button>  
            <a class="btn btn-secondary text-decoration-none" href="{{ route('monthlyperformance.index') }}">
              <span class="la la-ban"></span> &nbsp;
              Cancel
            </a>          
        </div>
        </div>
      </div>
  {!! Form::close() !!}
  
@endsection

@section('after_styles')
  @basset('https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css')
  @basset('https://cdn.datatables.net/fixedheader/3.3.1/css/fixedHeader.dataTables.min.css')
  @basset('https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css')
@endsection

@section('after_scripts')
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
      $(".dataTable").DataTable({
          lengthChange: false, // Disable "Show entries"
          searching: true,
          language: {
          search: '',
          searchPlaceholder: 'Search...'
          },
          pagingType: 'simple_numbers', // Choose from 'simple', 'simple_numbers', 'full', 'full_numbers'
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          dom: '<"top"if>rt<"bottom"lp><"clear">',
          lengthChange: true,
          initComplete: function () {
            var api = this.api();
            $('.entries-per-page').html('Entries per page: <input type="number" min="1" max="100" value="' + api.page.len() + '">');
            $('.entries-per-page input').on('change', function () {
              var val = $(this).val();
              api.page.len(val).draw();
            });
          },

      });
      $('.dataTables_filter input[type="search"]').addClass('form-control');
      // $(".date-formatter").flatpickr({
      //   dateFormat: "d-m-y"
      // });

      $('#mark1').focusout(function(){
        calculate_total();
      });

      $('#mark2').focusout(function (){
        calculate_total();
      });

      $('#mark3').focusout(function (){
        calculate_total();
      });

      $('#mark4').focusout(function (){
        calculate_total();
      });

      $('#mark5').focusout(function (){
        calculate_total();
      });

      function calculate_total(){
        var mark1 = $('#mark1').val();
        var mark2 = $('#mark2').val();
        var mark3 = $('#mark3').val();
        var mark4 = $('#mark4').val();
        var mark5 = $('#mark5').val();
        var mark_total = parseInt(mark1,10) + parseInt(mark2,10) + parseInt(mark3,10) + parseInt(mark4,10) + parseInt(mark5,10);
        var total = mark_total * 200;

        $('#total_mark').val(mark_total);
        $('#total').val(total);
      }
  </script>
@endsection
