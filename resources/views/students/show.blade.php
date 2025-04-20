<x-layout>
    <x-slot:title>{{ $student->last_name }}</x-slot:title>

    <h1>{{ $student->first_name }} {{ $student->last_name }}</h1>
    <p>E-pasts: {{ $student->email }}</p>
    <p>Dzimšanas datums: {{ $student->birth_date }}</p>

    <div class="button-container">
    <form method="POST" action="/students/{{ $student->id }}" style="width: 50px; display: inline-block;">
        @csrf
        @method("delete")
        <button onclick="return confirm('Vai tiešām dzēst šo studentu?')">Dzēst</button>
    </form>
</div>

</x-layout>
