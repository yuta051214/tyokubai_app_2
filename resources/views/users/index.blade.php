<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-table-cells-large"></i>{{ __(' 直売所の一覧') }}
        </h2>
    </x-slot>

    <x-validation-errors :errors="$errors" />
    @if (session('notice'))
        <div class="bg-blue-100 border-blue-500 text-blue-700 border-l-4 p-4 my-2">
            {{ session('notice') }}
        </div>
    @endif

    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($users as $user)
                <article class="w-full p-2 md:w-1/2 text-xl text-gray-800 leading-normal border-blue-500">
                    <div class="bg-blue-100 rounded-xl p-4  shadow-lg">
                        {{-- カード --}}
                        <a href="{{ route('crops.index', $user) }}">
                            <img src="{{ Storage::url('images/users/' . $user->image) }}" alt="" class="mb-4">
                            <h2 class="font-sans break-normal text-gray-900 pt-6 pb-1 text-2xl md:text-2xl">生産地：{{ $user->shop }}</h2>
                            <h3>生産者：{{ $user->name }}</h3>
                            <h3>所在地：{{ $user->address }}</h3>
                            <h3>説明：{{ $user->introduction }}</h3>

                            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                                <span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $user->created_at ? 'NEW' : '' }}</span>
                                {{ $user->created_at }}
                            </p>
                        </a>
                        {{-- 編集・削除ボタン --}}
                        <div class="flex flex-row text-center my-4">
                            {{-- うまく動かなかったのでif文で応急処置 --}}
                            @auth
                                @if ($user->id == Auth::user()->id)
                                    <a href="{{ route('users.edit', $user) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
                                @endif
                            @endauth
                            {{-- @can('update', $user)
                                <a href="{{ route('users.edit', $user) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
                            @endcan --}}
                            {{-- @can('delete', $user)
                                <form action="{{ route('users.destroy', $user) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                                </form>
                            @endcan --}}
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
