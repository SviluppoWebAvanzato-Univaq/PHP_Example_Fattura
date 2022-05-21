<?php

use dellapenna\restful\examples\FatturaResource;
use dellapenna\restful\examples\FattureResource;
use dellapenna\restful\examples\ElementiResource;
use dellapenna\restful\examples\ProdottiResource;

$app->group('/rest', function () {
    $this->group('/fatture', function () {
        $this->get('', FattureResource::class . ':getCollection');
        $this->post('', FattureResource::class . ':addItem');
        $this->get('/count', FattureResource::class . ':getCollectionSize');
        $this->group('/{anno: [1-9][0-9][0-9][0-9]}', function () {
            $this->get('', FattureResource::class . ':getCollectionByYear');
            $this->group('/{numero: [a-z0-9]+}', function () {
                $this->get('', FatturaResource::class . ':getItem')->setName('getJSON'); //setName per usare pathFor
                $this->get('pIVA', FatturaResource::class . ':getItemPIva'); //setName per usare pathFor
                $this->delete('', FatturaResource::class . ':deleteItem');
                $this->put('', FatturaResource::class . ':updateItem');
                $this->get('/attachment', FatturaResource::class . ':getAttachment');
                $this->group('/elementi', function () {
                    $this->get('', ElementiResource::class . ':getCollection');
                    $this->group('/{riga: [0-9]+}', function () {
                        $this->get('', ElementiResource::class . ':getItem');
                    });
                });
            });
        });
    });
    $this->group('/prodotti', function () {
        $this->get('/{codice: [a-z0-9]+}/fatture', ProdottiResource::class . ':getFattureForProdotto');
    });
});
