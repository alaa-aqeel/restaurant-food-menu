@extends('layout.base')



@section("content") 

<div class="flex flex-col w-full min-h-screen justify-center items-center ">
    <div class="w-80">
        <div  id="header" class="text-4xl font-semibold drop-shadow-lg font-mono bg-opacity-70 bg-yellow-400 p-6 rounded-lg text-white">
            Login Admin
        </div>
    
        <div >
            <div id="form" class="my-8 ">
                @error('login_error')
                    <div role="alert" class="py-2">
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p>
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                @enderror
                <x-forms.loginForm
                    method="POST"
                    action="{{ route('auth.login.post') }}"
                />
            </div>
        </div>
    </div>
</div>

@endsection 