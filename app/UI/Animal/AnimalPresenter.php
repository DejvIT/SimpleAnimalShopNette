<?php

namespace App\UI\Animal;

use App\Model\AnimalManager;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Utils\ArrayHash;

class AnimalPresenter extends Presenter
{
    private $animalManager;

    public function __construct(AnimalManager $animalManager)
    {
        $this->animalManager = $animalManager;
    }

    public function actionAdd(): void
    {
        // Nothing needed here, action automatically loads the add.latte template
    }

    public function actionEdit(int $id): void
    {
        $animal = $this->animalManager->getAnimalById($id);

        if (!$animal) {
            throw new Nette\Application\BadRequestException('Animal not found', 404);
        }

        $this['animalForm']->setDefaults($animal);
    }

    public function actionDelete(int $id): void
    {
        $this->animalManager->deleteAnimal($id);
        $this->redirect('Home:default');
    }

    protected function createComponentAnimalForm(): Form
    {
        $form = new Form();

        // Add name field
        $form->addText('name', 'Name:')
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');

        // Add category field
        $form->addText('category', 'Category:')
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');

        // Add image path field
        $form->addText('image', 'Image Path:')
            ->setRequired()
            ->setHtmlAttribute('class', 'form-control');

        // Add status field
        $form->addSelect('status', 'Status:', [
            'Available' => 'Available',
            'Pending' => 'Pending',
            'Sold' => 'Sold',
        ])
            ->setHtmlAttribute('class', 'form-control');

        // Add submit button
        $form->addSubmit('save', 'Save')
            ->setHtmlAttribute('class', 'btn btn-success');

        // Set the onSuccess callback
        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }


    public function onSuccess(Form $form, ArrayHash $values): void
    {
        $id = $this->getParameter('id');
        if ($id) {
            $this->animalManager->updateAnimal($id, $values);
        } else {
            $this->animalManager->addAnimal($values);
        }
        $this->redirect('Home:default');
    }

    public function renderEdit(int $id): void
    {
        $animal = $this->animalManager->getAnimalById($id);

        if (!$animal) {
            throw new Nette\Application\BadRequestException('Animal not found', 404);
        }

        $this->template->animal = $animal;
        $this->template->form = $this['animalForm'];

        // Use the custom template file
        $this->setView('form');
    }

    public function renderAdd(): void
    {
        // Initialize the form for adding a new animal
        $this->template->form = $this['animalForm'];

        // Use the custom template file
        $this->setView('form');
    }
}
