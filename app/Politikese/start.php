<?php

/**
 * Define User constants
 */

define('LANG', Session::get('LANG', app('Politikese')->system('language')));

/**
 * SetLocale on run-time
 */

setlocale(LC_ALL, 'it_IT');