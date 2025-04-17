<x-layout>
  <x-slot:title>
    {{ $subject->subject_name }}
  </x-slot:title>
  <h1>{{ $subject->subject_name }}</h1>

<div class="button-container">
  <button><a href="/subjects/{{ $subject->id }}/edit" class="no-visited-link">Labot</a></button>
 

  <form method="POST" action="/subjects/{{ $subject->id }}">
  @csrf
  @method("delete")
  <button>Dzēst</button>
  </form>
</div>
</x-layout>