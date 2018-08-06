@if($errors->any())
    <ul class="alert alert-danger" style="list-style-type: none">
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
        <h1>if</h1>
@else
	<h1>else</h1>
@endif
