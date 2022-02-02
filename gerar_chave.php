<?php 

class ChaveCriptografia
{

    public function gerarchave()
    {
        $valores = array(
            'io?aY', 'G78j', 'XA@0oa', '1&HAB', 'ZC%ga', 'Dp9$',
            'Hga7&', 'mV66#', 'Kla019D!', 'jsweiU1/', 'Xjz.q8*x',
            'i1?aY', 'G78j', 'XA@0oa', '1&H%AB', 'ZC%ga', 'DUp9$',
            'Hg7&', 'mV66#', 'Kla@01b9D!', 'jseiU1/', 'XjzqgZ8*x+',
            'i6?aY', 'G7%dj', 'XA@0oa', '1%%&HAB', 'ZC%ga', 'D}p9$',
            'Hga4&', 'mVw6#', 'Kla*19D!', 'js><eiU1/', 'Xj!q8*x'
        );

        $selecionados = array_rand($valores, 5);

        $resultado = "";
        foreach($selecionados as $selec) {
            $resultado .= $valores[$selec];
        }

        return $resultado;
    }

}