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
    
    public function store(Request $request) {
        $validated = $request->validate([
            "first_name" => ["required", "max:255"],
            "last_name" => ["required", "max:255"]
          ]);
        Student::create([
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"]
          ]);
        return redirect("/students/index");
    }
}
