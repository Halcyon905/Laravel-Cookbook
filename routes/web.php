<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return "wrong one idiot";
});

Route::get('/userform', function () {
    return view('userform');
});

Route::post('/userform', function (Request $request) {
    $request->flash();

    $validation = Validator::make($request->all(), [
        'email' => 'required|email|different:username',
        'username' => 'required|min:6',
        'password' => 'required|same:password_confirm',
    ], [
        'username.required' => 'We really, really need a Username.',
    ]);

    if ($validation->fails()) {
        return Redirect::to('userform')->withErrors($validation)->withInput();
    }
    

    return Redirect('/userform/result');
})->middleware('honeypot');

Route::get('/userform/result', function () {
    return 'Your username is: ' . old('username')
    . '<br>Your favorite color is: '
    . old('color');
});

Route::get('/fileform', function () {
    return view('fileform');
});

Route::post('/fileform', function (Request $request) {
    $file = $request['myfile'];
    $ext = $file->guessExtension();

    $validation = Validator::make($request->all(), [
        'myfile' => 'required|mimes:doc,docx,pdf,txt|max:1000'
    ]);

    if ($validation->fails()) {
        return Redirect::to('/fileform')->withErrors($validation)->withInput();
    }

    if ($file->move(base_path('storage\app\public\file_upload'), 'newfilename.' . $ext)) {
        return 'Success';
    }
    else {
        return 'Error';
    }
});

Route::get('/imageform', function () {
    return view('imageform');
});

Route::post('/imageform', function (Request $request) {
    $request->flash();
    $file = $request['myimage'];

    $validation = Validator::make($request->all(), [
        'myimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
    ]);

    if ($validation->fails()) {
        return Redirect::to('/imageform')->withErrors($validation)->withInput();
    }
    $file->move('file_upload', $file->getClientOriginalName());

    if ($request['action'] == 'upload') {
        return Redirect::to('/imageform')->with('upload', 'file_upload/' . $file->getClientOriginalName());
    }
    elseif($request['action'] == 'crop') {
        return Redirect::to('/imageform/crop')->with('image', 'file_upload/' . $file->getClientOriginalName());;
    }
    else {
        return 'Something went wrong, sorry';
    }
});

Route::get('/imageform/crop', function () {
    return view('imagecrop');
});

Route::post('/imageform/crop', function (Request $request) {
    $quality = 90;
    $src = imagecreatefrompng($request['image']);
    $dest = imagecreatetruecolor($request['w'], $request['h']);

    imagecopyresampled($dest, $src, 0, 0, $request['x'],
                                          $request['y'], $request['w'], $request['h'],
                                          $request['w'], $request['h']);
    imagejpeg($dest, base_path('public\file_upload\test.jpg'), $quality);
    return "<img src='http://127.0.0.1:8000/file_upload/test.jpg'>";
});
?>