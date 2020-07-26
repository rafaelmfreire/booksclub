<div class="px-4 py-2">
    <label for="{{ $name }}" class="block text-sm leading-5 font-medium text-gray-500">
        {{ $slot }}
    </label>
    <div class="mt-1 relative rounded-md shadow-sm">

        <textarea rows="{{ $rows }}" id="{{ $name }}" name="{{ $name }}"
            class="form-textarea block w-full pr-12 sm:text-sm sm:leading-5 @error($name) border-red-500 @enderror">{{ old($name, $value) }}</textarea>

        @error($name)
        <small role="alert" class="text-red-500 text-xs">{{ $message }}</small>
        @enderror

    </div>
</div>