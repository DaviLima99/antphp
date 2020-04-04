<?php

namespace Antcli\Services;

abstract class Service
{
    protected function getMessage(string $message) : string
    {
        $messages = $this->messages();
        foreach ($messages as $key => $msg) {
            if ($key == $message) {
                return $msg;
            } 
        }
    }

    protected function getMenuCommand(string $menuCommand) : string
    {
        if (!file_exists(__DIR__ . "/../templates/commands/{$menuCommand}.txt")) {
            return file_get_contents(__DIR__ . '/templates/all_commands.txt') . "\n";
        }
        
        return file_get_contents(__DIR__ . "/../templates/commands/{$menuCommand}.txt") . "\n";
    }

    abstract protected function messages() : array;
}
