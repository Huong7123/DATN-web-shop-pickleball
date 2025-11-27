
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mã OTP</title>
</head>
<body>
    <h3>Chào mừng bạn đến với website</h3>
    <p>Mã OTP của bạn là: </p>
    <div style="width:150px; height:48px; background-color:cornflowerblue;
            color:white; font-size:28px; text-align:center; line-height:48px;">
            {{ $otp }}
    </div>
    <p>Mã này sẽ hết hạn trong <strong>5 phút</strong>. Vui lòng không chia sẻ cho bất kỳ ai.</p>
</body>
</html>
