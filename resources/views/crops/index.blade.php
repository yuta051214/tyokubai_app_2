<x-app-layout>
    <x-validation-errors :errors="$errors" />
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($crops as $crop)
                <article class="w-full px-4 md:w-1/4 text-xl text-gray-800 leading-normal">
                    {{-- カード --}}
                    <a href="{{ route('crops.edit', $crop) }}">
                        <img src="{{ Storage::url('images/crops/' . $crop->image) }}" alt="" class="mb-4">
                        <h2 class="font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">{{ $crop->name }}</h2>
                        <h3>生産地：{{ $crop->user->shop }}</h3>
                        <h3>生産者：{{ $crop->user->name }}</h3>
                        <h3>値 段：{{ $crop->price }} 円</h3>
                        <h3>入荷数：{{ $crop->number }} 個</h3>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            <span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $crop->created_at ? 'NEW' : '' }}</span>
                            {{ $crop->created_at }}
                        </p>
                    </a>

                    {{-- 編集・削除ボタン --}}
                    <div class="flex flex-row text-center my-4">
                        <a href="{{ route('crops.edit', $crop) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
                        <form action="{{ route('crops.destroy', $crop) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
