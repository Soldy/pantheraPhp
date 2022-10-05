<?php

namespace Soldy\PanteraPhp;

interface SqlInterface
{
    public function queryProcedure(string $procedure, array $vars): array
    public function queryFunction(string $func, array $vars): string
}
