<?php

/**
 * Charge les classes nécessaires au bon fonctionnement du script
 * @param $classname | le nom de la classe requise
 */
function autoload($classname) {
    require $classname.'.php';
}

spl_autoload_register('autoload');