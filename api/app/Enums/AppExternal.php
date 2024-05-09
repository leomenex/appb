<?php

namespace App\Enums;

enum AppExternal
{
    case PORTAL_PMBV;
    case CEDULA_C;
    case SAATRI;

    function getBaseURL(){
        return match($this){
            self::PORTAL_PMBV => 'https://boavista.rr.gov.br',
            self::CEDULA_C => 'https://boavista.rr.gov.br',
            self::SAATRI => 'https://boavista.rr.gov.br'
        };
    }
}
