<x-app-layout>
   <body>
        <h1>DrawOne!</h1>
        <div>
          <form action="{{ route('pictures.search') }}" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="検索">
          </form>
        </div>
        <div class='pictures'>
            @foreach ($pictures as $picture)
                <div class='picture'>
                    <a href = "/pictures/{{ $picture->id }}"><img src="{{ asset($picture->path) }}"</a>
                    <h2 class='title'>
                        <a href = "/pictures/{{ $picture->id }}">{{ $picture->title }}</a>
                    </h2>
                    <h2>作者</h2>
                    <a href="/users/{{ $picture->user->id }}">{{ $picture->user->name }}</a>
                    @if (Auth::user()->id == $picture->user_id)
                        <form action="/pictures/{{ $picture->id }}" id="form_{{ $picture->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePicture({{ $picture->id }})">削除</button> 
                        </form>
                    @endif
                    <div class = "likes">
                      @if($picture->is_liked_by_auth_user())
                        <a href="/pictures/unlike?id={{$picture->id}}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $picture->likes->count() }}</span></a>
                      @else
                        <a href="/pictures/like?id={{$picture->id}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $picture->likes->count() }}</span></a>
                      @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $pictures->links() }}
        </div>
        <a href='/themes/create'>ワンドロする！</a>
        <script>
        function deletePicture(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <!--`form_${id}`-->
    </body>
</x-app-layout>