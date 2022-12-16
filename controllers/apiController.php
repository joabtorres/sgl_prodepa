<?php

class apiController extends controller
{
        public function getAp()
        {
        }

        public function get_search_tipo_documento()
        {
                header('Content-Type: text/html; charset=utf-8');
                if (isset($_POST) && is_array($_POST) && !empty($_POST)) {
                        $ap = new ap();
                        $usuarios = $ap->read("SELECT * FROM fisc_tipo_documento WHERE protocolo_id=:id ORDER BY documento ASC", array('id' => $protocolo_id));
                        if (!isset($user_id)) {
                                echo '<option value="" selected = "selected" >Todos </option>';
                        }
                        foreach ($usuarios as $indice) {
                                if (isset($user_id) && $indice['id'] == $user_id) {
                                        echo '<option value = "' . $indice['id'] . '" selected = "selected">' . $indice['documento'] . '</option>';
                                } else {
                                        echo '<option value = "' . $indice['id'] . '">' . $indice['documento'] . '</option>';
                                }
                        }
                }
        }
}
