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

    <h1 style="text-align: center;">Rediģēt profilu</h1>

    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <!-- Edit Profile Form -->
    <form method="POST" action="/profile" enctype="multipart/form-data" style="max-width: 500px; margin: 0 auto;">
        @csrf

        <!-- First Name Field -->
        <div>
            <label for="first_name">Vārds:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" style="width: 100%; padding: 10px; margin: 5px 0;">
        </div>

        <!-- Last Name Field -->
        <div>
            <label for="last_name">Uzvārds:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" style="width: 100%; padding: 10px; margin: 5px 0;">
        </div>

        <!-- Email Field -->
        <div>
            <label for="email">E-pasts:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" style="width: 100%; padding: 10px; margin: 5px 0;">
        </div>

        <!-- Birth Date Field -->
        <div>
            <label for="birth_date">Dzimšanas datums:</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" style="width: 100%; padding: 10px; margin: 5px 0;">
        </div>

        <!-- Profile Image Upload -->
        <div style="margin: 20px 0;">
            <label for="profile_photo">Augšupielādēt jaunu profila attēlu:</label><br>
            <input type="file" id="profile_photo" name="profile_photo" style="width: 100%; padding: 10px;">
        </div>

        <!-- Submit Buttons (Save & Edit) -->
        <div style="display: flex; justify-content: center; gap: 10px;">
            <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px;">Saglabāt</button>
            <a href="/profile" style="text-decoration: none;">
                <button type="button" style="background-color:rgb(126, 152, 84); color: white; padding: 10px 15px; border: none; border-radius: 5px;">Atcelt</button>
            </a>
        </div>
    </form>

    <!-- DELETE Option -->
    <div style="text-align: center; margin-top: 30px;">
        <form method="POST" action="/profile" style="display: inline-block;" onsubmit="return confirm('Vai tiešām vēlies dzēst savu profilu?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background-color: #e74c3c; color: white; padding: 10px 15px; border: none; border-radius: 5px;">Dzēst profilu</button>
        </form>
    </div>
</x-layout>
