<?php

namespace Soldy\PanteraPhp;

// because every body need a triats.

trait SqlSecurity
{
    /*  Always double check every thing.
    * @param {string} input text
    * @rotected
    * @return {string} safe string
    */
    protected function security(string &$string): string
    {
        return htmlspecialchars($string, ENT_QUOTES); // not a real full safe
    }
    /* the functions may have multiple inputs
    * @param {array} input
    * @rotected
    * @return {string} safe string  // the output is a ready to push string.
    */
    protected function securities(array &$vars): array // should have to replace this function
    {
        $out = array();
        foreach ($vars as $key => $value) {
            $out[] = $this->security($value);
        }
        return $out;
    }
}
