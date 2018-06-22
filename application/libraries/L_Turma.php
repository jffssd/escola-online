<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class L_Turma {

    public function format_alias($turma){
        $reg = (string)$turma->turno;
        $reg .= (string)$turma->ciclo;
        $reg .= (string)$turma->serie;
        $reg .= '1';
        $reg .= (string)$turma->codigo;
    return $reg;
    }

    public function arrayToObject($array){
        foreach( $array as $key => $value ){
          if(is_array($value))$array[$key] = $this->arrayToObject($value);
        }
        return (object) $array;
    }
}