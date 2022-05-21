<?php

namespace dellapenna\restful\examples;

class ElementiResource {

    public function getCollection($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\ElementiResource::getCollection called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = Utils::createRandomFattura($args["anno"], $args["numero"]);
        return $response->withJson($fattura["elementi"]);
    }

    public function getItem($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\ElementiResource::getItem called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = Utils::createRandomFattura($args["anno"], $args["numero"]);
        if ($args["riga"] >= 1 && $args["riga"] <= count($fattura["elementi"])) {
            return $response->withJson($fattura["elementi"][$args["riga"] - 1]);
        } else {
            return $response->withStatus(404);
        }
    }
}
