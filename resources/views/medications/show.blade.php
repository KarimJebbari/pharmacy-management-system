<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الدواء</title>
</head>
<body>
    <h1>{{ $medication->name }}</h1>
    <p>الوصف: {{ $medication->description }}</p>
    <p>السعر: {{ $medication->price }} درهم</p>
</body>
</html>