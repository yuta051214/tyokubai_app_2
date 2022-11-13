<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">商品の編集</h2>

        {{-- エラーメッセージ --}}
        <x-validation-errors :errors="$errors" />

        {{-- フォーム --}}
        <form action="{{ route('crops.update', $crop) }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="name">
                    名前
                </label>
                <input type="text" name="name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="名前" value="{{ old('name', $crop->name) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="price">
                    値段
                </label>
                <input type="text" name="price"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="値段" value="{{ old('price', $crop->price) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="number">
                    個数
                </label>
                <input type="text" name="number"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="個数" value="{{ old('number', $crop->number) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    商品の画像
                </label>
                <img src="{{ $crop->image_url }}" alt="" class="mb-4 md:w-2/5 sm:auto">
                <input type="file" name="image" class="border-gray-300">
            </div>
            <input type="submit" value="更新"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
