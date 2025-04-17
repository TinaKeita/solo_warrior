<x-layout>
<x-slot:title>Pievienot studentu</x-slot:title>
  <h1>Pievienot studnetu</h1>
  <form  method="POST" action="/students">
  @csrf
    <input name="first_name" placeholder="First name"/>
    @error("first_name")
        <p>{{ $message }}</p>
    @enderror

    <input name="last_name" placeholder="Last name"/>
    @error("last_name")
        <p>{{ $message }}</p>
    @enderror
    <button>Saglabāt</button>
</form>
</x-layout>