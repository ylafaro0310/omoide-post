<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>思い出一覧</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
    <div class="container text-break" style="padding-top: 10px;">
        <h2>新規作成</h2>
        <form action="/omoide" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">思い出の内容を書いてください</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
    <script src="{{ mix('js/app.js') }}">
    </body>
</html>
