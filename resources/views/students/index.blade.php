<x-layout>
    <x-slot:title>Visi studenti</x-slot:title>

    <h1>Visi studenti</h1>

    <ul>
        @forelse ($students as $student)
            <li>
                <a href="{{ route('students.show', $student->id) }}">
                    {{ $student->last_name }} {{ $student->first_name }}
                </a>
            </li>
        @empty
            <li>Nav neviena studenta.</li>
        @endforelse
    </ul>
</x-layout>
