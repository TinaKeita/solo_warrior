<x-layout>
    <h1>Visi studenti</h1>
    <a href="/students/create">➕ Pievienot jaunu studentu</a>

    @foreach ($students as $student)
        <li><a href="/students/{{ $student->id }}">{{ $student->first_name }}{{ $student->last_name }}</a></li>
    @endforeach
</x-layout>