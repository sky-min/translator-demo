<?php
declare(strict_types = 1);

namespace skymin;

use skymin\Translator\Language;
use skymin\Translator\trait\TranslaterHolderTrait;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;

final class Example extends PluginBase implements Listener{
	use TranslaterHolderTrait;

	protected function onEnable() : void{
		$resource = $this->getFile() . 'resources/';
		$this->setDefaultLang(new Language('ko_KR', $resource . 'kor.ini'));
		$this->getTranslater()->addLanguage(new Language('en_US', $resource . 'eng.ini'));
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $ev) : void{
		$player = $ev->getPlayer();
		$ev->setJoinMessage($this->getTranslater()->translate('exmaple.join.message', [$player->getName()], $player->getLocale()));
	}

}