# CLI Command
This repo allows you to create CLI commands/handlers for your application.

It's rather easy: create classes that implement the `Alesinicio\CLICommand\Commands\CLICommandInterface`, register a command that binds to that class and voila!

# Example


```
//Hello.php
<?php
namespace Your\Namespace;
class Hello implements Alesinicio\CLICommand\Commands\CLICommandInterface {
    public function run(mixed ...$args) : void {
        echo sprintf("Hello %s!\n", $args[0] ?? 'noname');
    }
}

//yourDependencyInjectionRegistry.php
<?php
$commandCollection = new Alesinicio\CLICommand\CommandCollection();
$commandCollection
    ->addCommand('hello', Your\Namespace\Hello::class)
;

//command.php
<?php
global $argc, $argv;
$di = loadYourDependencyInjectionContainer();
try {
	$di->get(Alesinicio\CLICommand\CLICommandHandler::class))->handle($argc, $argv);
} catch (Exception $e) {}

```
Now you can call your `command.php` script with the following format:

```
php command.php <command> <argument0> <argument1> ... <argumentN>`

$ php command.php hello master
Hello master!
```

Of course, the setup is all yours to make. You can also make the PHP entrypoint executable with a shebang!