@props(['name', 'type' => 'text', 'value' => ''])
<div class="mb-3">
    <label for = {{$name}}>{{ucwords($name)}}</label>
    <input type= "{{$type}}" name = {{$name}} value = "{{ old($name, $value) }}" class="form-control">
    <x-error :name="$name" />
</div>