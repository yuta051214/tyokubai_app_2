<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-store text-green-700"></i>{{ __('直売所の詳細') }}
        </h2>
    </x-slot>

    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        <article class="mb-2">
            {{-- 生産地 --}}
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">{{ $user->shop }}</h2>

            {{-- 生産者 --}}
            <h3>{{ $user->name }}</h3>

            {{-- 所在地 --}}
            <h3>{{ $user->address }}</h3>

            {{-- 画像 --}}
            <img src="{{ Storage::url('images/users/' . $user->image) }}" alt="" class="mb-4">

            {{-- 説明 --}}
            <p class="text-gray-700 text-base">{!! nl2br(e($user->introduction)) !!}</p>
        </article>
        <div class="flex flex-row text-center my-4">
            <a href="{{ route('users.edit', Auth::user()->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
        </div>
    </div>
</x-app-layout>
