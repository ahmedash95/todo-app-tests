@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div
                    class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if(!auth()->user()->hasToken(\App\Social::PLATFORM_TWITTER))
            <div
                class="text-sm border border-t-8 rounded text-yellow-700 border-yellow-600 bg-yellow-100 px-3 py-4 mb-4"
                role="alert">
                <a href="{{ route('connect.twitter') }}" class="underline">Connect twitter</a> to publish your todos
            </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Add new todo
                </div>
                <div class="w-full p-6">
                    <x-todo-create/>
                </div>
            </div>
            <div class="mt-4 p-4 break-words bg-white border border-2 rounded shadow-md pt-8">
                @forelse($pending as $todo)
                    <x-todo-pending :todo="$todo"/>
                @empty
                    <p class="text-center text-gray-600 mb-4">You have no todos yet.</p>
                @endforelse
            </div>
            @if(count($done) > 0)
            <div class="mt-4 p-4 break-words bg-white border border-2 rounded shadow-md pt-8">
                @foreach($done as $todo)
                    <x-todo-done :todo="$todo"/>
                @endforeach
            </div>
            @endif

        </div>
    </div>
@endsection
