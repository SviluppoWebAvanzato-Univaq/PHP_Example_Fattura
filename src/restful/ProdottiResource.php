<?php

namespace dellapenna\restful\examples;

class ProdottiResource {

    public function getFattureForProdotto($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\ProdottiResource::getFattureForProdotto called");
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

}
