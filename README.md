# RithisSpriterBundle

Symfony2 Bundle for compiling css sprites

## Installation

Run this command in your project directory:

``` bash
$ composer.phar require rithis/spriter-bundle:@dev
```

After that enable bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Rithis\SpriterBundle\RithisSpriterBundle(),
    );
}
```

## Usage

After bundle is registered you can use `sprite` tag in twig:

```twig
{% sprite "@SomeBundle/Resource/images" %}
```

That tag adds link to sprite stylesheet.
