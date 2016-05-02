<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Search</h1>
        
        {!! Form::open(['action' => 'PostsController@store']) !!}
        
        {!! Form::label('title', 'Title:') !!}
        
        {!! Form::text('title') !!}
        
        {!! Form::label('body') !!}
        {!! Form::textarea('body') !!}
        
        {!! Form::submit('Submit', ['name' => 'submit']) !!}
        
        {!! Form::close() !!}
    </body>
</html>