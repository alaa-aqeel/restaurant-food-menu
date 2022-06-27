<nav class="px-2 m-2 mx-8 sm:px-4 py-2.5 rounded bg-gray-800 shadow shadow-yellow-800 w-full">
   <div class="container flex flex-wrap items-center mx-auto gap-10">
        
        <div>
            <a href="#" class="self-center px-1 text-2xl text-white font-semibold whitespace-nowrap drop-shadow">
                CPanel
            </a>
        </div>
        
        <ul class="flex mt-0 text-smfont-medium">
            <li >
                <a href="{{ route('dashboard') }}" 
                    class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-100">
                    Dashboard
                </a>
            </li>
            <li >
                <a href="{{ route('users.index') }}" 
                    class="block py-2 px-4 text-sm text-gray-500 hover:text-gray-100 ">
                    Users
                </a>
            </li>
        </ul>

        <div class="flex-1"></div>

        <div class="flex gap-3 text-white items-center">
            <span ">
                {{ Auth::user()->name }}
            </span>
            <form action="{{route('auth.logout')}}" method="POST">
                @csrf
                <button type="submit" class="block bg-red-500 py-2 px-4 text-sm text-white rounded">
                    logout
                </button>
            </form>
        </div>

   </div>
</nav>