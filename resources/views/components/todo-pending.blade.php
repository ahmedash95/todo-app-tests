<div class="mb-5 text-gray-600 flex justify-between px-5 pb-3 border-b border-gray-300">
    <div>
        {{ $todo->name }}
    </div>
    <div>
        <div class="flex">
            <form action="{{ route('todo.update',$todo->id) }}" method="POST" class="flex">
                @csrf
                @method('PUT')
                @if(auth()->user()->hasToken(\App\Social::PLATFORM_TWITTER))
                <div x-data="{ checked: false }">
                    <label @click="checked = !checked">
                        <svg viewBox="328 355 335 276"
                             :class="'w-4 h-4 cursor-pointer ' + (checked ? 'text-blue-400' : 'text-gray-400')"
                        >
                            <path
                                style="fill:currentColor"
                                d="M 630, 425 A 195, 195 0 0 1 331, 600 A 142, 142 0 0 0 428, 570 A  70,  70 0 0 1 370, 523 A  70,  70 0 0 0 401, 521 A  70,  70 0 0 1 344, 455 A  70,  70 0 0 0 372, 460 A  70,  70 0 0 1 354, 370 A 195, 195 0 0 0 495, 442 A  67,  67 0 0 1 611, 380 A 117, 117 0 0 0 654, 363 A  65,  65 0 0 1 623, 401 A 117, 117 0 0 0 662, 390 A  65,  65 0 0 1 630, 425 Z"
                            />
                        </svg>
                    </label>
                    <input type="checkbox" name="twitter" x-bind:checked="checked" class="hidden">
                </div>
                @endif
                <button class="ml-2">
                    <x-heroicon-o-check class="w-4 h-4 text-green-500"/>
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
