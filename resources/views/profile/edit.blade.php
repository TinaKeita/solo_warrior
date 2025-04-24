<x-layout>
    <!-- Profilbilde un informācija -->
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

    <h2 style="text-align: center;">{{ $user->first_name }} {{ $user->last_name }}</h2>
    <p style="text-align: center;">E-pasts: {{ $user->email }}</p>
    <p style="text-align: center;">Dzimšanas datums: {{ $user->birth_date }}</p>

    <!-- Success message -->
    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <!-- Edit Button that opens modal -->
    <div style="text-align: center; margin: 20px 0;">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            Rediģēt profilu
        </button>
    </div>

    <!-- Dzēst pogu -->
    <div style="text-align: center;">
        <form method="POST" action="/profile" onsubmit="return confirm('Vai tiešām vēlies dzēst savu profilu?')" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Dzēst profilu</button>
        </form>
    </div>

    <!-- MODAL: Profile Edit Form -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/profile" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Rediģēt profilu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Aizvērt"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Vārds:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Uzvārds:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-pasts:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Dzimšanas datums:</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" 
                        value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}">

                    </div>

                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Jauns profila attēls:</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atcelt</button>
                    <button type="submit" class="btn btn-success">Saglabāt izmaiņas</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 CSS & JS (ja nav jau iekļauti) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#editProfileModal form');

        form.addEventListener('submit', function (e) {
            const firstName = form.querySelector('#first_name').value.trim();
            const lastName = form.querySelector('#last_name').value.trim();
            const email = form.querySelector('#email').value.trim();
            const birthDate = form.querySelector('#birth_date').value.trim();

            let errors = [];

            if (!firstName) errors.push('Vārds ir obligāts.');
            if (!lastName) errors.push('Uzvārds ir obligāts.');
            if (!email) errors.push('E-pasts ir obligāts.');
            if (!birthDate) errors.push('Dzimšanas datums ir obligāts.');

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    });
</script>

</x-layout>
