<?php

use CMW\Utils\EnvBuilder;


class cliBuilder{
    protected EnvBuilder $envBuilder;


    public function __construct()
    {
        $this->envBuilder = new EnvBuilder();


        $this->loadLang();
    }

    private function loadLang(): void
    {
        require_once("app/cli/utils/lang/" . $this->envBuilder->getValue("LOCALE") . ".php");
    }

    public function emptyArgs(): void
    {
        $this->sayLn(CLI_EMPTY_ARGS);
    }

    /* UTILS FUNCTIONS */

    public function say(string... $contents): void
    {
        foreach($contents as $content) {
            echo "$content ";
        }
    }

    public function sayLn(string... $contents): void
    {
        foreach($contents as $content) {
            echo "\n$content\n";
        }
    }

    public function read(): ?string
    {
        return readline("> ");
    }

}
