<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.student.index');
    }

    public function create()
    {
        return view('admin.student.create');
    }
    public function store(Request $request)
    {
         $request->validate([
             'name' => 'required',
             'email' => 'required',
             'course' => 'required',
             'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         //$imageName = time().'.'.request()->avatar->getClientOriginalExtension();
         //request()->avatar->move(public_path('images'), $imageName);
        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/students/', $filename); //public/uploads/students

            //$student->avatar  = $filename; //save into database
        }

        $student = new Student();
         $student->name = $request->input('name');
         $student->email = $request->input('email');
         $student->course = $request->input('course');
         $student->avatar = $filename;

         $student->save();

         return redirect()->route('student.index')->with('success', 'Student Added Successfully');

    }
}
