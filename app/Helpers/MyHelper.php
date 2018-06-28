<?php
 
if (! function_exists('special_ucwords')) {
    function special_ucwords($string){
        $words = explode(' ', strtolower(trim(preg_replace("/\s+/", ' ', $string))));
        $return[] = ucfirst($words[0]);
 
        unset($words[0]);
 
        foreach ($words as $word){
            if (!preg_match("/^([dn]?[aeiou][s]?|em)$/i", $word)){
                $word = ucfirst($word);
            }
            $return[] = $word;
        }
        return implode(' ', $return);
    }
}

if(! function_exists('maskCPFCNPJ')){
    function maskCPFCNPJ($val){
        if(strlen($val) <= 11){
            $mask = '###.###.###-##';
            $val = str_pad($val,'11','0',STR_PAD_LEFT);
        }else{
            $mask = '##.###.###/####-##';
            $val = str_pad($val,'13','0',STR_PAD_LEFT);
        }

        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }else{
                if(isset($mask[$i]))
    
                $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
}