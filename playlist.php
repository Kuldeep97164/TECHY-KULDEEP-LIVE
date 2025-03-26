<?php

$jsonFile = 'data.json';
$jsonData = file_get_contents($jsonFile);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$scriptUrl = $protocol . $host . str_replace('playlist.php','index.php', $requestUri);
$data = json_decode($jsonData, true);
echo "#EXTM3U\n\n";
foreach ($data['data'] as $channel) {
    $id = $channel['id'];
    $name = $channel['channel_name'];
    $logo = $channel['logo'];
    $genre = $channel['genre'];
    $streamUrl = $scriptUrl.'?id='. $id;    
    echo "#EXTINF:-1 tvg-id=\"$id\" group-title=\"$genre\" tvg-logo=\"$logo\",$name\n";
    echo "$streamUrl\n\n";
}
exit;
