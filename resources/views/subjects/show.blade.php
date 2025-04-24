<x-layout>
  <x-slot:title>
    {{ $subject->subject_name }}
  </x-slot:title>

  <h1>{{ $subject->subject_name }}</h1>

  <div style="display: flex; gap: 10px; align-items: center; margin-top: 20px;">
    <!-- Edit Link -->
    <a href="/subjects/{{ $subject->id }}/edit" 
       class="no-visited-link" 
       style="padding: 8px 12px; text-decoration: none; border-radius: 4px; border-color: black; border-style: solid; border-width: 2px;">
      Labot
    </a>

    <!-- Delete Form -->
    <form method="POST" action="/subjects/{{ $subject->id }}" onsubmit="return confirm('Vai tiešām vēlies dzēst šo priekšmetu?')" style="margin: 0;">
      @csrf
      @method("delete")
      <button type="submit" 
              style="padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">
        Dzēst
      </button>
    </form>
  </div>
</x-layout>
