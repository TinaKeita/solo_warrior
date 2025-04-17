<x-layout>
<x-slot:title>Labo priekšmetu</x-slot:title>
    <h1>Labot priekšmetu</h1>
    <form method="POST" action="/subjects/{{ $subject->id }}">
    @csrf 
    @method('PUT')
        <label>
            Priekšmets: <br><br>
            <input type="text" name="subject_name" value="{{ old("subject_name", $subject->subject_name) }}" /> <br><br>
        </label>
        
        @error("subject_name")
            <p>{{ $message }}</p>
        @enderror
        
        
        <button>Saglabāt</button>
</x-layout>