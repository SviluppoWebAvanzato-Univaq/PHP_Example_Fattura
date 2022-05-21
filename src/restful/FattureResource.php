<?php

namespace dellapenna\restful\examples;

class FattureResource {

    public function getCollection($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FattureResource::getCollection called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $pIVA = $request->getQueryParam('partitaIVA');
        $from = $request->getQueryParam('from');
        $to = $request->getQueryParam('to');

        if ($from == null) {
            $from = 1;
        }
        if ($to == null) {
            $to = 7; //per esempio
        }
        if ($from > $to) { //per sicurezza
            $swap = $from;
            $from = $to;
            $to = $swap;
        }

        $l = [];
        for ($i = $from; $i <= $to; ++$i) {
            $uri = $app->getContainer()->get('router')->pathFor('getJSON', ['anno' => 2020, 'numero' => $i]);

            $e = [
                "numero" => 1,
                "totaleIVAInclusa" => 100.25,
                "url" => $uri,
                "data" => date("d/m/Y"),                
            ];
            $l[] = $e;
        }

        return $response->withJson($l);
    }

    public function getCollectionByYear($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FattureResource::getCollectionByYear called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $l = array();
        for ($i = 1; $i <= 3; ++$i) {
            $l[] = $app->getContainer()->get('router')->pathFor('getJSON', ['anno' => 2020, 'numero' => $i]);
        }
        return $response->withJson($l);
    }

    public function getCollectionSize($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FattureResource::getCollectionSize called");
        //
        $pIVA = $request->getQueryParam('partitaIVA');
        if ($pIVA != null) {
            $response->getBody()->write(3);
        } else {
            $response->getBody()->write(12);
        }
        return $response;
    }

    public function addItem($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FattureResource::addItem called");
        //
        if (!\dellapenna\restful\examples\Utils::checkContentType($request)) {
            $app->getContainer()->get('logger')->error("Payload format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = $request->getParsedBody();
        /* ...perform insert... */
        $anno = explode("/", $fattura['data'])[2];
        return $response->withHeader("Location", $app->getContainer()->get('router')->pathFor('getJSON', ['anno' => $anno, 'numero' => $fattura['numero']]))->withStatus(201);
    }

}
