# Symfony-Console-DIC

A simple application to create a Console application based on Dependency Injection Container of Symfony. Your console commands can be used for any recurring task, such as cronjobs, imports, or other batch jobs.
For more info, please check this https://symfony.com/doc/current/console.html
## Usage
~~~
git clone git@github.com:achrafSallemi/symfony-console-dic.git
cd symfony-console-dic
composer install
php index.php example:process type=hello --no-cleanup
~~~

### Structure

~~~
├── index.php
├── app
├── config
│   ├── commands.yaml
│   └── services.yaml
~~~

- Create Commands classes under namespace `App/Command`.
- Create your Services under namespace `App/Service`.
- Attach your Commands to `config/commands.yaml` file & your Services to `config/services.yaml` file.
