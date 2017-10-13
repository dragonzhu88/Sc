<?php
 while (1) {
            echo "图片地址\n";
            $num = trim(fgets(STDIN));
            system("axel $num");
        }  
