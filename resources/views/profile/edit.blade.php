<x-layout>
    <div style="text-align: center; margin-bottom: 30px;">
        @if($user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                 alt="Profile Photo"
                 style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ccc;">
        @else
            <div style="width: 150px; height: 150px; border-radius: 50%; background-color: #ddd; display: inline-block; line-height: 150px; font-size: 14px; color: #555;">
                Nav profila bilde
            </div>
        @endif
    </div>

    <h1 style="text-align: center;">Mans profils</h1>

    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/profile" enctype="multipart/form-data" style="max-width: 500px; margin: 0 auto;">
        @csrf

        <p><strong>Vārds:</strong> {{ $user->first_name }}</p>
        <p><strong>Uzvārds:</strong> {{ $user->last_name }}</p>
        <p><strong>E-pasts:</strong> {{ $user->email }}</p>
        <p><strong>Dzimšanas diena:</strong> {{ $user->birth_date }}</p>

        <div style="margin: 20px 0;">
            <label>Augšupielādēt profila attēlu:</label><br>
            <input type="file" name="profile_photo">
        </div>

        <button type="submit">Saglabāt</button>
    </form>
</x-layout>
