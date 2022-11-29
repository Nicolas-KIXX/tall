@props(['trigger'])

<div class="flex items-center w-full h-full fixed top-0 bg-gray-500 bg-opacity-60" {{ $attributes }}
    x-show="{{ $trigger }}"
    x-on:click.self="{{ $trigger }} = true"
    x-on:keydown.escape.window="{{ $trigger }} = false"
    x-cloak>
    <div {{ $attributes->merge(['class' => 'max-w-[600px] flex justify-center m-auto shadow-2xl py-16 px-20 bg-green-200']) }}>
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
</div>
