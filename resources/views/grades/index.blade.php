<x-layout>
    <h1>Visas atzīmes</h1>

    <form method="GET" action="/grades">
        <label>
            Meklēt studentu:
            <input type="text" name="student_name" value="{{ request('student_name') }}" placeholder="Vārds vai uzvārds">
        </label>

        <label>
            Priekšmets:
            <select name="subject_id">
                <option value="">-- Visi priekšmeti --</option>
                @foreach ($allSubjects as $subject)
                    <option value="{{ $subject->id }}" @if(request('subject_id') == $subject->id) selected @endif>
                        {{ $subject->subject_name }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            Kārtošana:
            <select name="sort">
                <option value="asc" @if(request('sort') == 'asc') selected @endif>Atzīme augošā</option>
                <option value="desc" @if(request('sort') == 'desc') selected @endif>Atzīme dilstošā</option>
            </select>
        </label>

        <button type="submit">Meklēt</button>
    </form>

    <a href="/grades/create">Pievienot jaunu atzīmi</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Students</th>
                <th>Priekšmets</th>
                <th>Atzīme</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
        @foreach($grades as $grade)
            <tr>
                @if ($grade->student)  <!-- Pārbaudām, vai ir saistīts students -->
                    <td>{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
                @else
                    <td><em>Nezināms students</em></td>  <!-- Ja students nav saistīts -->
                @endif
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->grade }}</td>
                <td>
                    <a href="/grades/{{ $grade->id }}/edit">Labot</a>
                    <form method="POST" action="/grades/{{ $grade->id }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Dzēst</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
