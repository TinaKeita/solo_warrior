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
    $user = auth()->user();

    $query = Grade::with(['student', 'subject']);

    // If student, only show their own grades
    if ($user->role === 'student') {
        $query->where('user_id', $user->id);
    } else {
        // Teacher: can search by student name
        if ($request->student_name) {
            $search = $request->student_name;
            $query->whereHas('student', function ($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }
        
    }

    // Subject filter
    if ($request->subject_id) {
        $query->where('subject_id', $request->subject_id);
    }

    //sort
    $grades = $query->orderBy(User::select('last_name')
        ->whereColumn('users.id', 'grades.user_id')
        , $request->input('sort', 'asc'))
        ->get();


$allSubjects = \App\Models\Subject::orderBy('subject_name')->get();

return view('grades.index', compact('grades', 'allSubjects'));

}



public function create()
{
    if (auth()->user()->role !== 'teacher') {
        abort(403);
    }
    
    // Pareizi atlasām tikai tos User, kuri ir studenti
    $students = User::where('role', 'student')->orderBy('last_name')->get();
    $subjects = Subject::orderBy('subject_name')->get();

    return view('grades.create', compact('students', 'subjects'));
}


    public function store(Request $request)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }
        
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
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }
        
        $students = User::where('role', 'student')->orderBy('last_name')->get();
        $subjects = Subject::orderBy('subject_name')->get();
    
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }
    

    public function update(Request $request, Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }
        
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
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }
        
        $grade->delete();
        return redirect('/grades');
    }
}


