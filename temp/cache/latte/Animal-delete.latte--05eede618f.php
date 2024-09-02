<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/delete.latte */
final class Template_05eede618f extends Latte\Runtime\Template
{
	public const Source = '/Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Animal/delete.latte';

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

		echo '    <h1>Delete Animal</h1>
    <p>Are you sure you want to delete this animal?</p>
    <form method="post">
        <input type="submit" value="Yes, delete it">
        <a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 6 */;
		echo '/home">Cancel</a>
    </form>
';
	}
}
