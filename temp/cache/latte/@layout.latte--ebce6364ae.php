<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/@layout.latte */
final class Template_ebce6364ae extends Latte\Runtime\Template
{
	public const Source = '/Users/davidpavlicko/Documents/PhpStorm/pet-store-nette/app/UI/@layout.latte';

	public const Blocks = [
		['scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>';
		if ($this->hasBlock('title')) /* line 7 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 7 */;
			echo ' | ';
		}
		echo 'Nette Web</title>

	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 14 */;
		echo '/home">Pet Store</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item';
		if ($presenter->name === 'Home') /* line 20 */ {
			echo ' active';
		}
		echo '">
				<a class="nav-link" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 21 */;
		echo '/home">Home</a>
			</li>
			<li class="nav-item';
		if ($presenter->name === 'Animal' && $presenter->action === 'add') /* line 23 */ {
			echo ' active';
		}
		echo '">
				<a class="nav-link" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseUrl)) /* line 24 */;
		echo '/animal/add">Add New Animal</a>
			</li>
		</ul>
	</div>
</nav>

<div class="container mt-4">
	<!-- Flash messages -->
';
		foreach ($flashes as $flash) /* line 32 */ {
			echo '		<div class="alert alert-';
			echo LR\Filters::escapeHtmlAttr($flash->type) /* line 33 */;
			echo ' alert-dismissible fade show" role="alert">
			';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 34 */;
			echo '
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
';

		}

		echo '
		<!-- Page content -->
';
		$this->renderBlock('content', [], 'html') /* line 42 */;
		echo "\n";
		$this->renderBlock('scripts', get_defined_vars()) /* line 44 */;
		echo '</div>
</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '32'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 44 */
	public function blockScripts(array $ʟ_args): void
	{
		echo '		<!-- Bootstrap and Nette Forms JavaScript -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/nette-forms@3"></script>
';
	}
}
