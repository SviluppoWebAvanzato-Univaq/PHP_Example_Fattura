<?php

namespace dellapenna\restful\examples;

class Utils {
    
   

    public static function checkAccept($request, $type = 'application/json') {
        if (!$request->hasHeader('Accept'))
            return true;
        $header = $request->getHeader('Accept');
        if (is_array($header))
            $header = implode(", ", $header); //to handle multiple headers
        return (strpos($header, $type) !== false);
    }

    public static function checkContentType($request, $type = 'application/json') {
        $header = $request->getContentType();
        if (is_array($header))
            $header = implode(", ", $header); //to handle multiple headers
        return (strpos($header, $type) !== false);
    }

    ////////////

     public static function createRandomFattura($anno, $numero) {
        $fattura["numero"] = $numero;
        $fattura["data"] = date("d/m/$anno");

        $fattura["intestatario"] = array();
        $fattura["intestatario"]["ragioneSociale"] = "Pippo";
        $fattura["intestatario"]["partitaIVA"] = "123456789";
        $fattura["intestatario"]["citta"] = "Roma";

        $fattura["elementi"] = array();
        for ($i = 0; $i < 1; ++$i) {
            $prodotto = array();
            $prodotto["codice"] = "P" . $fattura["numero"] . "-" . $i;
            $prodotto["descrizione"] = "Prodotto " . $prodotto["codice"];
            $prodotto["quantita"] = 1;
            $prodotto["unita"] = "N";
            $prodotto["prezzoUnitario"] = 10 * $i;
            $prodotto["prezzoTotale"] = 10 * $i;
            $prodotto["iva"] = 22;
            $fattura["elementi"][] = $prodotto;
        }

        $fattura["totaleIVAEsclusa"] = 0;
        $fattura["totaleIVA"] = 0;
        $fattura["totaleIVAInclusa"] = 0;

        return $fattura;
    }

}
