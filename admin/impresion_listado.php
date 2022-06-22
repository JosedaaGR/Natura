<html>
    <head>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <?PHP
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"impresion_listado_" . date("YmdHis") .".xls\"" );    
        $filas=$_POST['filas'];
        
        $filas=str_replace("<div id=\"dataTableId_wrapper\" class=\"dataTables_wrapper\">","", $filas);
        $filas=str_replace("</div>","", $filas);
        
        $fin_table="</table>";
        $pos_comienzo=strpos($filas, "<table");
        $pos_tfoot_inicio=strpos($filas, "<tfoot>");
        $pos_tfoot_final=strpos($filas, "<tbody>");
        $pos_info=strpos($filas, $fin_table);
        $pos_info=($pos_info+strlen($fin_table))-$pos_tfoot_final;
        
        $cadena1=substr($filas, $pos_comienzo, ($pos_tfoot_inicio-$pos_comienzo));
        $cadena2=substr($filas, $pos_tfoot_final, $pos_info);
        
        $cadena_final=$cadena1."".$cadena2;
        print($cadena_final);      
    ?>
    </body>
</html>
