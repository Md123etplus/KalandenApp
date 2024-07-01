<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
//a mettre dans le middleware guest
Route::get('/register',function (){
    return view('user.register');
});
Route::middleware(['guest','throttle:3,1'])->group(function (){
    Route::post('/register',[UserController::class,'register'])->name('register');
    Route::get('/login',[UserController::class,'showLoginForm'])->name('login');
    Route::post('/login',[UserController::class,'login'])->name('login');
});
Route::middleware('auth')->group(function (){
    Route::get('/home',[userController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[userController::class,'logout'])->name('logout');
    Route::get('/editProfile',function(){
        return view('user.editProfile');
    })->name('editProfile');
    Route::put('/changePassword/{user}',[userController::class,'changePassword'])->name('password.change');
    Route::get('/changePassword',function(){
        return view('user.changePassword');
    })->name('changePassword');
    Route::put('profileUpdate/{user}',[userController::class,'updateProfile'])->name('profileUpdate');

    Route::middleware('\App\Http\Middleware\IsStudent::class')->group(function (){
        Route::resource('courses', CourseController::class);
        Route::get('/showPayement',function(){
            return view('payement.show');
        })->name('showPayement');// a effacer
        Route::get('/mesCours/{user}',[CourseController::class,'mesCours'])->name('mesCours');
        Route::post('/incription/{course}',[CourseController::class,'inscription'])->name('inscription');
        Route::post('/lectureCours/{course}',[CourseController::class,'lectureCours'])->name('lectureCours');
    });
    
    Route::middleware('\App\Http\Middleware\IsInstructor::class')->group(function (){
        Route::get('/instructor/course/create', [CourseController::class, 'create'])->name('instructor.course.create');
        Route::post('/instructor/course/store', [CourseController::class, 'store'])->name('instructor.course.store');
        Route::delete('/instructor/course/delete/{course}', [CourseController::class, 'delete'])->name('instructor.courses.delete');
        //Route::ressource('myCourses','CourseController::class');
    });
});
