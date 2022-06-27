@extends('layout.base')



@section("content") 

    <div class="bg-slate-50 h-28 flex items-center">
        @component('components.navbar')
        @endcomponent
    </div>

    <main class="container mx-auto px-4 py-4">
        @yield('app-content')
    </main>


@endsection