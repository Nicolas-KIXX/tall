<div class="flex flex-col bg-pink-200 w-screen h-screen"
    x-data="{
        showSubscribe: @entangle('showSubscribe'),
        showSuccess: @entangle('showSuccess')
     }">
    {{-- Navigation --}}
    <nav class="flex container justify-between w-full p-5 mx-auto text-slate-700">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
        <div class="">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    {{-- Text --}}
    <div class="flex items-center container mx-auto h-full">
        <div class="w-4/12">
            <h2 class="text-6xl font-bold uppercase">Subscribe me to the list</h2>
            <p class="mt-4">This is just a test for the <b>TALL</b> stack. Do you wish to subscribe to the newsletter?</p>
            {{-- Open modal button --}}
            <x-primary-button class="mt-12 py-3 px-6 rounded-none"
                x-on:click="showSubscribe = true">
                Sign me up!
            </x-primary-button>
        </div>
    </div>

    {{-- Modal ( subscribe )--}}
    <x-modal-center trigger="showSubscribe">
        <p class="text-3xl font-bold w-full mb-4">Let's do it.</p>
        <form action="" class="flex flex-wrap items-center w-full"
            wire:submit.prevent="subscribe">
            <x-text-input
                class="w-full rounded-none px-6 py-2"
                id="email"
                type="email"
                name="email"
                placeholder="E-mail address"
                required 
                wire:model.defer="email"/>

            {{-- Errors --}}
            <div class="w-full">
                @if($errors->has('email'))
                    <span class="text-red-700">{{ $errors->first('email') }}</span>
                @else
                    <span class="text-green-700">We will send you a confirmation e-mail.</span>
                @endif
            </div>

            <x-primary-button class="mt-12 py-3 px-6 rounded-none">
                {{-- Animation spinner ( on loading ) --}}
                <span class="animate-spin"
                    wire:loading
                    wire:target="subscribe">
                    &#9696;
                </span>

                {{-- Show text in button ( on not loading ) --}}
                <span
                    wire:loading.remove
                    wire:target="subscribe">
                Get me in!</span>
            </x-primary-button>
        </form>
    </x-modal-center>

    {{-- Modal ( confirmation ) --}}
    <x-modal-center trigger="showSuccess">
        <p class="text-3xl text-center font-bold w-full mb-4">You did the thing!</p>
        <p class="animate-pulse text-center text-9xl font-bold w-full">&check;</p>
        @if( request()->has('verified') && request()->verified == 1 )
            <p class="text-center text-lg font-bold w-full mb-4">Your account is now verified and ready for use.</p>
        @else
            <p class="text-center text-lg font-bold w-full mb-4">Go ahead and check your inbox for our mail.</p>
        @endif
    </x-modal-center>
</div>
