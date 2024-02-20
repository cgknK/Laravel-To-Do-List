<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @auth
        @if(session()->has('welcome') && session()->get('welcome'))
            use Illuminate\Support\Facades\Auth;
            @php
                //use Illuminate\Support\Facades\Auth;
                $user = Auth::user();
            @endphp
            <div class="alert alert-success">
                Welcome, {{$user->name}}
            </div>
            @php
                session()->put('welcome', true);
            @endphp
        @endif
        @endauth --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{auth()->user()->name}}, {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

