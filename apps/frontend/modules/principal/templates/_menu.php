<?php foreach ($opciones as $opcion): ?>
    <li><?php echo $opcion->getNombre() ?></li>    
        <?php $marcas = $opcion->getMenuMarca(); ?>
        <?php  if (isset($marcas[0])): ?>
        <ul>
            <?php foreach ($marcas as $marca): ?>
                <li><?php echo $marca->getMarca() ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endforeach ?>
