<?php

$apiKey = '60404ee37950482fb7244b8b03350d18';
$city = (string)readline('Input city which you enter: ');
$temperatureChoose = (string)readline('Choose temperature. F=fahrenheit, C=celsius: ');
$units = "";
$temperatureUnit = "";
if ($temperatureChoose == strtolower("f")) {
    $units = 'metric';
    $temperatureUnit = 'Fahrenheit';
}
if ($temperatureChoose == strtolower("c")) {
    $units = 'imperial';
    $temperatureUnit = 'Celsius';
}

if ($temperatureChoose !== strtolower("f") && $temperatureChoose !== strtolower("c")) {
    echo "ERROR! Invalid input!\n";
    exit;
}

$response = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units={$units}");
$data = json_decode($response, true);

if ($data) {
    $temperature = $data['main']['temp'];
    $description = $data['weather'][0]['description'];

    echo "$city: $temperature $temperatureUnit\n";
} else {
    echo "Error: Unable to get weather data.";
}
