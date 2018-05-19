# Toastr notifications for laravel 5.*

<p align="center">
    <a href="https://packagist.org/packages/tjgazel/laravel-toastr"><img src="https://poser.pugx.org/tjgazel/laravel-toastr/v/stable.svg"></a>
    <a href="https://github.com/tjgazel/laravel-toastr/blob/master/LICENSE"><img src="https://poser.pugx.org/tjgazel/laravel-toastr/license.svg"></a>
    <a href="https://packagist.org/packages/tjgazel/laravel-toastr"><img src="https://poser.pugx.org/tjgazel/laravel-toastr/d/total.svg"></a>
</p>

<p align="center"><img src="toastr.png"></p>

<br>

- [Instalation](#instalation)
- [Usage](#usage)
- [Tanks](#tanks)

<br>

<a name="instalation"></a>
## Installation

#### 1. Install the Toastr library (front end dependency)

Install [Toastr](http://codeseven.github.io/toastr/) via npm . [Github](https://github.com/CodeSeven/toastr) | [Demo](http://codeseven.github.io/toastr/demo.html)
```
npm install toastr --save-dev
```

<br>

Require the js in resources/assets/js/bootstrap.js as `window.toastr = require('toastr');`

```
try {
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');

  window.toastr = require('toastr');

} catch (e) { }
```

<br>

Import the sass in resources/assets/sass/app.scss as `@import "~toastr/toastr";` then build via npm `npm run prod`.
```
// Fonts
@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700");

// Variables
@import "variables";

// Bootstrap
@import "~bootstrap/scss/bootstrap";

// Toastr
@import "~toastr/toastr";
```

<br><br>

#### 2. Install tjgazel/laravel-toastr

Install via composer
```
composer require tjgazel/laravel-toastr
```

<br>

`Laravel 5.5 or later` will automatically discover the provider and the alias.<br><br>

**Optional:** Laravel 5.4 and below <br>

Add `TJGazel\Toastr\ToastrServiceProvider::class` to `providers` in `config/app.php`. <br>
Add `'Toastr' => TJGazel\Toastr\Facades\Toastr::class` to `aliases` in `config/app.php`.
<br>
```
// config/app.php

'providers' => [
  // ...
  TJGazel\Toastr\ToastrServiceProvider::class,
],

'aliases' => [
  // ...
  'Toastr' => TJGazel\Toastr\Facades\Toastr::class,
],
```

<br>

Run
```
php artisan vendor:publish --provider="TJGazel\Toastr\ToastrServiceProvider"
```
to publish the config file.

<br>

Add `{!! Toastr::render() !!}` Facade or `{!! toastr()->render() !!}` helper in your main view.
```
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
    <div id="app"></div>
    <script type="text/javascript" src="js/app.js"></script>
    {!! toastr()->render() !!}
</body>
</html>
```

<br>

**Optional:** <br>
Modify the publish configuration file locate at `config/toastr.php` to your liking.

```
<?php

return [

    'session_name' => 'toastr',

    'options' => [
        "closeButton" => true,
        "debug" => false,
        "newestOnTop" => false,
        "progressBar" => true,
        "positionClass" => "toast-bottom-right",
        "preventDuplicates" => false,
        "onclick" => null,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "10000",
        "extendedTimeOut" => "1000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"
    ]

];
```
<br><br>

<a name="usage"></a>
## Usage

Use the Toastr facade `Toastr::` or the helper function `toast()->` to access the methods in this package.
```
Toastr::error(string $message, string $title = null, array $options = []);

toastr()->error(string $message, string $title = null, array $options = []);
```

<br>

**Examples:**
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;

class DashboardController extends Controller
{

    public function index()
    {
        Toastr::info('welcome admin!');

        return view('dashoard.index');
    }
}
```

<br>

You can also chain multiple messages together using:
```
toastr()
    ->error('Unauthorized!', 'Error 401')
    ->info('Authentication required to access dashboard page', null, ['timeOut' => 15000]);

return redirect('/login');
```
Note that in the `3rd parameter` you can customize `toastr options`. See the `config/toastr.php` file for all possibilities.

<br>

**All methods** <br>
```
toastr()->info();
toastr()->warning();
toastr()->success();
toastr()->error();
```
<br>

<a name="tanks"></a>
### Tanks for:
[Toastr](http://codeseven.github.io/toastr/) <br>
[Laravel](https://laravel.com/)

**Author:** Talles Gazel <br>
[Home page](https://tjgweb.com.br/) <br>
[Facebook](https://www.facebook.com/talles.gazel) <br>