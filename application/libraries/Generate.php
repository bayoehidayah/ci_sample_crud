<?php
    if(!defined('BASEPATH')) exit('no file allowed');
    class Generate {

        function number($length = 5){
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        function character($type = "all", $length = 10){
            if($type == "all"){
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            }
            else if($type == "big"){
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            else if($type == "small"){
                $characters = 'abcdefghijklmnopqrstuvwxyz';
            }

            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        function numchar($type = 1, $length = 10){
            //All Char
            if($type == 1){
                $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            }
            //Big Number Char
            else if($type == 2){
                $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            //Big Char
            else if($type == 3){
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            //Small Number Char
            else if($type == 4){
                $characters = '1234567890abcdefghijklmnopqrstuvwxyz';
            }
            //Small Char
            else if($type == 5){
                $characters = 'abcdefghijklmnopqrstuvwxyz';
            }
            //Small Big Char
            else if($type == 6){
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            }

            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $char = $characters[rand(0, strlen($characters) - 1)];
                $randomString .= $char;
            }
            return $randomString;
        }

        function token($length = 10){
            $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

            $randomString = 'Elearning-';
            for ($i = 0; $i < $length; $i++) {
                $char = $characters[rand(0, strlen($characters) - 1)];
                $randomString .= $char;
            }

            return $randomString;
        }
    }
?>