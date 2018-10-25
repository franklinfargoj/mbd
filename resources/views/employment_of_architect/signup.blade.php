@extends('admin.layouts.app')
@section('content')
<form method="post" action="{{route('appointing_architect.post_signup')}}">
    @csrf
    <table class="table">
        <tr>
            <th>Name</th>
            <td>
                <input type="text" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" name="email" value="{{old('email')}}">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </td>

        </tr>
        <tr>
            <th>Mobile</th>
            <td><input type="text" name="mobile_no" value="{{old('mobile_no')}}">
                @if ($errors->has('mobile_no'))
                <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                @endif</td>

        </tr>
        <tr>
            <th>Password</th>
            <td><input type="password" name="password">
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </td>

        </tr>
        <tr>
            <th>Confirm Password</th>
            <td><input type="password" name="confirm_password">
                @if ($errors->has('confirm_password'))
                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <th><a href="{{route('appointing_architect.login')}}">Back</a></th>
            <td><input type="submit" name="submit" value="signup"></td>
        </tr>
    </table>
</form>
@endsection
