<div class="w-full">
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
        {{ $label }}
    </label>
    <input 
        type="{{ $type ?? 'text' }}" 
        name="{{ $name }}" 
        value="{{ $value ? $value : old($name)  }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " 
        placeholder="{{ $placeholder }}" 
        autocomplete="new-password"
    >
    @error($name) 
        <span class="text-red-500 px-2 text-sm">
            {{ $message }}
        </span>
    @enderror

</div>