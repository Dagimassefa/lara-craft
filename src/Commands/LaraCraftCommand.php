<?php

namespace Dagim\LaraCraft\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class LaraCraftCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output->writeln('<fg=blue>LaraCraft</> - by Dagim');
        $this->output->writeln('');
        
        return parent::execute($input, $output);
    }

    protected function displaySuccess($message)
    {
        $this->output->writeln("<fg=green>✓</> $message");
    }

    protected function displayError($message)
    {
        $this->output->writeln("<fg=red>✗</> $message");
    }
    
    protected function getConfig($key = null, $default = null)
    {
        $config = config('lara-craft');
        
        return $key ? ($config[$key] ?? $default) : $config;
    }
    
    protected function getStub($name)
    {
        $stubPath = $this->getConfig('stubs_path')."/{$name}.stub";
        
        if (!file_exists($stubPath)) {
            throw new \Exception("Stub file not found: {$stubPath}");
        }
        
        return file_get_contents($stubPath);
    }
    
    protected function parseFields($fieldsInput)
    {
        $fields = [];
        $fieldItems = explode(',', $fieldsInput);
        
        foreach ($fieldItems as $fieldItem) {
            $fieldItem = trim($fieldItem);
            if (strpos($fieldItem, ':') !== false) {
                [$name, $type] = explode(':', $fieldItem, 2);
                $fields[trim($name)] = trim($type);
            }
        }
        
        return $fields;
    }
}
?>