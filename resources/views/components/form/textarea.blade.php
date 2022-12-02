@props(['name', 'value' => ''])
<div class="mb-3">
    <label for = "{{$name}}">{{ucwords($name)}}</label>
    <textarea name="{{$name}}" id="" cols="30" rows="5" class = "form-control editor">{!!old($name, $value)!!}</textarea>
    <x-error name="{{$name}}" />
</div>


