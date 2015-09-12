A lightweight, simple `var_dump` replacement.

```php
$var = array('sample', 10, false, null);
printr($var);
```

![Logo](logo.png)

---

* [Installation](#installation)
* [Usage](#usage)
* [Changelog](#changelog)
* [License](#license)

## Installation

* Install & load the `printr.php` file
* May be used as a WordPress [mu-plugin](https://codex.wordpress.org/Must_Use_Plugins) (`/path-to-wp/wp-content/mu-plugins`)

## Usage

```php
printr($var, $echo, $context);
```

| Parameter | Default | Description |
| --- | --- | --- |
| `$var` | *None* | The variable to inspect |
| `$echo` | `true` | Outputs the result (the HTML is also returned as a `string`)
| `$context` | `true` | Outputs the file and line where the function has been called, if available |

## Changelog

| Version | Date | Notes |
| --- | --- | --- |
| `1.0.0` | September 11, 2015 | Initial version |

## License

This project is released under the [MIT License](license).
