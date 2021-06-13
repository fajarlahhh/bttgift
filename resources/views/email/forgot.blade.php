<!DOCTYPE html>
<html>
<body>
    Hy {{ $data['name'] }}, this is your password recovery link:<br><br>
    <a href="{{ config('app.url') }}/recovery?token={{ $data['token'] }}" target="_blank">{{ config('app.url') }}/recovery?token={{ $data['token'] }}</a><br>
    Thank You
    <br><br>
    <div style="text-align: center">
        This email was sent to {{ $data['email'] }}<br>
        You received this email because you are registered with <a href="{{ config('app.url') }}">Rich n Win</a>
    </div>
</body>
</html>
