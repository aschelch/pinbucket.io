@component('mail::message')
# {{ $team->name }} Weekly Newsletter

Let's see what your teamates added last week :

@foreach($links as $link)
**[{{$link->title}}]({{$link->url}})**
{{str_limit($link->description, 300)}}
_Added {{\Carbon\Carbon::parse($link->created_at)->diffForHumans()}} by {{$link->user()->first()->name}}_
@endforeach

@component('mail::button', ['url' => config('app.url')])
Share some links
@endcomponent

Have a good day,<br>
{{ config('app.name') }}
@endcomponent
