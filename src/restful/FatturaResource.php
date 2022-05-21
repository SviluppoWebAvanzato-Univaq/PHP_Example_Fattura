<?php

namespace dellapenna\restful\examples;

class FatturaResource {

    public function getItem($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FatturaResource::getItem called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = Utils::createRandomFattura($args["anno"], $args["numero"]);
        return $response->withHeader("X-fattura-app-version", "1.0")->withJson($fattura);
    }

    public function getItemPIva($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FatturaResource::getItemPIva called");
        //
        if (!\dellapenna\restful\examples\Utils::checkAccept($request)) {
            $app->getContainer()->get('logger')->error("Accepted format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = Utils::createRandomFattura($args["anno"], $args["numero"]);
        return $response->withJson($fattura["intestatario"]["partitaIVA"]);
    }

    public function updateItem($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FatturaResource::updateItem called");
        //
        if (!\dellapenna\restful\examples\Utils::checkContentType($request)) {
            $app->getContainer()->get('logger')->error("Payload format(s) mismatch");
            return $response->withStatus(415);
        }
        //
        $fattura = $request->getParsedBody();
        if (!empty($fattura) && $args["numero"] > 0) {
            if (true /* ...perform update... */) {
                return $response->withStatus(204);
            } else {
                return $response->withStatus(500)->write("Cannot update entry");
            }
        } else {
            return $response->withStatus(500)->write("Error updating entry: invalid payload");
        }
    }

    public function deleteItem($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FatturaResource::deleteItem called");
        //
        if ($args["numero"] > 0 && true /* ..perform delete... */) {
            return $response->withStatus(204);
        } else {
            return $response->withStatus(500)->write("Cannot delete entry");
        }
    }

    public function getAttachment($request, $response, $args) {
        global $app;
        $app->getContainer()->get('logger')->info("\\dellapenna\\restful\\examples\\FatturaResource::getAttachment called");
        //        
        $fh = fopen('.htaccess', 'rb');
        $stream = new \Slim\Http\Stream($fh);
        return $response->withHeader('Content-Type', 'application/pdf')
                        ->withHeader('Content-Disposition', 'attachment; filename="fattura.pdf"')
                        ->withHeader('Expires', '0')
                        ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                        ->withHeader('Pragma', 'public')
                        ->withBody($stream);
    }

}
