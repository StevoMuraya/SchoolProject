<!DOCTYPE html>
<html lang="en">

<body>

    <p>Dear {{ $user->firstname }}</p>
    <p>
        Your account as an admin for Kenyatta University Check-In system has been created.
        You can now login using your email. Your generated password will be provided below
    </p>

    <p>
        You can activate you account by clicking the link provided below. In-case you experience any issues, please
        contact the system administrator through systems@checkin.ku.ac.ke.
    </p>

    <p><a href="{{ route('verify',$user->email_verification_token) }}">
            {{ route('verify',$user->email_verification_token) }}
        </a></p>

    <p>Your new passowrd is:</p>
    <h1>{{ $new_pass }}</h1>
    <p>Thanks</p>

</body>

</html>