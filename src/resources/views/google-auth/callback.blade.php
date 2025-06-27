<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Google Callback</title>
</head>

<body>
    <script>
        window.opener.postMessage(
            @json($response),
            window.opener.location.origin
        );
        window.close();
    </script>
</body>

</html>
