@props(['for', 'messages' => []])

@if($messages)
<p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
    @foreach($messages as $message)
    {{ $message }}<br>
    @endforeach
</p>
@endif