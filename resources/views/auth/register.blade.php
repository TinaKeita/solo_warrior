<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Reģistrācija</title>
</head>
<body>
<x-navigation></x-navigation>

<h1>Reģistrēties</h1>

<form method="POST">
    @csrf

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <label>Vārds:</label>
    <input name="first_name" value="{{ old('first_name') }}" required><br><br>

    <label>Uzvārds:</label>
    <input name="last_name" value="{{ old('last_name') }}" required><br><br>

    <label>E-pasts:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Dzimšanas datums:</label>
    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required><br><br>

    <label>Loma:</label>
    <select name="role" required>
        <option value="">-- Izvēlies --</option>
        <option value="student" @selected(old('role') === 'student')>Skolēns</option>
        <option value="teacher" @selected(old('role') === 'teacher')>Skolotājs</option>
    </select><br><br>

    <label>Parole:</label>
    <input type="password" name="password" required><br><br>

    <label>Atkārtot paroli:</label>
    <input type="password" name="password_confirmation" required><br><br>

    <button>Reģistrēties</button>
</form>
</body>
</html>
