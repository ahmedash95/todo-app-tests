<div class="mb-5 text-gray-600 flex justify-between px-5 pb-3 border-b border-gray-300">
    <div>
        {{ $todo->name }}
    </div>
    <div>
        <div class="flex">
            <form action="{{ route('todo.update',$todo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button class="ml-2">
                    <x-heroicon-o-reply class="w-4 h-4 text-yellow-500"/>
                </button>
            </form>
            <form action="{{ route('todo.destroy',$todo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="ml-2">
                    <x-heroicon-o-trash class="w-4 h-4 text-red-500"/>
                </button>
            </form>
        </div>
    </div>
</div>
