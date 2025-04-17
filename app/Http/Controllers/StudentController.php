<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view("students.index", compact("students"));
    }

    public function create(Student $student) {
        return view("students.create", compact("student"));
    }

    public function show(Student $student) {
        return view("students.show", compact("student"));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "first_name" => ["required", "max:255"],
            "last_name" => ["required", "max:255"]
          ]);
        Student::create([
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"]
          ]);
        return redirect("/students");
    }

        
    public function edit(Student $student) {
        $students = Student::all();
        return view("students.edit", compact("student"));
    }

    public function update(Request $request, Student $student) {
        $validated = $request->validate([
            "first_name" => ["required", "max:255"],
            "last_name" => ["required", "max:255"]
          ]);
        $student->first_name = $validated["first_name"];
        $student->last_name = $validated["last_name"];
        $student->save();
        return redirect("/students");
    }

    public function destroy(Student $student) {
        $student->delete();
        return redirect("/students");
    }
}
