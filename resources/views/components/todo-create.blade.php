<div>
    <form action="{{ route('todo.store') }}" method="POST">
        @csrf

        <p class="text-gray-700">
        <div class="mt-1 relative rounded-md shadow-sm">
            <input id="name"
                   name="name"
                   class="form-input block w-full pr-10 sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"
                   placeholder="Start my new app" value="{{ old('name') }}" aria-invalid="true"
                   aria-describedby="name-error"
                   autofocus>
            @error('name')
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            @enderror
        </div>
        @error('name')
        <p class="mt-2 text-sm text-red-600" id="name-error">{{ $message }}</p>
        @enderror
        <div class="mt-3 flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <button type="submit"
                      class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                Add
                </button>
            </span>
        </div>
    </form>
</div>
