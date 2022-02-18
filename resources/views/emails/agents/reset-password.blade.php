@component('mail::message')
# {{ $data['title']}}

{{$data['description']}}

@component('mail::button', ['url' => $data['url']])
Reset Password
@endcomponent
Regrads TravelDoor Team,<br>
@endcomponent
