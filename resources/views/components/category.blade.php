@if ($categories)
    <div>
            <a href="/" style="padding: 0.5rem 1rem; border: 1px solid gray; background: transparent; color: #292E35; border-radius: 20px;">All</a>
        @foreach ($categories as $key => $value)
           @if($value->status == 0) <a href="/?cat={{ $value->id }}" style="padding: 0.5rem 1rem; border: 1px solid gray; background: transparent; color: #292E35; border-radius: 20px;">{{ $value->name }}</a>@endif
        @endforeach
    </div>
@endif
