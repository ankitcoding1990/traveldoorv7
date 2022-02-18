@php
    $tokenFromMail = request()->get('token');
    $tokenFromSession = session()->get('token');
    if($tokenFromSession == $tokenFromMail){
        
    }
@endphp