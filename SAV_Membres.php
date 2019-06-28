#!/usr/local/bin/php
<?php
try
			{
    			$db = new PDO('mysql:host=mysql5-22.90;dbname=studiogpvc1', 'studiogpvc1', 'FpgTxyF8xY');
				/*$db = new PDO('mysql:host=localhost;dbname=studiogpvc1', 'root', '');*/
				$db->exec('SET NAMES utf8');
			}
			catch(Exception $e)
			{
									
                                      
                                        mail("michel.riou@gerard-pasquier.fr","Erreur de sauvegarde","Erreur de connexion à la BD \n","From: admin@ventesclery.fr");
        		die();
			}
												   $result= $db->prepare('SELECT * FROM membres ORDER BY NOM');
                                                   $result->execute();
												   $result2= $db->prepare('SELECT * FROM visite');
                                                   $result2->execute();			
												   $result3= $db->prepare('SELECT * FROM membressuppr');
                                                   $result3->execute();
if ($result) {
$n=date("D");
$d=dirname(__FILE__);
$nom=$d."/SAV/".$n."-MEMBRES.txt";
$fichier=fopen($nom,"w");
while ($data = $result->fetch())
		{
		$str=$data['id_membre'].";".$data['nom'].";".$data['prenom'].";".$data['politesse'].";".$data['adresse1'].";".$data['adresse2'].";".$data['adresse3'].";".$data['code_postal'].";".$data['ville'].";".$data['pays'].";".$data['taille'].";".$data['email'].";".$data['sms'].";".$data['time_creation'].";".$data['date_creation'].";".$data['date_validation'].";".$data['validation'].";".$data['date_suppression'].";".$data['suppression']."\r\n";      
    
		$writ=fwrite($fichier,$str);
		}
		
		fclose($fichier);
}

if ($result2) {
$n=date("D");
$d=dirname(__FILE__);
$nom=$d."/SAV/".$n."-VISITE.txt";
$fichier=fopen($nom,"w");
while ($data = $result2->fetch())
		{
		$str=$data['id_visite'].";".$data['date_visite']."\r\n";      
    
		$writ=fwrite($fichier,$str);
		}
		
		fclose($fichier);
}
?>
