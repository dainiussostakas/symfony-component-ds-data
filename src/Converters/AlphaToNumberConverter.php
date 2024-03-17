<?php

namespace DS\Generator\Converters;

class AlphaToNumberConverter extends BaseConverter
{
    public function __construct(protected string $separator = '/', protected ?string $encoding = null)
    {
    }

    public function apply(&$value): self
    {
        $newString = '';
        $chars = mb_str_split($value, 1, $this->encoding);
        $previousCharIsInt = false;

        foreach ($chars as $char) {
            $charInt = mb_ord($char);
            if ($charInt >= 0x30 && $charInt <= 0x3a) {
                if (!$previousCharIsInt && $newString !== '') {
                    $newString .= $this->separator;
                    $previousCharIsInt = true;
                }
                $newString .= $char;
                continue;
            }

            if ($charInt >= 0x41 && $charInt <= 0x5B) {
                $char = (string)($charInt - 0x41 + 1);
            }

            if ($charInt >= 0x61 && $charInt <= 0x7a) {
                $char = (string)($charInt - 0x61 + 1);
            }

            if ($previousCharIsInt) {
                $previousCharIsInt = false;
            }

            if ($newString !== '') {
                $newString .= $this->separator;
            }

            $newString .= $char;
        }

        $value = $newString;

        return $this;
    }
}
