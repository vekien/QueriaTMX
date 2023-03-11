# QueriaTMX

A simple PHP application that can parse TMX files and create a searchable UI to help find translations.

### Basic Setup

To simplify the usage of this, PHP and all composer libraries are included.

1. Clone the project: `git@github.com:vekien/QueriaTMX.git`
2. Place your files inside the `tmx` folder
3. Open Command Prompt at the folder of this project
4. Import your TMX: `.\php\php.exe bin/console parse_tmx`
5. Start the project: `.\php\php.exe -S localhost:8000 public/index.php`
6. Navigate to: http://localhost:8000/

You should see something to the below image :)

![image](https://user-images.githubusercontent.com/270800/223711245-351189fa-4114-4878-90f7-e00d9070809b.png)
