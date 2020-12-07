<?php
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

if ( is_session_started() === FALSE ) session_start();

if(isset($_POST["addCart"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){
   $size_price=$_POST["sizeSelection"];
        $stopPos=strpos($size_price,"$");
        $sizeName=substr($size_price,0,$stopPos-1);
        $priceCor=substr($size_price,$stopPos);
   
    if(isset($_SESSION["cart"])){
        $added=false;
        $item_array_name=array_column($_SESSION["cart"],"productName");
        if(in_array($_POST["pname"],$item_array_name)){
                
            
            foreach($_SESSION["cart"] as $x=>&$item){
                
                foreach($item as $info=>&$infoDetail){
                        if($infoDetail==$_POST["pname"]){
                            $sameFood=$_SESSION["cart"][$x];
                            foreach($sameFood as $key=>&$value){
                                $numIncrease=false;
                                if($value==$sizeName){
                                   $numIncrease=true;
                                    $added=true;
                             $_SESSION["cart"][$x]["productNum"]+=1;      
                                    
                                }
                            }
                            
                        }
                    }
                }
            if($numIncrease==false&&$added==false){
                                $count=count($_SESSION["cart"]);
                                $itemnum=1;
                                $item_array=array(
                                    'productName'=>$_POST['pname'],
                                    'productPrice'=>$priceCor,
                                    'productSize'=>$sizeName,
                                    'productNum'=>1
                                    );
                                $_SESSION["cart"][$count]=$item_array;
                            }
            
        }else{
            $count=count($_SESSION["cart"]);
            
            $item_array=array(
            'productName'=>$_POST['pname'],
            'productPrice'=>$priceCor,
            'productSize'=>$sizeName,
            'productNum'=>1
            );
            $_SESSION["cart"][$count]=$item_array;
        }
    }else{
    $itemnum=1;    
    
        $item_array=array(
        'productName'=>$_POST['pname'],
        'productPrice'=>$priceCor,
        'productSize'=>$sizeName,
        'productNum'=>1
        
        );
        $_SESSION["cart"][0]=$item_array;
    }
    header('Location: catering_main.php');
}
?>