<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
    <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

    <?php include(HTML_DIR . 'overall/topnav.php'); ?>

    <section class="cart_items">
        <div class="container">
            <?php
                if(isset($_GET['success'])) {
                    echo '<div class="alert alert-dismissible alert-success">
                    <strong>Activado!</strong> tu usuario ha sido activado correctamente.
                    </div>';
                }

                if(isset($_GET['error'])) {
                    echo '<div class="alert alert-dismissible alert-danger">
                    <strong>Error!</strong></strong> no se ha podido activar tu usuario.
                    </div>';
                }
            ?>
            <div class="row container col-sm-12">                
                <div class="pull-right">
                    <div>
                        <ul class="mbr-navbar__items mbr-buttons--active">
                        	<li>
                                <a class="btn btn-default active" data-toggle="modal" href="?view=categorias">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-toggle="modal" href="?view=categorias&mode=add">
                                    Crear
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb">
                  <li><a href="home/"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="#"><i class="fa fa-folder-open-o"></i>Categorías</a></li>
                </ol>
            </div>
			
			<div class="row cart_info col-sm-12">
				<div class="table-responsive cart_info">
				  <div class="titulo_categoria">Gestión de Categorías</div>
				  	<div class="cajas">
		                <?php
				           	if(false != $_categorias) {
					            $HTML = '
					            	<table class="table table-condensed">
					            		<thead>
					            			<tr>
					            				<th style="width: 70%">
					            					Nombre de categoría
					            				</th>
					            				<th style="width: 20%; text-align: center;" colspan="2">
					            					Acciones
					            				</th>
					            			</tr>
					            		</thead>				     
					     	       		<tbody>';
				             				foreach ($_categorias as $id_categoria => $categoria_array) {
				             					$cate = htmlentities($_categorias[$id_categoria]['nombre'],ENT_QUOTES | ENT_HTML5, "UTF-8");
				             				 	$HTML .= 
				                 				'<tr>
				                   					<td>'.
				                   						strtoupper(substr($cate,0,1)).
				                   						strtolower(substr($cate,1)).
				                   					'</td>
				                   					<td>
				                   						<a class="btn btn-default" href="?view=categorias&mode=edit&id='.$_categorias[$id_categoria]['id'].'">
					                                        <i class="fa fa-edit" title="Editar"> Editar</i>
					                                    </a>
				                   					</td>
				                   					<td>
					                                    <a class="btn btn-default" onclick="DeleteItem(\'¿Está seguro de eliminar esta categoría?\',\'?view=categorias&mode=delete&id='.$_categorias[$id_categoria]['id'].'\')"><i class="fa fa-times" title="Eliminar"> Eliminar</i>
					                                    </a>
					                                </td>
								                </tr>';
								            }
								            $HTML .= 
								        '</tbody>
								    </table>'
								;
							} else {
								$HTML = 
									'<div class="alert alert-dismissible alert-info">
										<strong>INFORMACIÓN: </strong> Todavía no existe ninguna categoría.
									</div>'
								;
							}
							echo $HTML;
				           	?>
	            	</div>
	        	</div>
	        </div>

		</div>
	</section>

    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>