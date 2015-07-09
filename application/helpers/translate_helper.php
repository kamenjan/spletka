<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function translate($string) {

    switch ($string) {
        case 'news':
            return 'Novica';
        case 'report':
            return 'Reportaža';
        case 'article':
            return 'Članek';
        case 'international':
            return 'International';
        case 'announcement':
            return 'Obvestilo';
        case 'active':
            return 'Aktivna';
        case 'ready':
            return 'Pripravljena';
        case 'finished':
            return 'Zaključena';
    }
}
