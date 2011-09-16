<?php
class DBConnection {
    
    private $connection;
    private $db_selected;
    
    public function __construct() {
        
        $host = 'localhost';
        $username = 'k4213_test';
        $password = 'secret :P';
        $database = 'k4213_test';
        
        $connection = mysql_connect( $host, $username, $password );
        
        if( !$connection ) {
            
            die( 'Could not connect: ' . mysql_error() );
            
        }
        
        $db_selected = mysql_select_db( $database, $connection );
        
        if( !$db_selected ) {
            
            die( 'Could not select db: ' . mysql_error() );
            
        }
        
    }
    
    public function query( $query ) {
       
       return mysql_query( $query );
       
   }
       
    public function queryWithDebug( $query ) {
       
       echo $query;
       return mysql_query( $query );
       
   }
       
    public function __destruct() {
    	
        mysql_close( $connection );
        
    }
    
}
?>