<?php


interface SqlInterface
{
    public function queryProcedure(string $procedure, array $var_array): array
    public function queryFunction(string $func, array $var_array ): string 
}
