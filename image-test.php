<?php
require_once('PHPClasses/DBConnection.php');
require_once('PHPClasses/Browscap.php');

$oDBConnection = new DBConnection();

if( isset( $_GET['i'] ) ) {
    
    $oBrowscap = new Browscap('cache');
    
    $aBrowcapData = $oBrowscap->getBrowser();
    
    $oDBConnection->query("INSERT INTO `image-test` VALUES( '', '" . implode( "', '", get_object_vars( $aBrowcapData ) ) . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . microtime(true) . "', '" . intval( $_GET['i'] ) . "' )");
    
    header('Content-type: image/gif');
    sleep(4);
    echo file_get_contents('http://www.sunnykidsplay.com/kidscode/smiley.gif');
    
} else {
    
    $query = $oDBConnection->query(
            "SELECT CONCAT( Parent, '/', Platform ) browser, filename, date FROM `image-test` ORDER BY date ASC"
        );
    
    $array = array();
    
    while( $row = mysql_fetch_assoc( $query ) ):
        
        $array[ $row['browser'] ][ $row['filename'] ] = $row['date'];
        
    endwhile;
    
}
?>
<table style="border: 2px;">
    
    <?php foreach( $array as $key => &$value ): ?>
        
        <?php asort( $value ); ?>
        <tr>
            
            <td style="border: 1px;"><?= $key ?></td>
            
            <?php foreach( $value as $key2 => &$value2 ): ?>
                
                <td><?= $key2 ?></td>
                
            <?php endforeach; ?>
        </tr>
        
    <?php endforeach; ?>
    
</table>

<?php
$str = <<<EOD
<img style="display: none;" src="http://test.kaffesump.kodingen.com/image-test.php?i=5" />
<img style="display: none;" src="http://test.kaffesump.kodingen.com/image-test.php?i=6" />
<img style="display: none;" src="http://test.kaffesump.kodingen.com/image-test.php?i=7" />
<img style="display: none;" src="http://test.kaffesump.kodingen.com/image-test.php?i=8" />
<img src="http://test.kaffesump.kodingen.com/image-test.php?i=1" />
<img src="http://test.kaffesump.kodingen.com/image-test.php?i=2" />
<img src="http://test.kaffesump.kodingen.com/image-test.php?i=3" />
<img src="http://test.kaffesump.kodingen.com/image-test.php?i=4" />
EOD;
?>

<h3>Html run:</h3>
<pre>
    <?= htmlentities( $str ) ?>
</pre>

<?= $str ?>