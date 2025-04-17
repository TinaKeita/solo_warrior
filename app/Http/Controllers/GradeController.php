<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
{
    $grades = Grade::with(['student', 'subject'])
        ->when($request->student_name, function ($query, $studentName) {
            $query->whereHas('student', function ($q) use ($studentName) {
                $q->where('first_name', 'like', "%$studentName%")
                  ->orWhere('last_name', 'like', "%$studentName%");
            });
        })
        ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
        ->orderBy('grade', $request->input('sort', 'asc'))
        ->get();

    $allSubjects = Subject::orderBy('subject_name')->get();

    return view('grades.index', compact('grades', 'allSubjects'));
}


public function create()
{
    // Pareizi atlasām tikai tos User, kuri ir studenti
    $students = User::where('role', 'student')->orderBy('last_name')->get();
    $subjects = Subject::orderBy('subject_name')->get();

    return view('grades.create', compact('students', 'subjects'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // student_id attiecas uz users
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:1|max:10',
        ]);
    
        Grade::create($validated);
    
        return redirect('/grades');
    }
    
    public function edit(Grade $grade)
    {
        $students = User::where('role', 'student')->orderBy('last_name')->get();
        $subjects = Subject::orderBy('subject_name')->get();
    
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }
    

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:1|max:10',
        ]);
        

        $grade->update($validated);

        return redirect('/grades');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect('/grades');
    }
}


