# QueriaTMX

A simple PHP application that can parse TMX files and create a searchable UI to help find translations.

### Basic Setup

To simplify the usage of this, PHP and all composer libraries are included.

1. Clone the project: `git@github.com:vekien/QueriaTMX.git`
2. Place your files inside the `tmx` folder
3. Open Command Prompt at the folder of this project
4. Import your TMX: `.\php\php.exe -d memory_limit-1 bin/console parse_tmx`
5. Start the project: `.\php\php.exe -S localhost:8000 public/index.php`
6. Navigate to: http://localhost:8000/

You should see something to the below image :)

![image](https://user-images.githubusercontent.com/270800/223711245-351189fa-4114-4878-90f7-e00d9070809b.png)

### FAQ

- **Why should I use QueriaTMX as opposed to MemoQ TM Search, TMX Viewer, etc.?**

We find QueriaTMX to be overall more lightweight and responsive than the aforementioned apps. Moreover, once deployed, it doesn't require any 3rd party app to function.

- **What about privacy?**

QueriaTMX is a self-hosted solution, which means it runs exclusively on your local machine. Should you choose to share it on a local NAS or server, you must ensure that all security measures are in place to protect your data.

- **What other benefits can I get from QueriaTMX?**

Should you choose to host TMX content on a server, you can share it with people within your organization so they can look up terms and their translations in your TMs without installing CAT tools or TMX browsing apps. Moreover, QueriaTMX can be used in a browser, which makes it easy to integrate into web query tools such as MemoQ Web Search.
