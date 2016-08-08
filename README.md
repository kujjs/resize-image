#Image Resizing  Package for Laravel 5.*

[![Laravel](https://img.shields.io/badge/Laravel-5.*-orange.svg?style=flat-square)](http://laravel.com)
[![Software License][ico-license]](LICENSE.md)

based on **[anakadote/laravel-5-image-manager.][1]**

Resize images with predefined sizes in config / imageManager.php

## Install

Via Composer

``` bash
$ composer require  kujjs/imageManager
```

add the service provider. config/app.php

```php
kujjs\imageManager\imageManagerServiceProvider::class,
```

and run the following command

``` bash
$ php artisan vendor:publish
``` 
## Usage

predefine values in **config/image-manager.php**
```php
    'sizes' => [
        'small' => [
            'width'   => 400,
            'height'  => 300,
            'mode'    => 'crop', || fit || fit-x || fit-y
            'quality' => 90
          ]
    ];
```
| Property || Description |
|--------|----|-------------|
|`width`|*required*|The width of the generated image in pixels.|
|`height`|*required*|The height of the generated image in pixels.|
|`mode`|*required*|Defines the way the image will be transformed. See the table below for accepted methods|
|`quality`|*required*|The quality that will have the final image. range 0-100|



|Mode|Description|
|------|-----------|
|`crop`|Will smart crop an image to make it fit the desired dimensions. It will cut content of the image off the top/bottom and sides if required to preserve the aspect ratio.|
|`fit`| Fit while maintaining aspect ratio|
|`fit-x`| Fit to the given width while maintaining aspect ratio|
|`fit-y`| Fit to the given height while maintaining aspect ratio|


## **Image::resize($file , $size='small' , $html=false || array('class'=>'' , 'alt'=>'' , 'title' =>''))** ##

```php
     {{ Image::resize(public_path() .'/img/image.jpg','small') }} 
OR
      {{ Image::resize(public_path() .'/img/image.jpg') }}
```
return
```html
    http://url/img/400-300/crop/image.jpg
```

## or 
```php
    {!! Image::resize(public_path() .'/img/image.jpg','small',['class'=>'my-class','alt'=>'my alt','title'=>'my title']) !!}
```
return 
```html
    <img src="http://url/img/400-300/crop/image.jpg" alt="my alt" title="my title" class="my-class">
```
| Property || Description |
|--------|----|-------------|
|`File`|*required* *(string)*| The fully qualified name of image file. The file must reside in your app's public directory. You'll need to grant write access by the web server to the public directory and its children|
|`Size Name`|*(optional)* *(string)*|The name of the size that is defined in **config/image-manager.php**.|
|`Html`|*(optional)* *(string)*|returns tag `<img>` with different attributes. See the table below for accepted|



| Html|| Description |
|--------|----|-------------|
|`Alt`|*(optional)*|Specifies an alternate text for an image|
|`Title`|*(optional)*|the name implies, is the title of your image.|
|`Class`|*(optional)*|Css Class|
# Remove
##**Image::delete($file)**
remove image with all size declarade in config/image-manager.php
```php
    Image::delete(public_path() .'/img/image.jpg')
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-travis]: https://travis-ci.org/:vendor/:package_name


  [1]: https://github.com/anakadote/ImageManager-for-Laravel-5

