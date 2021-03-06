<?php 

if (isset($_GET['producto']) || (isset($_GET['mode']) && ($_GET['mode'] == 'ver' || $_GET['mode'] == 'vaciar' ))){

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
			$db = new Conexion();
			/**
			 * Verifica si no hay un usuario logeado en la página.
			 */
			if (!isset($_SESSION['app_id'])) {
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto,
						cantidad 
					FROM 
						carrito 
					WHERE 
						id_usuario = '$_SESSION[carrito]' AND id_producto = '$_GET[producto]'
					ORDER BY
						id DESC;");
				$existe 	= $db->rows($sql);
				$cantidad 	= $existe > 0 ? intval($db->recorrer($sql)[3]) : 0;
				$inventario	= $_productos[$_GET['producto']]['cantidad'];
				if ($cantidad > 0) {
					if ($cantidad < $inventario) {
						$db->query("
						UPDATE
							carrito
						SET
							cantidad = $cantidad + 1
						WHERE
							id_usuario = '$_SESSION[carrito]' AND id_producto = '$_GET[producto]';");
						header('Location:'. $_SERVER['HTTP_REFERER']);
					} else {
						header('Location:'. $_SERVER['HTTP_REFERER']);
					}
				} else {
					$db->query(
					"INSERT INTO
							carrito (id_usuario,id_producto,cantidad)
						VALUES 
							('$_SESSION[carrito]','$_GET[producto]',1);
					");
					header('Location:'. $_SERVER['HTTP_REFERER']);
				}
			} else if($_users[$_SESSION['app_id']]['permisos'] != 2){
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto,
						cantidad 
					FROM 
						carrito 
					WHERE 
						(id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]') AND id_producto = '$_GET[producto]'
					ORDER BY
						id DESC;");
				$existe 	= $db->rows($sql);
				$cantidad 	= $existe > 0 ? intval($db->recorrer($sql)[3]) : 0; 
				
				if ($cantidad > 0) {
					$db->query("
					UPDATE
						carrito
					SET
						cantidad = $cantidad + 1
					WHERE
						(id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]') AND id_producto = '$_GET[producto]';");
					header('Location:'. $_SERVER['HTTP_REFERER']);
				} else {
					$db->query(
					"INSERT INTO
							carrito (id_usuario,id_producto,cantidad)
						VALUES 
							('$_SESSION[app_id]','$_GET[producto]',1);
					");
					header('Location:'. $_SERVER['HTTP_REFERER']);
				}
			} else {
				$db->query("
					DELETE FROM
						carrito
					WHERE
						id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]';");
				header('Location:'. $_SERVER['HTTP_REFERER']);
			}
			$db->liberar($sql);
			$db->close();
		break;
		case 'ver':
			include(HTML_DIR . 'carrito/carrito.php');			
		break;
		case 'delete':
			$db = new Conexion();
			$db->query(
				"DELETE FROM
					carrito
				WHERE
					id = '$_GET[producto]'
				;");
			header('Location:'. $_SERVER['HTTP_REFERER']);
			$db->close();
		break;
		case 'vaciar':
			$db = new Conexion();
			$db->query(
				"DELETE FROM
					carrito
				WHERE
					id_usuario = '$_GET[usuario]'
				;");
			header('Location:'. $_SERVER['HTTP_REFERER']);
			$db->close();
		break;		
		default:					
			include(HTML_DIR . 'carrito/carrito.php');
		break;
	}
} else{
	header('location: home/');
}
?>