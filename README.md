PHP Dropzone
=============
DropzoneJs widget for PHP, you can easily implement Dropzone.js library with you PHP application

A port of [DropzoneJs](http://www.dropzonejs.com/) for dropzone js configuration

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ajaz/php-dropzone-widget
```

or add

```
"ajaz/php-dropzone-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by to create Ajax upload area (JQuery is required) :

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Upload a File using Dropzone.js with PHP Widget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
</head>
<body>
<div class="container">
```
```php
<?php 
use Ajaz\widget\Dropzone;

require 'vendor/autoload.php';

$dropzone = new Dropzone([
    'uploadUrl'=>'upload.php', //your server side upload action
    'options'=>[
        'maxFilesize'=> '2',
        'acceptedFiles'=>'image/*',
        'dictDefaultMessage'=>'DRAG & DROP Your files'
    ],
    'clientEvents' => [
        'complete' => "function(file){console.log(file)}",
        'removedfile' => "function(file){alert(file.name + ' is removed')}"
    ],
]);
$dropzone->run();
?>
```
```html
</div>
</body>
</html>
```

To pass options : (More details at [dropzonejs official docs](http://www.dropzonejs.com/#toc_6) )

Example of upload method on server side:

```php
//upload.php
$folder_name = 'upload/';

if(!empty($_FILES))
{
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $_FILES['file']['name'];
 move_uploaded_file($temp_file, $location);
}
```
