<x-layout>
<h1>
    @if (auth()->user()->role === 'teacher')
        Visas atzīmes
    @else
        Manas atzīmes
    @endif
</h1>


    <form method="GET" action="/grades" id="gradesFilterForm" style="display: flex; align-items: center; gap: 10px;">
    @if (auth()->user()->role === 'teacher')
        <label style="display: flex; align-items: center; gap: 5px;">
            Meklēt studentu:
            <input type="text" name="student_name" value="{{ request('student_name') }}" placeholder="Vārds vai uzvārds">
            
            <!-- Sort Order Button -->
            <button type="button" id="sortToggleBtn" style="background: none; border: none; cursor: pointer;">
                <img id="sortIcon" src="{{ request('sort_order', 'asc') === 'asc' ? asset('icons/arrow-down.svg') : asset('icons/arrow-up.svg') }}"
                     alt="Kārtošanas virziens" width="16" height="16">
            </button>
        </label>

        <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'asc') }}">
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

<script>
    document.getElementById('sortToggleBtn')?.addEventListener('click', function () {
        const sortInput = document.getElementById('sort_order');
        const icon = document.getElementById('sortIcon');
        const form = document.getElementById('gradesFilterForm');

        // Toggle value
        sortInput.value = sortInput.value === 'asc' ? 'desc' : 'asc';

        // Toggle icon
        icon.src = sortInput.value === 'asc'
            ? "{{ asset('icons/arrow-down.svg') }}"
            : "{{ asset('icons/arrow-up.svg') }}";

        form.submit();
    });
</script>


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
