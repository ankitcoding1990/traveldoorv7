@component('mail::message')
# {{$data['subject']}}


## {{$data['message']}}

@isset($data['username'])
    # Username :- {{$data['username']}}
    # Password :- {{$data['password']}}
@endisset

@isset($data['route'])
    @component('mail::button', ['url' => $data['route']])
        Click Here To Login
    @endcomponent
@endisset

Thanks,<br>
Travel Door <br>
www.......
@endcomponent
