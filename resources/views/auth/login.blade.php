<form method="POST" action="/login" class="p-4">
    @csrf
    <input type="text" name="username" placeholder="Username" class="border p-2 block mb-2">
    <input type="password" name="password" placeholder="Password" class="border p-2 block mb-2">
    <button class="bg-blue-500 text-white px-4 py-2">Login</button>
</form>