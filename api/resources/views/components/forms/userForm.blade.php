<x-baseForm {{ $attributes }}>
    {{ $slot }}
    <x-input 
        name="name"
        label="Fullname"
        placeholder="Enter fullname"
        :value="$values['name'] ?? ''"
    />

    <x-input 
        name="username"
        label="Username"
        placeholder="Enter username"
        :value="$values['username'] ?? ''"
    />

    <x-input 
        name="phone"
        label="Phone"
        placeholder="Enter phone number"
        :value="$values['phone']?? ''"
    />
    
    <x-input 
        name="expire_at"
        label="Expire At"
        type="date"
        placeholder="Select date account expire"
        :value="$values['expire_at'] ?? ''"
    />

    <x-input 
        name="password"
        label="Password"
        placeholder="Enter password"
        value=""
    />

    <div class="flex items-center my-4 px-2">
        <input 
            id="is_admin" 
            name="is_admin" 
            type="checkbox" 
            @if(isset($values['is_admin']) && $values['is_admin'])
            checked
            @endisset
            value="1" 
            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
        <label for="is_admin" class="ml-2 text-sm font-medium text-gray-900">Is Admin</label>
    </div>

</x-baseForm>

