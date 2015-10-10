<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/10
 * Time: 19:36
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ratchet client test </title>
    <script>
        if (!window.WebSocket)
            alert("No Support ");
        // Then some JavaScript in the browser:
        var conn = new WebSocket('ws://localhost:8080/echo');
        conn.onmessage = function(e) { console.log(e.data); };
        conn.send('Hello Me!');
    </script>


</head>
<body>

</body>
</html>