<?php

/**
 * FriendOfMysql.
 * PHP Version =>7.4.
 *
 * @see https://github.com/yolfry/FriendOfMysql/ The FriendOfMysql GitHub project
 *
 * @author    yolfry (ypw) <yolfri1997@hotmail.com>
 * @copyright 2015 - 2021 yolfry
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */



/*
 * QueryApp structure
 * */

/*
* Input variables that the query block receives:
*
* $cmd           Command to select the query on the switch
* $connection    Object variable, which contains the structure of the connection
* $data          Array containing the data to send by the query
*/


/*
*   @param string $cmd Query block name
*/


try {
    switch ($cmd) {


        case 'generarContacto':


            $sql = "INSERT INTO contacto
            (logo, nombre, direccion, email, numero, numero2, numero3, numero4, info, color, redesSociales, web, share)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";

            if (!($sentencia = $connection->prepare($sql))) {
                throw new Exception("Preparation failed: (" . $connection->errno . ") " . $connection->error);
            }


            if (!$sentencia->bind_param("sssssssssssss", $data['logo'], $data['nombre'], $data['direccion'], $data['email'], $data['numero'], $data['numero2'], $data['numero3'], $data['numero4'], $data['info'], $data['color'], $data['redesSociales'], $data['web'], $data['share'])) {
                throw new Exception("Parameter binding failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }


            if (!$sentencia->execute()) {
                throw new Exception("Execution failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }

            $sentencia->close();

            $this->res = true;
            break;


        case 'share':

            $id = $data['share'];
            $sql = "SELECT * FROM `contacto` where share=(?) ";

            if (!($sentencia = $connection->prepare($sql))) {
                throw new Exception("Preparation failed: (" . $connection->errno . ") " . $connection->error);
            }

            if (!$sentencia->bind_param("s", $data['share'])) {
                throw new Exception("Parameter binding failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }


            if (!$sentencia->execute()) {
                throw new Exception("Execution failed: (" . $sentencia->errno . ") " . $sentencia->error);
            }

            $datos = $sentencia->get_result();

            $field = $datos->fetch_array(MYSQLI_BOTH);


            //share

            $table['idContacto'] = strip_tags($field['idContacto']);
            $table['logo'] = strip_tags($field['logo']);
            $table['nombre'] = strip_tags($field['nombre']);
            $table['direccion'] = strip_tags($field['direccion']);
            $table['email'] = strip_tags($field['email']);
            $table['numero'] = strip_tags($field['numero']);
            $table['numero2'] = strip_tags($field['numero2']);
            $table['numero3'] = strip_tags($field['numero3']);
            $table['numero4'] = strip_tags($field['numero4']);
            $table['info'] = strip_tags($field['info']);
            $table['color'] = strip_tags($field['color']);
            $table['redesSociales'] = strip_tags($field['redesSociales']);
            $table['web'] = strip_tags($field['web']);
            $table['share'] = strip_tags($field['share']);


            $sentencia->close();

            if (!$table['idContacto']) {
                throw new Error('No Contacto');
            }

            $this->res = $table; /*return parameter*/

            break;
    }
} catch (\Throwable $e) {
    $this->res = false;
}
