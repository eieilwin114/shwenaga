<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

Route::get('/', function () {
    $dd = TablerExtension::greet();    
    //dd($dd);
    return view('welcome');
});

Route::get('/testing/unit-testing', function () {
    return view('testing.unit-testing');
});
Route::view('auth/login/admin',      'auth.login.admin');
Route::view('auth/login/shop-owner', 'auth.login.shop-owner');


Route::view('get/staff-app',         'pages.app-download');
Route::view('docs',                  'docs.index');


Route::view('dashboards/daily-sales-report','dashboards.daily-sales-report')
    ->name('dashboards.daily-sales-report');

Route::view('dashboards/monthly-performance-report','dashboards.monthly-performance-report')
    ->name('dashboards.monthly-performance-report');

Route::view('dashboards/daily-attendances-report','dashboards.daily-attendances-report')
    ->name('dashboards.daily-attendances-report');

Route::view('dashboards/workflow-manager','dashboards.workflow-manager')
    ->name('dashboards.workflow-manager');

Route::view('dashboards/workflow','dashboards.workflow')
    ->name('dashboards.workflow');


// Screenshot

use Spatie\Browsershot\Browsershot;

Route::get('screenshot/test',        function(){
    echo "<style>html, body {background-color: #000;}* {color: green;}</style>";
    echo "Starting ... <br />";
    echo "################### <br />";

    // echo "Screenshot 1 creating ... <br />";
    // $base64Screenshot = Browsershot::url("https://www.google.com/")->base64Screenshot();
    // Storage::put('file.png', base64_decode($base64Screenshot));
    // echo "Screenshot 1 created. <br />";
    // echo "################### <br />";
    // sm: 576px,
    // md: 768px,
    // lg: 992px,
    // xl: 1200px,
    // xxl: 1400px
    //     
    //     ->windowSize(1920, 1080)
    // 

    echo "Screenshot 1 creating ... <br />";
    $base64Screenshot = Browsershot::
        url("http://shwenaga.myanmaronlinecreations.com/")
        ->windowSize(1920, 1080)
        ->fullPage()
        ->base64Screenshot();
    Storage::put('file-1.png', base64_decode($base64Screenshot));
    echo "Screenshot 1 created. <br />";
    echo "################### <br />";

    // echo "Screenshot 2 creating ... <br />";
    $base64Screenshot = Browsershot::
        url("http://shwenaga.myanmaronlinecreations.com/")
        ->windowSize(640, 480)
        ->fullPage()
        ->base64Screenshot();
    Storage::put('file-2.png', base64_decode($base64Screenshot));
    // echo "Screenshot 2 created. <br />";
    // echo "################### <br />";


    echo "Screenshot 3 creating ... <br />";
    $base64Screenshot = Browsershot::
        url("http://shwenaga.myanmaronlinecreations.com/")
        ->windowSize(480, 640)
        ->fullPage()
        ->base64Screenshot();
    Storage::put('file-3.png', base64_decode($base64Screenshot));
    echo "Screenshot 3 created. <br />";
    // echo "################### <br />";

    //Browsershot::url('https://example.com')
    //->post(['foo' => 'bar'])

    echo "Success.";
});


Route::put('/themes', function() {
    request()->validate([
        'theme' => 'required|in:dark,light,auto',
    ]);
    session(['theme' => request()->theme]);
    return back();
})->name('themes.update');
















Route::get('admin/attendances',function(){
    return view('attendances.index');
});






use MagicLink\Actions\LoginAction;
use MagicLink\MagicLink;
use MagicLink\Actions\ResponseAction;


Route::get('magic-login/',function(){
    $user = \App\Models\User::where('email','=',request()->email)->first();
    backpack_auth()->login($user);
    $action = new LoginAction($user);
    $action->response(redirect('/admin/dashboard'));
    $urlToDashBoard = MagicLink::create($action)->url;
    return Redirect::to($urlToDashBoard);
});