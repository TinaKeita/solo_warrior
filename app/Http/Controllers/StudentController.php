<?php
namespace App\Http\Controllers;

use App\Models\User; // Ja students ir User modelis
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }
    
        $students = User::where('role', 'student')->orderBy('last_name')->get();
        return view('students.index', compact('students'));
    }

    public function show(User $student) // Šeit mēs izmantojam User modeli, jo studentu dati ir User modelī
    {
        return view("students.show", compact("student"));
    }

    public function destroy(User $student)
    {
        $student->delete(); // Dzēšam studentu
        return redirect("/students");
    }
}
