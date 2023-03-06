<x-baseForm {{ $attributes }}>
    @csrf
    
    <x-input 
        name="username"
        label="Username"
        placeholder="Enter username"
        value=""
    />

    <x-input 
        name="password"
        label="Password"
        type="password"
        placeholder="Enter password"
        value=""
    />

</x-baseForm>


