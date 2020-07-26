<div class="px-4 py-2">
    <label for="{{ $name }}" class="block text-sm leading-5 font-medium text-gray-500">
        {{ $slot }}
    </label>
    <div class="mt-1 relative rounded-md shadow-sm">

        <input id="{{ $name }}" name="{{ $name }}" 
            type="{{ $type }}" 
            @if($title ?? null) title="{{ $title }}" @endif
            @if($maxlength ?? null) maxlength="{{ $maxlength }}" @endif 
            @if($pattern ?? null) pattern="{{ $pattern }}" @endif 
            @if($value ?? null) value="{{ old($name, $value) }}" @else value="{{ old($name) }}" @endif
            @if($disabled ?? null) disabled @endif
            @if($step ?? null) step="{{ $step }}" @endif
            @if($min ?? null) min="{{ $min }}" @endif
            @if($max ?? null) max="{{ $max }}" @endif
                
            @if($errors->has($name))
                {{ $attributes->merge(['class' => 'form-input block w-full pr-12 sm:text-sm sm:leading-5 border-red-500']) }}
            @else
                {{ $attributes->merge(['class' => 'form-input block w-full pr-12 sm:text-sm sm:leading-5']) }}
            @endif
        />

        @error($name)
        <small role="alert" class="text-red-500 text-xs">{{ $message }}</small>
        @enderror

    </div>
</div>