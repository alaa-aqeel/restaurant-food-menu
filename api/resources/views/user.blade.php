@extends('layout.app')



@section("app-content") 

<x-breadcrumb
    :items='[
        [
            "name" => "users",
            "path" => "#"
        ]
    ]'
/>

<div class="py-12 ">
    <div>
        <x-button 
            :href="route('users.create')"
            class="bg-blue-700 hover:bg-blue-800 focus:ring-blue-300  text-white"
        >
            Create 
        </x-button>
    </div>
    
   <div class="my-6 ">
        <div class="w-full rounded-lg ">
            <form class="flex flex-row gap-2 items-end w-full">
                <x-input 
                    name="search"
                    label="Search"
                    placeholder="Filter users by name, username, phon number"
                    value="{{ request()->get('search', '') }}"
                />
                <div>
                    <button 
                        type="submit"
                        class="bg-blue-700 hover:bg-blue-800 focus:ring-blue-300  text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                    >
                        filter
                    </button>
                </div>
            </form>
            <x-datatable 
                :rows="$users"
                :cols="$cols"
                action="users"
                id="user"
            />
        </div>
   </div>
</div>

@endsection 