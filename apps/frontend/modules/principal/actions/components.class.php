<?php

class principalComponents extends sfComponents {

    public function executeMenu() {
        $this->opciones = Doctrine_Core::getTable('menu')->findAll();
    }

}

?>

