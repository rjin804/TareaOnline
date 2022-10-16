<!DOCTYPE html>
<html>
        <head>
            <title>Pedido</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                .rojo{
                    color: red;
                }
                .titulo{
                    text-align: center;
                    color: blueviolet;
                    
                }
                
                .azul{
                    color:blue;
                }
               
            </style>
        </head>
        <body>
        
<?php

$dF = validar();

if($dF['valido']==true)
{
    // proceso datos  
    $importe=0;
    
    if($dF['valores']['tipo']=='p'){
        for($i = 0;$i<$dF['valores']['cantidad'];$i++){
            $importe += 8;
        }
    }
    if($dF['valores']['tipo']=='m'){
        
        for($i = 0;$i<$dF['valores']['cantidad'];$i++){
            $importe += 12;
        }
    }
    if($dF['valores']['tipo']=='f'){
       for($i = 0;$i<$dF['valores']['cantidad'];$i++){
            $importe += 15;
        }
    }
        echo"Nombre: "; 
        echo '<span class="azul">'.$dF['valores']['nombre'].'</span><br/>';
     
        echo "Telefono: " ; 
        echo '<span class="azul">'.$dF['valores']['telefono'].'</span><br/>';
        
       
        echo "Tipo: "; 
        if($dF['valores']['tipo']=="p"){
           echo "Pequeña"; 
        }
            
        if($dF['valores']['tipo']=="m"){
           echo "Mediana"; 
        }
         
        if($dF['valores']['tipo']=="f"){
           echo "Familiar"; 
        }
        echo "Cantidad: ";  
        echo '<span class="azul">'.$dF['valores']['cantidad'].'</span><br/>';
        echo "Importe: "; 
        echo '<span class="azul">'.$importe.'</span><br/>';
        
        echo '<a href="TareaOnline1.php">Volver a hacer pedido</a>';
        
     
   
     
    
}
else
{
    // Muestro formulario
   
    
    ?>
    <form action="TareaOnline1.php" method=post>
                
        <h2 class="titulo">Pizza</h2><br/> <!-- titulo -->
        
        <img class="titulo " src="images/images.jpg" width="100" height="100" alt="images"/></br>

        <label>Nombre:</label><br/>
        <input type="text" name="nombre" value="<?php echo $dF['valores']['nombre'];?>"/><br />
        <?php
        if(isset($dF['errores']['nombre']) && !empty($dF['errores']['nombre']))
        {
            echo '<span class="rojo">'.$dF['errores']['nombre'].'</span><br/>';
        }
        ?> 
        <label>Telefono:</label><br/>
        <input type="text" name="telefono" value="<?php echo $dF['valores']['telefono'];?>"/><br />
        <?php
        if(isset($dF['errores']['telefono']) && !empty($dF['errores']['telefono']))
        {
            echo '<span class="rojo">'.$dF['errores']['telefono'].'</span><br/>';
        }
        ?>
        <label>Tipo de pizza: </label><br/>
        <!<!-- Radio grupo de pizza -->
        <input type="radio" name="tipo"  value="n" checked="checked" /><br/>
        <input type="radio" name="tipo" 
         <?php if(isset($dF['valores']['tipo']) && $dF['valores']['tipo']=="p")     echo 'checked'; ?>      
        value="p" />Pequeña<br/><!-- comment -->
        <input type="radio" name="tipo"
         <?php if(isset($dF['valores']['tipo']) && $dF['valores']['tipo']=="m")     echo 'checked';?>
        value="m" />Mediana<br/><!-- comment -->
        <input type="radio" name="tipo" 
               <?php if(isset($dF['valores']['tipo']) && $dF['valores']['tipo']=="f")     echo 'checked';?>
               value="f" />Familiar<br/><!-- comment -->
        
        <?php if(isset($dF['valores']['tipo']) && $dF['valores']['tipo']=="n") echo '<span class="rojo">'.$dF['errores']['tipo'].'</span><br/>'; ?> 
        
        
        
        <label>Cantidad:</label><br/>
        <input type="text" name="cantidad" value="<?php echo $dF['valores']['cantidad'];?>"/><br /><br/>
        <?php
        if(isset($dF['errores']['cantidad']) && !empty($dF['errores']['cantidad']))
        {
            echo '<span class="rojo">'.$dF['errores']['cantidad'].'</span><br/>';
        }
        ?> 
       <hr>  
        <button type="submit">Realizar pedido</button>
    </form>
    <?php
}
?>

        </body>
    </html>   
    
<?php
function validar()
{
    $dataF=array();
    $dataF['valido'] = true;
    $dataF['errores'] = array();
    
    $dataF['valores'] = array();
    $dataF['valores']['nombre']='';
    $dataF['valores']['telefono']='';
    $dataF['valores']['tipo']='';
    $dataF['valores']['cantidad']='';
    
    
    
    if(!filter_input_array(INPUT_POST))
    {
        $dataF['valido'] = false;
    }
    else
    {
        $dataF['valores']['nombre']=filter_input(INPUT_POST, 'nombre');
        $dataF['valores']['telefono']=filter_input(INPUT_POST, 'telefono');
        $dataF['valores']['tipo']= filter_input(INPUT_POST, 'tipo');
        $dataF['valores']['cantidad']=filter_input(INPUT_POST, 'cantidad');
        
                        
        if(empty($dataF['valores']['nombre']))
        {
            $dataF['valido'] = false;
            $dataF['errores']['nombre']='El campo no puede estar vacío.';
        }else if(!empty ($dataF['valores']['nombre']) && preg_match('/^[a-zA-Z]+$/', $dataF['valores']['nombre'])==0) {
            $dataF['valido'] = false;
            $dataF['errores']['nombre']='El nombre no es válido.';
        }
        
        
        if(empty($dataF['valores']['telefono']))
        {
            $dataF['valido'] = false;
            $dataF['errores']['telefono']='El campo no puede estar vacío.';
        }else if (!empty ($dataF['valores']['telefono']) && preg_match('/[0-9]{9}/', $dataF['valores']['telefono'])==0) {
            $dataF['valido'] = false;
            $dataF['errores']['telefono']='El telefono no es válido.';
        }
        
        if(empty($dataF['valores']['tipo']))
        {
            $dataF['valido'] = false;
            $dataF['errores']['tipo']='El campo no puede estar vacío.';
        }else if (!empty ($dataF['valores']['tipo']) &&  $dataF['valores']['tipo']=="n") {
            $dataF['valido'] = false;
            $dataF['errores']['tipo']='El tipo de piazza no es válido.';
        }
        
        if(empty($dataF['valores']['cantidad']))
        {
            $dataF['valido'] = false;
            $dataF['errores']['cantidad']='El campo no puede estar vacío.';
        }else if (!empty ($dataF['valores']['cantidad']) && preg_match('/^[1-9][0-9]*$/', $dataF['valores']['cantidad'])==0) {
            $dataF['valido'] = false;
            $dataF['errores']['cantidad']='El cantidad no es válido.';
        }
        
        
       
    }
    
    return $dataF;
}

?>

