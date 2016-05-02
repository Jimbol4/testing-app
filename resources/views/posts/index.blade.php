<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Posts</h1>
        
        @if (count($posts))
        <ul>
            @foreach ($posts as $post)
            <li> {{ $post->title }}</li>
            @endforeach
        </ul>
        @endif
    </body>
</html>