@if ($categories)
    <div>
            <a href="/" style="padding: 0.5rem 1rem; @if($categoryId) border: 1px solid gray; background: transparent; color: #292E35; @else background: #292E35; color: white; @endif border-radius: 20px;">All</a>
        @foreach ($categories as $key => $value)
           @if($value->status == 0) <a href="/?cat={{ $value->id }}" style="padding: 0.5rem 1rem; @if($categoryId == $value->id) background: #292E35; color: white; @else border: 1px solid gray; background: transparent; color: #292E35; @endif border-radius: 20px;">{{ $value->name }}</a>@endif
        @endforeach
    </div>
@endif
