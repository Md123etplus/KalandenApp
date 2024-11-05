<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('courses.show',[
            'courses'=>Course::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('instructor.courseCreate',compact('courses'));
    }
    public function inscription(Course $course,Request $request){

        dd($course);
        $enrollment=new Enrollment();
        $user=Auth::user();
        // $isEnrolled = $user->enrollments->where('course_id', $course->id)->exists();
        if ($user->enrollments->contains('course_id', $course->id)) {
            return redirect()->back()->with('error', 'Vous êtes déjà inscrit à ce cours.');
        }
        $enrollment->user_id=Auth::user()->id;
        $enrollment->course_id=$course->id;
        $enrollment->save();
        return redirect()->back()->with('success','Vous etes desormais inscrit au cours '. $course->title .'! Bon courage.');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable',
        ]);
        
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->instructor_id = Auth::user()->id;
        $course->save();

        if ($request->module_title) {
            
            foreach ($request->module_title as $key => $moduleTitle) {

                $module = new Module();
                $module->title = $moduleTitle;
                $module->description = $request->module_description[$key];
                $module->course_id = $course->id;
                $module->save();
                if (isset($request->lesson_title)) {
                    //dd(isset($request->lesson_title[$key]));
                    //dd($request->lesson_title[1]);
                    foreach ($request->lesson_title[1] as $lessonKey => $lessonTitle) {
                       //dd($lessonKey);
                       //dd($request->lesson_pdf[1][0]['filename']);
                        $lesson = new Lesson();
                        $lesson->title = $lessonTitle;
                        $lesson->module_id = $module->id;
                        if (isset($request->lesson_pdf[1][$lessonKey])) {
                            //dd($request->lesson_pdf);
                            $file=$request->lesson_pdf[1][0];
                            //dd($file->getClientOriginalName());
                        //    Log::info('File upload details', [
                        //         'originalName' => $file->getClientOriginalName(),
                        //         'size' => $file->getSize(),
                        //         'mimeType' => $file->getMimeType(),
                        //     ]);
                            $path = $file->store('lessons_pdfs', 'public');
                            
                            //dd($path);
                            $lesson->pdf = basename($path);
                        } else {
                            $lesson->content = $request->lesson_content[1][$lessonKey];
                        }
                        $lesson->save();
                    }
                }
            }
        }
        
        return redirect()->route('instructor.course.create')->with('success', 'Cours créé avec succès');
        
    }

    /**
     * Display the specified resource.
     */
    public function mesCours(User $user)
    {
        // $courses=User::all();
        return 'Hey';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function lectureCours(Course $course)
    {
        // dd($course);
        return view('courses.lecture',[
            'course'=>$course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Course $course)
    {
        $course->delete();
        return redirect()->route('instructor.course.create')->with('success', 'Cours Supprime avec succes');
    }
}
