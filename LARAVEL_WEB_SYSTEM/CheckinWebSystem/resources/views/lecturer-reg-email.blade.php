<!DOCTYPE html>
<html lang="en">

<body>

    <p>Dear {{ $lecturer->firstname }}</p>
    <p>
        Your account as lecturer in Kenyatta University Check-In system has been created.
        You can now login using your email. Your generated password is provided below
    </p>

    <p>Your new passowrd is:</p>
    <h1>{{ $new_pass }}</h1>
    <p>Thanks</p>

</body>

</html>