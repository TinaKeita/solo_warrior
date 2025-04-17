<x-layout>
<x-slot:title>Labo studentu</x-slot:title>
    <h1>Labo studentu</h1>
    <form method="POST" action="/students/{{ $student->id }}">
    @csrf 
    @method('PUT')
        <label>
            Vārds: <br><br>
            <input type="text" name="first_name" value="{{ old("first_name", $student->first_name) }}" /> <br><br>
        </label>
        
        @error("first_name")
            <p>{{ $message }}</p>
        @enderror
        
        <label>
            Uzvārds: <br><br>
            <input type="text" name="last_name" value="{{ old("last_name", $student->last_name) }}" /> <br><br>
        </label>
        
        @error("last_name")
            <p>{{ $message }}</p>
        @enderror
        
        <button>Saglabāt</button>
</x-layout>