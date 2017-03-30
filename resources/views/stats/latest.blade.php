
@foreach($latest as $key => $post)
<form method="POST" action="/index.php/latest/del/{!!$key!!}">
    <button type="submit">DELETE</button>
</form>
<h3>{!!$key!!}</h3> <br>{!! $post !!} <hr>

@endforeach