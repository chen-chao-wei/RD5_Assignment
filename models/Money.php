<?php
    class Money extends DB{
        function deposit($userName,$tableName,$fieldName,$amount){
            $sql = <<<block
            UPDATE $tableName SET $fieldName=$amount  WHERE account='$userName';
            block;
            //$this->update($sql);
            return $sql;
        }
    }
?>