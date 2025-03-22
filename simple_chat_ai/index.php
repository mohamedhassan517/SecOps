<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat AI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div>
            <div class="textBox">
                <textarea id="output" disabled></textarea>
            </div>
            <div class="box">
                <input type="text" placeholder="Ask me something..." id="text">
                <button type="button" class="btn1" onclick="genarateResponse();">Genarate Response</button>
                <button type="button" class="btn2" onclick="stopGenarate();">Stop Genarating</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>