Ecco come "replicare" questo esempio
------------------------------------

1) Installare Composer (https://getcomposer.org/)

2) Creare una directory per il proprio progetto ed entrare nella directory.

3) Creare la directory /log

4) Creare la directory /public e, al suo interno, creare o copiare i file 
index.php e .htaccess

5) Creare la directory /src e, al suo interno, creare o copiare i file della
logica del servizio e della configurazione di slim

6) Creare il file composer.json con una configurazione simile a quella di questo 
esempio. E' possibile anche usare il comando "composer init" per creare in 
automatico gran parte del file, avendo cura di specificare come requirement 
i package "slim/slim" e "monolog/monolog". 

7) Lanciare il comando "composer install". Questo scaricherà e installerà tutte 
le dipendenze nella directory vendor/. In seguito si potrà
usare il comando "composer update" per aggiornarle.

8) L'entry point (da cui sono valide le url specificate da src/slim_routes.php) è
<directory del progetto>/public/

Nota: se utilizzate un browser per "provare" le url, commentate in
Fattura_Server_Interface.php le righe che effettuano controlli sul tipo (header
Accept), altrimenti nessuna delle richieste inviate tramite browser verr� servita 
(il browser non richiede mai dati json)
