<?php

class MusicWebExtension extends \Twig\Extension\AbstractExtension {
	public function getFunctions() {
		global $profiler;

		return [
			new \Twig\TwigFunction('track', 'track', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('profiler_stats', function () use ($profiler) {
				$profiler->getStats();
			})
		];
	}
	public function getFilters() {
		return [];
	}
}
