<x-layout>
    <div style="text-align: center; margin-bottom: 30px;">
        @if($student->profile_photo_path)
            <img src="{{ asset('storage/' . $student->profile_photo_path) }}"
                 alt="Profila bilde"
                 style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ccc;">
        @else
            <div style="width: 150px; height: 150px; border-radius: 50%; background-color: #ddd; display: inline-block; line-height: 150px; font-size: 14px; color: #555;">
                Nav profila bilde
            </div>
        @endif
    </div>

    <div style="max-width: 500px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); border: 1px solid #eaeaea;">
        <h1 style="text-align: center; margin-bottom: 20px;">{{ $student->first_name }} {{ $student->last_name }}</h1>

        <p><strong>E-pasts:</strong> {{ $student->email }}</p>
        <p><strong>Dzimšanas datums:</strong> {{ $student->birth_date }}</p>

        <div class="button-container" style="margin-top: 30px; text-align: right;">
            <form method="POST" action="/students/{{ $student->id }}" style="display: inline-block;">
                @csrf
                @method("delete")
                <button onclick="return confirm('Vai tiešām dzēst šo studentu?')">Dzēst</button>
            </form>
        </div>
    </div>
</x-layout>
