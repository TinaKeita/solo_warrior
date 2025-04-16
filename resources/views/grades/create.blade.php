<x-layout>
<x-slot:title>Izveidot atzīmi</x-slot:title>
  <h1>Izveidot atzīmi</h1>
  <form  method="POST" action="/grades">
  @csrf
    <input name="content" />
    @error("content")
        <p>{{ $message }}</p>
    @enderror
    <button>Saglabāt</button>
</form>
</x-layout>