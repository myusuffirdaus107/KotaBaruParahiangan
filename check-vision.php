<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = Illuminate\Http\Request::capture()
);

$vm = \App\Models\VisionMission::find(1);
echo "Vision Title: " . $vm->vision_title . "\n";
echo "Image Path: " . $vm->image . "\n";
echo "File Exists: " . (file_exists('storage/app/public/' . $vm->image) ? 'YES' : 'NO') . "\n";
?>
