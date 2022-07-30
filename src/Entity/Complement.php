<?php

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    
    normalizationContext: ["groups" => ['group:catalogue']],
    collectionOperations: ["get"],
    itemOperations: []
)]
class Complement{

}