<?php

namespace DS\Data\Converters;

interface IConverter
{
    public function apply(&$value): self;
}
