<?php

namespace ErosionYT\Essentials\Commands;

use ErosionYT\Essentials\Main;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

class HealCommand extends Command{

    public Main $plugin;
    public Config $config;

    public function __construct(string $name, Main $plugin) {
        parent::__construct($name);
        $this->setDescription("Heal yourself");
        $this->setPermission("essentials.heal.command");
        $this->setUsage("/heal");
        $this->plugin = $plugin;
        $this->config = $plugin->getConfig();
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{

		if (!$sender->hasPermission($this->getPermission())) {
			$sender->sendMessage(C::RED . "You do not have permission to use this command");
			return false;
		}

		$sender->setHealth($sender->getMaxHealth());
		$sender->sendMessage($this->config->get("prefix") . C::AQUA .  "You have been healed");
		return true;
	}
}