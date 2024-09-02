<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Home/default.latte */
final class Template_64468f2b72 extends Latte\Runtime\Template
{
	public const Source = '/Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/Home/default.latte';

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


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['animal' => '15'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '	<div class="container">
		<h1 class="my-4">List of Animals</h1>

		<!-- Status Links -->
		<div class="mb-3">
			<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 7 */;
		echo '/home?status=Available" class="btn btn-primary">Available</a>
			<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 8 */;
		echo '/home?status=Pending" class="btn btn-secondary">Adopted</a>
			<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 9 */;
		echo '/home?status=Sold" class="btn btn-success">Sold</a>
			<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 10 */;
		echo '/home" class="btn btn-info">All</a>
		</div>

		<!-- Animal List -->
		<ul class="list-group">
';
		foreach ($animals as $animal) /* line 15 */ {
			echo '				<li class="list-group-item d-flex justify-content-between align-items-center">
					<div>
						<strong>';
			echo LR\Filters::escapeHtmlText($animal['name']) /* line 18 */;
			echo '</strong> - ';
			echo LR\Filters::escapeHtmlText($animal['category']) /* line 18 */;
			echo '
						<img src="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 19 */;
			echo '/';
			echo LR\Filters::escapeHtmlAttr($animal['image']) /* line 19 */;
			echo '" alt="';
			echo LR\Filters::escapeHtmlAttr($animal['name']) /* line 19 */;
			echo '" class="img-thumbnail" style="width: 100px;">
						<div>Status: ';
			echo LR\Filters::escapeHtmlText($animal['status']) /* line 20 */;
			echo '</div>
					</div>
					<div>
						<a href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 23 */;
			echo '/animal/edit/';
			echo LR\Filters::escapeHtmlAttr($animal['id']) /* line 23 */;
			echo '" class="btn btn-warning btn-sm">Edit</a>
						<a href="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 24 */;
			echo '/animal/delete/';
			echo LR\Filters::escapeHtmlAttr($animal['id']) /* line 24 */;
			echo '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>
					</div>
				</li>
';

		}

		echo '		</ul>

		<!-- Add New Animal Link -->
		<a href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 31 */;
		echo '/animal/add" class="btn btn-success mt-3">Add New Animal</a>
	</div>
';
	}
}
