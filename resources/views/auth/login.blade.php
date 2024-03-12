<form action="login" method="post">
    @csrf
    <input type="text" name="email" value="{{old('email')}}">
    <br>
    @error('email'){{ $message }}<br>@enderror

    <input type="password" name="password" value="{{old('password')}}">
    <br>
    @error('password'){{ $message }}<br>@enderror

    <input type="checkbox" name="remember" value="1">
    <br>

    <button type="submit">Login</button>

</form>