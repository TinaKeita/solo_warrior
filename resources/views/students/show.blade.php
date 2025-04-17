<x-layout>
  <x-slot:title>
    {{ $student->last_name }}
  </x-slot:title>
  <h1>{{ $student->first_name }} {{ $student->last_name }}</h1>

<div class="button-container">
  <button><a href="/students/{{ $student->id }}/edit" class="no-visited-link">Labot</a></button>
 

  <form method="POST" action="/students/{{ $student->id }}">
  @csrf
  @method("delete")
  <button>Dzēst</button>
  </form>
</div>
</x-layout>