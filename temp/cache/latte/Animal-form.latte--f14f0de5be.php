<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/form.latte */
final class Template_f14f0de5be extends Latte\Runtime\Template
{
	public const Source = '/Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/form.latte';

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
		echo '

';
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <div class="container">
        <h1 class="my-4">';
		if (isset($id)) /* line 3 */ {
			echo 'Edit Animal';
		} else /* line 3 */ {
			echo 'Add New Animal';
		}
		echo '</h1>

        ';
		$form = $this->global->formsStack[] = $this->global->uiControl['animalForm'] /* line 5 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form, []) /* line 5 */;
		echo '
            <div class="form-group">
                ';
		echo LR\Filters::escapeHtmlText($form['name']->label) /* line 7 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['name']->control) /* line 7 */;
		echo '
            </div>
            <div class="form-group">
                ';
		echo LR\Filters::escapeHtmlText($form['category']->label) /* line 10 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['category']->control) /* line 10 */;
		echo '
            </div>
            <div class="form-group">
                ';
		echo LR\Filters::escapeHtmlText($form['image']->label) /* line 13 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['image']->control) /* line 13 */;
		echo '
            </div>
            <div class="form-group">
                ';
		echo LR\Filters::escapeHtmlText($form['status']->label) /* line 16 */;
		echo ' ';
		echo LR\Filters::escapeHtmlText($form['status']->control) /* line 16 */;
		echo '
            </div>
            <div class="form-group">
                ';
		echo LR\Filters::escapeHtmlText($form['save']->control) /* line 19 */;
		echo '
            </div>
        ';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack)) /* line 21 */;

		echo '
    </div>
';
	}
}
