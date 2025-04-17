<x-layout>
  <h1>Labot atzīmi</h1>

  <form method="POST" action="/grades/{{ $grade->id }}">
    @csrf
    @method('PUT')

    <label>Students:</label>
    <select name="user_id">
      @foreach($students as $student)
        <option value="{{ $student->id }}" {{ $student->id == $grade->student_id ? 'selected' : '' }}>
          {{ $student->first_name }} {{ $student->last_name }}
        </option>
      @endforeach
    </select>

    <label>Priekšmets:</label>
    <select name="subject_id">
      @foreach($subjects as $subject)
        <option value="{{ $subject->id }}" {{ $subject->id == $grade->subject_id ? 'selected' : '' }}>
          {{ $subject->subject_name }}
        </option>
      @endforeach
    </select>

    <label>Atzīme:</label>
    <input type="number" name="grade" value="{{ old('grade', $grade->grade) }}" min="1" max="10" />

    <button type="submit">Saglabāt</button>
  </form>
</x-layout>
