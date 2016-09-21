Patch PHP/Laravel to work in different environments

## Installation

Add **noprotocol/env-omroep** as a composer dependancy:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/noprotocol/env-omroep"
        }
    ],
    "require": {
        "noprotocol/env-omroep": "dev-master"
    }
}
```
### Laravel

## Configuration

Add `DATA_PATH` to your `.env`
 
```
DATA_PATH=/e/ap/$domain/data
```

In /bootstap/app.php change:
```
$app = new Illuminate\Foundation\Application(
```
to
```
$app = new Noprotocol\EnvOmroep\LaravelApplication(
```
(If you're using a custom Application class, update superclass to Noprotocol\EnvOmroep\LaravelApplication)