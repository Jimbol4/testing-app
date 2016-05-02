<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Search</h1>
        
        {!! Form::open() !!}
        
        {!! Form::label('query', 'Search terms:') !!}
        
        {!! Form::text('query') !!}
        
        {!! Form::submit('Search', ['name' => 'search']) !!}
        
        {!! Form::close() !!}
    </body>
</html>