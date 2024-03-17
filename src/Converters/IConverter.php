<?php

namespace DS\Generator\Converters;

interface IConverter
{
    public function apply(&$value): self;
}
