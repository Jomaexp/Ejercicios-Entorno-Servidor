<?php
			
			/* Esta función genera un Array compuesto por los valores
			decrecientes de 3 en tres hasta 0 tomando como valor inicial
			el introducido por argumento y, finalmente, devuelve el array.
			*/
			
			function generarArray($valor){ //espera un entero positivo
				$valores = array();
				if($valor>=0){	//si el valor dado es positivo si hace algo
					$cont=$valor;
					for($index=0 ; $cont>=0 ; $index++){
							$valores[$index] = $cont;
							$cont-=3;
						}
					return $valores;
				}else{	//si el valor dado fue negativo el array estará vacío
					return $valores;
				}

			}
				
			/* Esta función toma como argumento un array
				para formar una tabla html con los mismos.
			*/
			
			function tabla($valores){ //espera un array
				echo "<table>";
				echo "<caption>Valores del array</caption>";
				echo "<tr>";
				for($i=0; $i<sizeof($valores);$i++){
					echo "<td> Valor ".$i."</td>";
				}
				echo "</tr><tr>";
				for($i=0; $i<sizeof($valores);$i++){
					echo "<td>".$valores[$i]."</td>";
				}
				echo "</tr></table>";
			}
			/* Ahora ponemos las condiciones de comportamiento
			según el tipo y el valor de la información recibida
			del input "valor" proveniente de un formulario*/
			
			// Primero comprobamos si la variable recibida contiene algún valor.
			if (!isset($_POST["valor"])) echo "<h2>No se ha introducido ningún valor</h2>";
			
			/* Después, si contiene algún valor, preguntamos si está vacía y no es numérica
			   Si no preguntamos si no es numérica comprenderá el "0" como valor vacío.*/
			else if(empty($_POST["valor"]) && !is_numeric($_POST["valor"])) echo "<h2>Introduzca un valor</h2>";
				
			/* Después, si la variable es numérica se va a asignar su valor a una variable
			   $entero y se va a dar un resultado con switch dependiendo de su valor.*/ 
			else if(is_numeric($_POST["valor"])){
				$entero = (int)$_POST["valor"];
				switch (true){
					case ($entero < 0):
						echo "<h2>Introduzca un valor positivo</h2>";
						break;
					case ($entero>=0 && $entero<=10):  
						tabla(generarArray($entero));
						break;
					case ($entero>10):
						echo "<h2>Número demasiado grande</h2>";
						break;
					default :
						echo "<h2>Valor desconocido</h2>"; 
						break;
				}
			}	
			// Si la variable no es numérica se informará por pantalla.
			else  echo "<h2>Introduzca un valor numérico</h2>";
				
?>	