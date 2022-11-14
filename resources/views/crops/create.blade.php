<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('商品の登録') }}
        </h2>
    </x-slot>

    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        {{-- エラーメッセージ --}}
        <x-validation-errors :errors="$errors" />

        {{-- フォーム --}}
        <form action="{{ route('crops.store') }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            {{-- 商品名：name --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="name">
                    商品名
                </label>
                <input type="text" name="name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="商品名" value="{{ old('name') }}">
            </div>

            {{-- 値段：price --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="price">
                    値段
                </label>
                <input type="text" name="price"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="値段" value="{{ old('price') }}">
            </div>

            {{-- 個数：number --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="number">
                    個数
                </label>
                <input type="text" name="number"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="個数" value="{{ old('number') }}">
            </div>

            {{-- 画像：image --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    商品の画像
                </label>
                <input type="file" name="image" class="border-gray-300">
            </div>
            
            {{-- 登録ボタン --}}
            <input type="submit" value="登録"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
