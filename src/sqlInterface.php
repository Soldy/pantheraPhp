<?php

namespace Soldy\PanteraPhp;

interface SqlInterface
{
    public function queryProcedure(string $procedure, array $vars): mixed
    public function queryFunction(string $func, array $vars): string|int
}
