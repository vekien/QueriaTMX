# QueriaTMX

A simple PHP application that can parse TMX files and create a searchable UI to help find translations.

This requires a PHP server, either ran locally like so: `php -S localhost:8000` or setting up a simple stack/docker.

![image](https://user-images.githubusercontent.com/270800/223711245-351189fa-4114-4878-90f7-e00d9070809b.png)

### Importing Files

Place your TMX files into the `tmx` folder, then run the command:

```
php -d memory_limit=-1 bin/console parse_tmx
```
    
