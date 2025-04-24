<x-layout>
<x-slot:title>Pievienot priekšmetu</x-slot:title>
  <h1>Pievienot priekšmetu</h1>
  <form  method="POST" action="/subjects">
  @csrf
    <input type="text" name="subject_name" placeholder="Priekšmets"/>
    @error("subject_name")
        <p>{{ $message }}</p>
    @enderror

    <button>Saglabāt</button>
</form>
</x-layout>