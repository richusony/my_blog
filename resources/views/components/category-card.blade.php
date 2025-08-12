@if ($categories)
    @foreach ($categories as $cat)
        <div style="width: 300px; height: 100px; background-color: white; position: relative; border-radius: 10px; border: 1px dotted gray;">
            <div style="text-align: center; color: gray; font-weight: 600;">
                <span>{{ $cat->name }}</span>
            </div>
            <label for="disableBtn" style="position: absolute; bottom: 0; width: 100%; @if($cat->status == 0) background-color: red; @else background-color: green; @endif border-radius: 0 0 10px 10px; text-align: center;">
                <a onclick="return confirm('Are you sure?');" href="/change-status?cat_id={{$cat->id}}" id="disableBtn" style="color: white;">@if($cat->status == 0) Disable @else Enable @endif</a>
            </label>
        </div>
    @endforeach
@endif