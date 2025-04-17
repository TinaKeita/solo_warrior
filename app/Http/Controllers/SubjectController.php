<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view("subjects.index", compact("subjects"));
    }

    public function create(Subject $subject) {
        return view("subjects.create", compact("subject"));
    }

    public function show(Subject $subject) {
        return view("subjects.show", compact("subject"));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "subject_name" => ["required", "max:255"]
          ]);
          Subject::create([
            "subject_name" => $validated["subject_name"]
          ]);
        return redirect("/subjects");
    }

        
    public function edit(Subject $subject) {
        $subjects = Subject::all();
        return view("subjects.edit", compact("subject"));
    }

    public function update(Request $request, Subject $subject) {
        $validated = $request->validate([
            "subject_name" => ["required", "max:255"]
          ]);
        $subject->subject_name = $validated["subject_name"];
        $subject->save();
        return redirect("/subjects");
    }

    public function destroy(Subject $subject) {
        $subject->delete();
        return redirect("/subjects");
    }
}
