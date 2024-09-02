<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/edit.latte */
final class Template_e1359f26ec extends Latte\Runtime\Template
{
	public const Source = '/Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/edit.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <h1>Edit Animal</h1>

    ';
		$form = $this->global->formsStack[] = $this->global->uiControl['animalForm'] /* line 4 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form, []) /* line 4 */;
		echo '
        <div>
            ';
		echo LR\Filters::escapeHtmlText($form['name']->label) /* line 6 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['name']->control) /* line 6 */;
		echo '
        </div>
        <div>
            ';
		echo LR\Filters::escapeHtmlText($form['category']->label) /* line 9 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['category']->control) /* line 9 */;
		echo '
        </div>
        <div>
            ';
		echo LR\Filters::escapeHtmlText($form['image']->label) /* line 12 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['image']->control) /* line 12 */;
		echo '
        </div>
        <div>
            ';
		echo LR\Filters::escapeHtmlText($form['status']->label) /* line 15 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['status']->control) /* line 15 */;
		echo '
        </div>
        <div>
            ';
		echo LR\Filters::escapeHtmlText($form['save']->control) /* line 18 */;
		echo '
        </div>
    ';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack)) /* line 20 */;

		echo "\n";
	}
}
