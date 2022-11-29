<div class="max-w-7xl mx-auto py-8 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <p class="pb-6 text-2xl font-bold uppercase text-gray-900">
        Subscribers
    </p>

    <div class="">
        <x-text-input
            type="text"
            class="rounded-none border border-gray-300 w-3/12 float-right mb-10"
            placeholder="Search"
            wire:model="search"></x-text-input>
        @if( $subscribers->isEmpty() )
            <div class="w-full py-6">
                <p class="text-red-700 text-center">No subscribers found</p>
            </div>
        @else
            <div class="w-full py-6">
                <table class="w-full">
                    <thead class="border-b border-gray-400">
                        <tr class="text-left">
                            <th class="py-2 text-lg">Verified</th>
                            <th class="py-2 text-lg">Email</th>
                            <th class="py-2 text-lg">Created at</th>
                            <th class="py-2 text-lg"></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach( $subscribers as $subscriber)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 text-sm">{{ optional($subscriber->email_verified_at)->diffForHumans() ?? '-' }}</td>
                                <td class="py-2 text-sm">{{ $subscriber->email }}</td>
                                <td class="py-2 text-sm">{{ $subscriber->created_at }}</td>
                                <td class="py-2 text-sm">
                                    <x-primary-button class="bg-red-700 hover:bg-red-900"
                                        wire:click="delete({{ $subscriber->id }})">
                                        Delete
                                    </x-primary-button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>