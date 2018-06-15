<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class L_Calendario {
    
    public function GetNumeroDias($mes){
	
        $numero_dias = array( 
                '01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
                '07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
        );
     
        if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0){
            
            $numero_dias['02'] = 29;
        }
         return $numero_dias[$mes];
    }
     
    public function GerarDiasMes($mes){
     
        $numero_dias = $this->GetNumeroDias($mes);
        $diacorrente = 0;
        $my_first_array = array();
     
        $diasemana = jddayofweek( cal_to_jd(CAL_GREGORIAN, $mes,"01",date('Y')) , 0 );
     
        for( $linha = 0; $linha < 6; $linha++ ){
      
            for( $coluna = 0; $coluna < 7; $coluna++ ){
                
                if( $diacorrente + 1 <= $numero_dias ){
                    if( $coluna < $diasemana && $linha == 0){

                    }else{
                        ++$diacorrente;
                        array_push($my_first_array, date('Y').'-'.$mes.'-'.(($diacorrente < 10) ? '0'.$diacorrente : $diacorrente));
                    }
                }else{
                    break;
                }
            }
        }
        return $my_first_array;
    }
     
    public function gerar_datas_calend(){
            
        $my_third_array = array();
        $cont = 1;
        for( $j = 0; $j < 4; $j++ ){
            for( $i = 0; $i < 3; $i++ ){
                $my_second_array = ($this->GerarDiasMes(($cont < 10 ) ? "0".$cont : $cont));  
                foreach($my_second_array as $msa){
                    array_push($my_third_array, $msa);
                }
                $cont++;
            }
        }
        return $my_third_array;
    }
}