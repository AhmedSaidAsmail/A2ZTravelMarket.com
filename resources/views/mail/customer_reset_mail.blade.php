<h1>Reset Your A2ZTravelMarket Password</h1>
<span style="display: block">Hi: {{$sending_to}}</span>
To reset your password, just click <a href="{{route('customer.password.reset.back',['email'=>$sending_to,'token'=>$token,'session_time'=>$session_time])}}">here</a>.