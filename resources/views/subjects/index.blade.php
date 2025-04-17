<x-layout>
    <h1>Visi priekšmeti</h1>
    <a href="/subjects/create"> Pievienot jaunu priekšmetu</a>

    @foreach ($subjects as $subject)
        <li><a href="/subjects/{{ $subject->id }}">{{ $subject->subject_name }}</a></li>
    @endforeach
</x-layout>