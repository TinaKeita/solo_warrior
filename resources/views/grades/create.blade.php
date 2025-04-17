<x-layout>
  <h1>Pievienot atzīmi</h1>

  <form method="POST" action="/grades">
    @csrf

    <label>Students:</label>
    <select name="user_id">
      @foreach($students as $student)
        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
      @endforeach
    </select>

    <label>Priekšmets:</label>
    <select name="subject_id">
      @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
      @endforeach
    </select>

    <label>Atzīme (1–10):</label>
    <input type="number" name="grade" min="1" max="10" />

    <button type="submit">Saglabāt</button>
  </form>
</x-layout>
