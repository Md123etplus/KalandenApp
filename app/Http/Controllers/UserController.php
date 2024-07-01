<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordForm;
use Exception;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\loginForm;
use App\Http\Requests\updateForm;
use App\Http\Requests\registerForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function register(User $user,registerForm $request)
    {
        $verif=$request;
        if($verif){
             User::create([
                'name'=>$request->nom .' '.$request->prenom,
                'email'=>$request->email,
                'password'=>$request->motdepasse,
             ]);
            return redirect('/login')->with('success','Inscription effectuee avec succes!!');
        }else{
            return redirect()->back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(loginForm $request)
    {
        $credentials['email']=$request->email;  
        $credentials['password']=$request->motdepasse;
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
            
        }else{
            return redirect()->back()->with('error','L\'adresse mail ou le mot de passe est incorrect');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard()
    {
        // $courses=Course::where('instructor_id',Auth::user()->id)->get();
        // $courseCount=$courses->count();
        $courses=Course::all();
        //dd($courses);
        if(Auth::user()->role=="student")
            return view('student.dashboard',compact('courses'));
        else if(Auth::user()->role=="instructor"){
            $courses = Course::where('instructor_id',Auth::user()->id)->withCount('students')->paginate(5);
            $courseCount = $courses->total();
            $studentCount = $courses->sum('students_count');
            return view('instructor.dashboard',[
                'courses'=>$courses,
                'courseCount'=>$courseCount,
                'studentCount'=>$studentCount,
            ]);
        }else 
            return "Adminnn";
        
    }

    /**
     * Display the specified resource.
     */
    public function showLoginForm()
    {
        
        if(Auth::check()){
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
        return view('user.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function changePassword(User $user,changePasswordForm $request)
    {
        if($request){
            $user->update([
                'password'=>Hash::make($request->nouveaumdp)
            ]);
            return redirect()->intended('home')->with('success', 'Mot de passe modifie avec success!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(User $user,updateForm $request)
    {
        try{
            if($request){
                $user->name=$request->nom .' '.$request->prenom;
                $user->email=$request->email;
                $user->save();
                return redirect()->intended('home')->with('success','Votre profil a bien ete mis a jour!');
            }else{
                return redirect()->back()->with('error','Une erreur est survenue, veuillez reessayer plus tard');
            }
        }catch(QueryException $e){
            //abort('403');
            return redirect()->intended('home')->with('error','Nous avons rencontre une erreur, veuillez reessayer avec une autre adresse email!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->intended('/');
    }
}
