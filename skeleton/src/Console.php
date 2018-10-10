<?php declare(strict_types=1);

namespace Skeleton;

class Console
{
    private function readLine(): string
    {
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);

        return $line;
    }

    private function readCharacter(): string
    {
        $handle = fopen("php://stdin", "r");
        $character = fgetc($handle);
        fclose($handle);

        return $character;
    }

    private function readString(): string
    {
        return trim($this->readLine());
    }

    private function readYesNo(): string
    {
        $answer = strtolower($this->readCharacter());

        return ($answer !== 'y' && $answer !== 'n') ? $answer : $this->readYesNo();
    }

    private function readYesNoDefault(string $default): string
    {
        $answer = strtolower(trim($this->readCharacter()));

        return (!in_array($answer, ['y', 'n', ''])) ? $answer : $default;
    }

    public function print(string $string): void
    {
        echo $string;
    }

    public function println(string $line): void
    {
        echo "$line\n";
    }

    public function askYesNo(string $question, callable $fnWhenYes, callable $fnWhenNo = null): void
    {
        echo $question . ' (y/n) ';

        if ($this->readYesNo() === 'y') {
            $fnWhenYes();
        } elseif (is_callable($fnWhenNo)) {
            $fnWhenNo();
        }
    }

    public function askYesNoDefaultYes(string $question, callable $fnWhenYes, callable $fnWhenNo = null): void
    {
        echo $question . " (\033[0;36mY\033[0m/n): ";

        if ($this->readYesNoDefault('y') === 'y') {
            $fnWhenYes();
        } elseif (is_callable($fnWhenNo)) {
            $fnWhenNo();
        }
    }

    public function askYesNoDefaultNo(string $question, callable $fnWhenNo, callable $fnWhenYes = null): void
    {
        echo $question . " (y/\033[0;36mN\033[0m): ";

        if ($this->readYesNoDefault('n') === 'n') {
            $fnWhenNo();
        } elseif (is_callable($fnWhenYes)) {
            $fnWhenYes();
        }
    }

    public function askStringValue(string $question, callable $fnCallback): void
    {
        echo $question . ': ';
        $value = $this->readString();

        if ($value) {
            $fnCallback($value);
        } else {
            $this->askStringValue($question, $fnCallback);
        }
    }

    public function askStringValueDefault(string $question, string $default, callable $fnCallback): void
    {
        echo $question . ' [' . $default . ']: ';
        $value = $this->readString();

        $fnCallback($value ? $value : $default);
    }
}
