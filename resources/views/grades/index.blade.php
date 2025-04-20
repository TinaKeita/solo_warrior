<x-layout>
<h1>
    @if (auth()->user()->role === 'teacher')
        Visas atzīmes
    @else
        Manas atzīmes
    @endif
</h1>


    <form method="GET" action="/grades">
    @if (auth()->user()->role === 'teacher')
        <label>
            Meklēt studentu:
            <input type="text" name="student_name" value="{{ request('student_name') }}" placeholder="Vārds vai uzvārds">
        </label>
    @endif

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

        <button type="submit">Meklēt</button>
    </form>

    @if (auth()->user()->role === 'teacher')
    <a href="/grades/create">Pievienot jaunu atzīmi</a>
    @endif


    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Students</th>
                <th>Priekšmets</th>
                <th>Atzīme</th>
                @if (auth()->user()->role === 'teacher')
                    <th>Darbības</th>
                @endif
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
                @if (auth()->user()->role === 'teacher')
                <td>
                    <a href="/grades/{{ $grade->id }}/edit">Labot</a>
                    <form method="POST" action="/grades/{{ $grade->id }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                        <button type="submit">Dzēst</button>
                    </form>
                </td> 
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
