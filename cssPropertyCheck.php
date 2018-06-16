<?php
require_once "phpQuery-onefile.php";

class CPC{
    static $jsonName="cssPropList.json";
    
    static function cssPropCheck($selector,$cssprop){
        CPC::scrapeCSSListToJson();
        
        $error="";
        if(CPC::searchCSSJList($cssprop)){
            return true;
        }else{
            $error="{$selector}におけるCSSプロパティが間違っています。<br>Wrong CSS property in {$selector}.";
            
            return $error;
        }
    }

    static function searchCSSJList($cssprop){
        $fc=strtoupper(substr($cssprop,0,1));//the Upper First Character
        
        $cssSearch=file_get_contents(CPC::$jsonName);
        //$cssSearch=mb_convert_encoding($cssSearch,"UTF8","ASCII,JIS,UTF-8,EUP-JP,SJIS-WIN");
        //$cssSearch=str_replace('&quot;','"',$cssSearch);
        $cssSearch=json_decode($cssSearch,true)[$fc];
        
        if(is_array($cssSearch)){
            if(is_numeric(array_search($cssprop,$cssSearch))){
                return true;
            }
            return false;
        }
        return false;
    }

    static function scrapeCSSListToJson(){
        $cssArrays=array();
        $html=file_get_contents("http://www.tagindex.com/stylesheet/properties/abc.html"); 
        
        $grTitle=phpQuery::newDocument($html)->find(".groupTitle")->text();
        $grTitle=explode("\n",$grTitle);
        $grTitle=array_filter($grTitle);
        
        foreach($grTitle as $title){
            $cssProps=phpQuery::newDocument($html)->find("#group{$title}")->find(".property")->find("a")->text();
            
            $cssProps=explode("\n",$cssProps);
            $cssProps=array_filter($cssProps);
            
            $cssArray=array($title=>$cssProps);
            
            $cssArrays=array_merge($cssArrays,$cssArray);
        }
        
        file_put_contents(CPC::$jsonName,json_encode($cssArrays,JSON_PRETTY_PRINT));
    }
}
?>