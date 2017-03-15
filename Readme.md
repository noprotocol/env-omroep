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

Add `DATA_STORAGE_COMMANDS` to your `.env` if you need certain commands to use the new storage path

```
DATA_STORAGE_COMMANDS=site:canlog,site:another
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

## Creating folders

The omroep server does not like when you create folders via FTP or SSH on the data disk. The permissions get all wrong and it is a mess to fix.
You can use this script to create the folders via the webserver user.

Place this script in the public folder and remove it after using:

```
<?php

header('Content-Type: text/plain');
ini_set('display_errors', true);

echo "Preparing data folder\n";
require(__DIR__ . '/../vendor/autoload.php');

$dataFolder = new Noprotocol\EnvOmroep\DataFolder();
$dataFolder->createLaravelFolders();
$dataFolder->mkdir('uploads');

echo "completed\n";
```