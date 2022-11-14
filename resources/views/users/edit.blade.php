<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('直売所の編集') }}
        </h2>
    </x-slot>

    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 py-4 bg-white shadow-md">
        {{-- <h2 class="text-center text-lg font-bold pt-6 tracking-widest">直売所の編集</h2> --}}

        {{-- エラーメッセージ --}}
        <x-validation-errors :errors="$errors" />

        {{-- フォーム --}}
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="shop">
                    直売所
                </label>
                <input type="text" name="shop"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="直売所" value="{{ old('shop', $user->shop) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="name">
                    生産者
                </label>
                <input type="text" name="name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="生産者" value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="address">
                    所在地
                </label>
                <input type="text" name="address"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="所在地" value="{{ old('address', $user->address) }}">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="introduction">
                    説明
                </label>
                <input type="text" name="introduction"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="説明" value="{{ old('introduction', $user->introduction) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    商品の画像
                </label>
                <img src="{{ $user->image_url }}" alt="" class="mb-4 md:w-2/5 sm:auto">
                <input type="file" name="image" class="border-gray-300">
            </div>
            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
