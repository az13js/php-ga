<?php
require_once 'autoload.php';

//$factory = new GeneticAlgorithms\DefaultRealization\IndividualFactory();
//$ind = $factory->create();
//print_r($ind);
//print_r($ind->getFitness());

$factory = new GeneticAlgorithms\DefaultRealization\GeneticAlgorithmsFactory();
$geneticAlgorithms = $factory->create();
$geneticAlgorithms->run();
