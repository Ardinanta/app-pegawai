@props([
    'action' => '',
    'placeholder' => 'Cari data...',
])

<form action="{{ $action }}" method="GET" class="mb-4">
    <div class="flex items-center">
        <input type="text" name="search" placeholder="{{ $placeholder }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            value="{{ request('search') }}">
        <button type="submit"
            class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            Cari
        </button>
    </div>
</form>
