<?php

namespace App\UI\Home;

use App\Model\AnimalManager;
use Nette\Application\UI\Presenter;

class HomePresenter extends Presenter
{
    private $animalManager;

    public function __construct(AnimalManager $animalManager)
    {
        $this->animalManager = $animalManager;
    }

    public function renderDefault(): void
    {
        $status = $this->getParameter('status');
        if ($status) {
            $animals = $this->animalManager->getAnimalsByStatus($status);
        } else {
            $animals = $this->animalManager->loadAnimals();
        }
        $this->template->animals = $animals;
    }
}
