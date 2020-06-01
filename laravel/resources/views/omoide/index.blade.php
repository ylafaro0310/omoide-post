<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>思い出一覧</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
    @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif
    <div class="container text-break" style="padding-top: 10px;">
        <h2>一覧</h2>
        <ul class="list-group">
            @foreach ($omoides as $omoide)
            <li class="list-group-item">
                <div class="row">
                <div class="col-9">
                    {{ $omoide->content }}
                    @if (!empty($omoide->image_path))
                    <figure>
                        <img src="public/storage/{{ $omoide->image_path }}" width="100px" height="100px">
                        <figcaption>思い出の写真</figcaption>
                    </figure>
                    @endif
                </div>
                <div class="col-3">
                    <form method="POST" action="{{ action('OmoideController@destroy',$omoide->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">削除</button>
                    </form>
                </div>
                </div>
            </li>
            @endforeach
        </ul>
        <a class="btn btn-primary" href="/omoide/create" role="button" style="margin-top: 10px">新規作成</a>
    </div>
    <script src="{{ mix('js/app.js') }}">
    </body>
</html>
