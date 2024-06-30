<?php

namespace Hexafuchs\DynamicArtisanServiceProvider;

use Illuminate\Foundation\Providers\ArtisanServiceProvider;

class DynamicArtisanServiceProvider extends ArtisanServiceProvider
{
    public static array $registeredCommands = [];

    /**
     * Add a new command.
     *
     * Note that as far as I know there is no functional difference between dev and normal commands.
     *
     * @param string $commandName command name, typically a UpperCamelCase notation of the command without the "Command" suffix
     * @param string $originalClassName className if you add a new command this is your class, otherwise it's the class you want to overwrite
     * @param callable|string|null $overwriteCommandOrClosure if you want to add a new command without a constructor leave this as null, use your class name (::class notation) to overwrite a command without a constructor, or use a closure otherwise. The value is passed as the second argument to $app->singleton().
     * @param bool $isDevCommand add the command to the dev list instead of the normal commands list
     * @return void
     */
    public static function registerCommand(string $commandName, string $originalClassName, callable|string|null $overwriteCommandOrClosure = null, bool $isDevCommand = false): void
    {
        dump("Registering command '{$commandName}'");
        self::$registeredCommands[$commandName] = [
            $originalClassName,
            $overwriteCommandOrClosure,
            $isDevCommand
        ];
    }

    /**
     * @var array stores all commands that are manually set to prevent overwriting them
     */
    protected array $denylist = [];

    /**
     * Registers the commands. It skips commands that were set using setCommand.
     *
     * @param array $commands
     * @return void
     */
    protected function registerCommands(array $commands): void
    {
        dump("Registered commands " . join(', ', array_keys(self::$registeredCommands)));
        foreach (self::$registeredCommands as $commandName => [$originalClassName, $overwriteCommandOrClosure, $isDevCommand]) {
            $this->setCommand($commandName, $originalClassName, $overwriteCommandOrClosure, $isDevCommand);
        }

        $trimmedCommandList = array_filter($commands, fn($key) => !in_array($key, $this->denylist), ARRAY_FILTER_USE_KEY);
        foreach ($trimmedCommandList as $commandName => $command) {
            $method = "register{$commandName}Command";

            if (method_exists($this, $method)) {
                $this->{$method}();
            } else {
                $this->app->singleton($command);
            }
        }

        $this->commands($trimmedCommandList);
    }

    /**
     * Add a new command.
     *
     * Note that as far as I know there is no functional difference between dev and normal commands.
     *
     * @param string $commandName command name, typically a CamelCase notation of the command without the "Command" suffix
     * @param string $originalClassName className if you add a new command this is your class, otherwise it's the class you want to overwrite
     * @param callable|string|null $overwriteCommandOrClosure if you want to add a new command without a constructor leave this as null, use your class name (::class notation) to overwrite a command without a constructor, or use a closure otherwise. The value is passed as the second argument to $app->singleton().
     * @param bool $isDevCommand add the command to the dev list instead of the normal commands list
     * @return void
     */
    public function setCommand(string $commandName, string $originalClassName, callable|string|null $overwriteCommandOrClosure = null, bool $isDevCommand = false): void
    {
        $this->denylist[] = $commandName;
        if ($isDevCommand) {
            $this->devCommands[$commandName] = $originalClassName;
        } else {
            $this->commands[$commandName] = $originalClassName;
        }
        $this->app->singleton($originalClassName, $overwriteCommandOrClosure);

        $this->commands([$commandName => $originalClassName]);
    }

    /**
     * Returns if a command name is the commands list.
     *
     * Note 1: The command name is not the same as the signature, please refer to
     * \Illuminate\Foundation\Providers\ArtisanServiceProvider to see all available command names.
     *
     * @param string $commandName name of the command
     * @param bool $includeDevCommands whether to include commands in the devCommands list
     */
    public function hasCommand(string $commandName, bool $includeDevCommands = true): bool
    {
        return isset($this->commands[$commandName]) || ($includeDevCommands && $this->hasDevCommand($commandName));
    }

    /**
     * Returns if a command name is the devCommands list.
     *
     * Note 1: The command name is not the same as the signature, please refer to
     * \Illuminate\Foundation\Providers\ArtisanServiceProvider to see all available command names.
     *
     * @param string $commandName name of the command
     */
    public function hasDevCommand(string $commandName): bool
    {
        return isset($this->devCommands[$commandName]);
    }
}
