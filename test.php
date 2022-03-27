<?php

use Bic\Audio\Bass\BassDriver;

require __DIR__ . '/vendor/autoload.php';

$audio = new BassDriver(
    __DIR__ . '/../Application/bin/x64/bass.dll',
    __DIR__ . '/../Application/bin/x64/bassmix.dll',
);

$device = $audio->getDefaultOutputDevice();

$stream = $device->createStream();
$stream->addSourceByPathname(__DIR__ . '/../Application/resources/audio/doom.mp3');

$stream->play();

while (true) {}
