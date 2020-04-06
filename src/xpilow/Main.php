<?php

namespace xpilow;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\Effect;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\item\Item;
use pocketmine\lang\BaseLang;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

use jojoe77777\FormAPI;

use xpilow\Main;

use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener {

    /** @var Main $instance */
    private static $instance;
	
	public $plugin;

	public function onEnable() : void{
	    self::$instance = $this;
        $this->getLogger()->info(TextFormat::GREEN . "PetMenu xpilow Enable");
        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");	
	}
	
	public static function getInstance() : self{
	    return self::$instance;
	}
 

       
    public function onCommand(CommandSender $o, Command $kmt, string $label, array $array) : bool{
        if($kmt->getName() == "pet"){
            $this->Menu($o);
        }
        return true;
    }
    
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                $this->dForm($sender);
                break;
                case 1:
                $this->Remove($sender);
                break;
                case 2:
                $this->ChangeName($sender);
                break;
                case 3:
                $this->TogglePet($sender);
                break;
                case 4:
                $this->Next($sender);
                break;
                        

                }
            });
            $name = $sender->getName();
            $money = $this->eco->myMoney($sender);
            $form->setTitle("XPILOW PET MENU §6[§r1§f/§r2§6]");
            $form->setContent("§eHai, §a{$name} §bSelamat Datang DiPetUI\n§aAuthor §e: §bxpilow§f/§bRezaG\n §aUang §e: §b{$money}");
            $form->addButton("§8PET SHOP",0,"textures/ui/icon_panda");
            $form->addButton("§8REMOVE PET",0,"textures/ui/trash_light");
            $form->addButton("§8CHANGE PET NAME",0,"textures/ui/text_color_paintbrush");
            $form->addButton("§8TOGGLE PET",0,"textures/ui/touch_glyph");
            $form->addButton("§8NEXT MENU",0,"textures/ui/arrow_active");
            $form->sendToPlayer($sender);
            return $form;
    }

    public function dForm(Player $o){
        $f = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $o, array $data){
            $re = $data[0];
            if($re === null){
                return true;
            }
            if($re == 0){
				if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bWolf")){
            	    $money = $this->eco->myMoney($o);
				    $wolf = 150000;
				    if($money >= $wolf){
					    $this->eco->reduceMoney($o, $wolf);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Wolf $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 1){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bDonkey")){
            	    $money = $this->eco->myMoney($o);
				    $donkey = 150000;
				    if($money >= $donkey){
					    $this->eco->reduceMoney($o, $donkey);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Donkey $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 2){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bHorse")){
            	    $money = $this->eco->myMoney($o);
				    $horse = 150000;
				    if($money >= $horse){
					    $this->eco->reduceMoney($o, $horse);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Horse $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 3){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bLlama")){
            	    $money = $this->eco->myMoney($o);
				    $llama = 150000;
				    if($money >= $llama){
					    $this->eco->reduceMoney($o, $llama);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Llama $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 4){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bChicken")){
            	    $money = $this->eco->myMoney($o);
				    $chicken = 150000;
				    if($money >= $chicken){
					    $this->eco->reduceMoney($o, $chicken);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Chicken $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 5){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bRabbit")){
            	    $money = $this->eco->myMoney($o);
				    $rabbit = 150000;
				    if($money >= $rabbit){
					    $this->eco->reduceMoney($o, $rabbit);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Rabbit $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 6){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bIronGolem")){
            	    $money = $this->eco->myMoney($o);
				    $golem = 150000;
				    if($money >= $golem){
					    $this->eco->reduceMoney($o, $golem);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet IronGolem $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 7){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSheep")){
            	    $money = $this->eco->myMoney($o);
				    $sheep = 150000;
				    if($money >= $sheep){
					    $this->eco->reduceMoney($o, $sheep);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Sheep $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 8){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSlime")){
            	    $money = $this->eco->myMoney($o);
				    $slime = 150000;
				    if($money >= $slime){
					    $this->eco->reduceMoney($o, $slime);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Slime $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 9){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSnowGolem")){
            	    $money = $this->eco->myMoney($o);
				    $golem = 150000;
				    if($money >= $golem){
					    $this->eco->reduceMoney($o, $golem);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet SnowGolem $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 10){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bPig")){
            	    $money = $this->eco->myMoney($o);
				    $pig = 150000;
				    if($money >= $pig){
					    $this->eco->reduceMoney($o, $pig);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Pig $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 11){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §PolarBear")){
            	    $money = $this->eco->myMoney($o);
				    $bear = 150000;
				    if($money >= $bear){
					    $this->eco->reduceMoney($o, $bear);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet PolarBear $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 12){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bOcelot")){
            	    $money = $this->eco->myMoney($o);
				    $ocelot = 150000;
				    if($money >= $ocelot){
					    $this->eco->reduceMoney($o, $ocelot);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Ocelot $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 13){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSpider")){
            	    $money = $this->eco->myMoney($o);
				    $spider = 150000;
				    if($money >= $spider){
					    $this->eco->reduceMoney($o, $spider);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Spider $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 14){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bWither")){
            	    $money = $this->eco->myMoney($o);
				    $wither = 150000;
				    if($money >= $wither){
					    $this->eco->reduceMoney($o, $wither);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Wither $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 15){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bVillager")){
            	    $money = $this->eco->myMoney($o);
				    $villager = 150000;
				    if($money >= $villager){
					    $this->eco->reduceMoney($o, $villager);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Villager $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 16){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSilverFish")){
            	    $money = $this->eco->myMoney($o);
				    $silverfish = 150000;
				    if($money >= $silverfish){
					    $this->eco->reduceMoney($o, $silverfish);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet SilverFish $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 17){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bVex")){
            	    $money = $this->eco->myMoney($o);
				    $vex = 150000;
				    if($money >= $vex){
					    $this->eco->reduceMoney($o, $vex);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Vex $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 18){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bEnderDragon")){
            	    $money = $this->eco->myMoney($o);
				    $dragon = 150000;
				    if($money >= $dragon){
					    $this->eco->reduceMoney($o, $dragon);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet EnderDragon $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 19){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bWitch")){
            	    $money = $this->eco->myMoney($o);
				    $witch = 150000;
				    if($money >= $witch){
					    $this->eco->reduceMoney($o, $witch);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Witch $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 20){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bCow")){
            	    $money = $this->eco->myMoney($o);
				    $cow = 150000;
				    if($money >= $cow){
					    $this->eco->reduceMoney($o, $cow);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Cow $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 21){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bZombie")){
            	    $money = $this->eco->myMoney($o);
				    $zombie = 150000;
				    if($money >= $zombie){
					    $this->eco->reduceMoney($o, $zombie);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Zombie $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 22){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bEnderDargon")){
            	    $money = $this->eco->myMoney($o);
				    $dragon = 150000;
				    if($money >= $dragon){
					    $this->eco->reduceMoney($o, $dragon);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet EnderDragon $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
        }
            if($re == 23){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSkeleton")){
            	    $money = $this->eco->myMoney($o);
				    $skeleton = 150000;
				    if($money >= $skeleton){
					    $this->eco->reduceMoney($o, $skeleton);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Skeleton $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 24){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bGuardian")){
            	    $money = $this->eco->myMoney($o);
				    $guardian = 150000;
				    if($money >= $guardian){
					    $this->eco->reduceMoney($o, $guardian);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Guardian $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 25){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bCreeper")){
            	    $money = $this->eco->myMoney($o);
				    $creeper = 150000;
				    if($money >= $creeper){
					    $this->eco->reduceMoney($o, $creeper);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Creeper $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 26){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bCaveSpider")){
            	    $money = $this->eco->myMoney($o);
				    $cavespider = 150000;
				    if($money >= $cavespider){
					    $this->eco->reduceMoney($o, $cavespider);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet CaveSpider $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 27){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bEvoker")){
            	    $money = $this->eco->myMoney($o);
				    $evoker = 150000;
				    if($money >= $evoker){
					    $this->eco->reduceMoney($o, $evoker);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Evoker $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 28){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bHusk")){
            	    $money = $this->eco->myMoney($o);
				    $husk = 150000;
				    if($money >= $husk){
					    $this->eco->reduceMoney($o, $husk);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Husk $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 29){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bBlaze")){
            	    $money = $this->eco->myMoney($o);
				    $blaze = 150000;
				    if($money >= $blaze){
					    $this->eco->reduceMoney($o, $blaze);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Blaze $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 30){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §ElderGuardian")){
            	    $money = $this->eco->myMoney($o);
				    $elderguardian = 150000;
				    if($money >= $elderguardian){
					    $this->eco->reduceMoney($o, $elderguardian);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet ElderGuardian $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 31){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bEnderman")){
            	    $money = $this->eco->myMoney($o);
				    $endermine = 150000;
				    if($money >= $enderman){
					    $this->eco->reduceMoney($o, $enderman);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Enderman $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 32){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bEndermite")){
            	    $money = $this->eco->myMoney($o);
				    $endermite = 150000;
				    if($money >= $endermite){
					    $this->eco->reduceMoney($o, $endermite);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Endermite $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 33){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bGhast")){
            	    $money = $this->eco->myMoney($o);
				    $ghast = 150000;
				    if($money >= $ghast){
					    $this->eco->reduceMoney($o, $ghast);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Ghast $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 34){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bGuardian")){
            	    $money = $this->eco->myMoney($o);
				    $guardian = 150000;
				    if($money >= $guardian){
					    $this->eco->reduceMoney($o, $guardian);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Guardian $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 35){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bMooshroom")){
            	    $money = $this->eco->myMoney($o);
				    $mooshroom = 150000;
				    if($money >= $mooshroom){
					    $this->eco->reduceMoney($o, $mooshroom);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Mooshroom $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 36){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bMule")){
            	    $money = $this->eco->myMoney($o);
				    $mule = 150000;
				    if($money >= $mule){
					    $this->eco->reduceMoney($o, $mule);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Mule $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 37){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSkeletonHorse")){
            	    $money = $this->eco->myMoney($o);
				    $shorse = 150000;
				    if($money >= $shorse){
					    $this->eco->reduceMoney($o, $shorse);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet SkeletonHorse $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 38){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bSquid")){
            	    $money = $this->eco->myMoney($o);
				    $squid = 150000;
				    if($money >= $squid){
					    $this->eco->reduceMoney($o, $squid);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Squid $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 39){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bStray")){
            	    $money = $this->eco->myMoney($o);
				    $stray = 150000;
				    if($money >= $stray){
					    $this->eco->reduceMoney($o, $stray);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Stray $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 40){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bVindicator")){
            	    $money = $this->eco->myMoney($o);
				    $vindicator = 150000;
				    if($money >= $vindicator){
					    $this->eco->reduceMoney($o, $vindicator);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet Vindicator $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 41){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bZombieHorse")){
            	    $money = $this->eco->myMoney($o);
				    $zhorse = 150000;
				    if($money >= $zhorse){
					    $this->eco->reduceMoney($o, $zhorse);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet ZombieHorse $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 42){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bZombieVillager")){
            	    $money = $this->eco->myMoney($o);
				    $zvillager = 150000;
				    if($money >= $zvillager){
					    $this->eco->reduceMoney($o, $zvillager);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet ZombieVillager $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
        }
            if($re == 42){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bZombieVillager")){
            	    $money = $this->eco->myMoney($o);
				    $zvillager = 150000;
				    if($money >= $zvillager){
					    $this->eco->reduceMoney($o, $zvillager);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet ZombieVillager $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 43){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bZombiePigman")){
            	    $money = $this->eco->myMoney($o);
				    $zpigman = 300000;
				    if($money >= $zpigman){
					    $this->eco->reduceMoney($o, $zpigman);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet ZombiePigman $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 44){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bWitherSkull")){
            	    $money = $this->eco->myMoney($o);
				    $skull = 200000;
				    if($money >= $skull){
					    $this->eco->reduceMoney($o, $skull);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet WitherSkull $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
            }
            if($re == 45){
            	if(!$o->sendMessage("§aAnda Berhasil Membeli pet §bWitherSkeleton")){
            	    $money = $this->eco->myMoney($o);
				    $wskeleton = 100000;
				    if($money >= $wskeleton){
					    $this->eco->reduceMoney($o, $wskeleton);
					    $this->getServer()->getCommandMap()->dispatch($o, "spawnpet WitherSkeleton $data[1]");
					    return true;
            }else{
				    $o->sendMessage("§cAnda tidak punya cukup uang");
				    }
                }
               $this->getServer()->getCommandMap()->dispatch($o, "spawnpet $data[2]"); 
            }
         });
            $isim = $o->getName();
            $name = $o->getName();
            $money = $this->eco->myMoney($o);
            $wolf = 150000;
            $donkey = 150000;
            $horse = 150000;
            $llama = 150000;
            $chicken = 150000;
            $rabbit = 150000;
            $golem = 150000;
            $sheep = 150000;
            $slime = 150000;
            $snow = 150000;
            $pig = 150000;
            $bear = 150000;
            $ocelot = 150000;
            $spider = 150000;
            $wither = 150000;
            $villager = 150000;
            $silverfish = 150000;
            $vex = 150000;
            $dragon = 150000;
            $witch = 150000;
            $cow = 150000;
            $zombie = 150000;
            $skeleton = 150000;
            $bat = 150000;
            $creeper = 150000;
            $cavespider = 150000;
            $evoker = 150000;
            $husk = 150000;
            $blaze = 150000;
            $elderguardian = 150000;
            $enderman = 150000;
            $endermite = 150000;
            $ghast = 150000;
            $guardian = 150000;
            $mooshroom = 150000;
            $mule = 150000;
            $shorse = 150000;
            $squid = 150000;
            $stray = 150000;
            $vindicator = 150000;
            $zhorse = 150000;
            $zvillager = 150000;
            $zpigman = 150000;
            $skull = 200000;
            $wskeleton = 150000;
            $f->setTitle("§0PET SHOP");
            $f->addDropdown("§eHai, §b{$name} §aSelamat Datang\n §aUang §e: §b{$money}§9$\n§aAuthor §e: §bxpilow§f/§bRezaG\n\n§fChoose Pet:", [
                "Wolf §a" . $wolf . "§9$",
                "Donkey §a" . $donkey . "§9$",
                "Horse §a" . $horse . "§9$",
                "Llama §a" . $llama . "§9$",
                "Chicken §a" . $chicken . "§9$",
                "Rabbit §a" . $rabbit . "§9$",
                "IronGolem §a" . $golem . "§9$",
                "Sheep §a" . $sheep . "§9$",
                "Slime §a" . $slime . "§9$",
                "SnowGolem §a" . $snow . "§9$",
                "Pig §a" . $pig . "§9$",
                "PolarBear §a" . $bear . "§9$",
                "Ocelot §a" . $ocelot . "§9$",
                "Spider §a" . $spider . "§9$",
                "Wither §a" . $wither . "§9$",
                "Villager §a" . $villager . "§9$",
                "SilverFish §a" . $silverfish . "§9$",
                "Vex §a" . $vex . "§9$",
                "Dragon §a" . $dragon . "§9$",
                "Witch §a" . $witch . "§9$",
                "Cow §a" . $cow . "§9$",
                "Zombie §a" . $zombie . "§9$",
                "EnderDragon §a" . $dragon . "§9$",
                "Skeleton §a" . $skeleton . "§9$",
                "Bat §a" . $bat . "§9$",
                "Creeper §a" . $creeper . "§9$",
                "CaveSpider §a" . $cavespider . "§9$",
                "Evoker §a" . $evoker . "§9$",
                "Husk §a" . $husk . "§9$",
                "Blaze §a" . $blaze . "§9$",
                "ElderGuardian §a" . $elderguardian . "§9$",
                "Enderman §a" . $enderman . "§9$",
                "Endermite §a" . $endermite . "§9$",
                "Ghast §a" . $ghast . "§9$",
                "Guardian §a" . $guardian . "§9$",
                "Mooshroom §a" . $mooshroom . "§9$",
                "Mule §a" . $mule . "§9$",
                "SkeletonHorse §a" . $shorse . "§9$",
                "Squid §a" . $squid . "§9$",
                "Stray §a" . $stray . "§9$",
                "Vindicator §a" . $vindicator . "§9$",
                "ZombieHorse §a" . $zhorse . "§9$",
                "ZombieVillager §a" . $zvillager . "§9$",
                "ZombiePigman §a" . $zpigman . "§9$",
                "WitherSkull §a" . $skull . "§9§9$",
                "WitherSkeleton §a" . $wskeleton . "§9§9$"
                            ]);
                            $f->addInput("§fPet Name:", "Name: 0");
            sf->sendToPlayer($o);
    }

    public function Remove($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
	       }
	       $command = "removepet $data[0]";
	       $this->getServer()->getCommandMap()->dispatch($player, $command);
		});
		$on = $this->getServer()->getCommandMap()->dispatch($player, "tooglepet all");
		$form->setTitle("REMOVE PET");
		$form->addInput("Pet Name:", "Nama: 0");
	    $form->sendToPlayer($player);
    }
    
    public function TogglePet($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			$result = $data[1];
			if($result === null){
				return true;
			}
			switch($result){
		        case 0;
		    $command = "togglepet $data[0]";
	        $this->getServer()->getCommandMap()->dispatch($player, $command);
	            break;
	        }
	        switch($result0){
		        case 1;
		   $command = "togglepet";
	       $this->getServer()->getCommandMap()->dispatch($player, $command);
	            break;
	        }
		});
		$form->setTitle("TOGGLE PET");
		$form->addInput("Pet Name:", "Name: 0");
		$form->addToggle("§fOFF§6/§fON");
	    $form->sendToPlayer($player);
    }
	
	public function ChangeName($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
                return true;
            }
            $command = "changepetname $data[0] $data[1]";
            $this->getServer()->getCommandMap()->dispatch($player, $command);
        });
        $form->setTitle("CHANGE PET NAME");
        $form->addInput("Old Name:", "Old >\\\<");
        $form->addInput("New Name:", "New >\\\<");
        $form->sendToPlayer($player);
    }
    
    public function Next($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                $this->HealPet($sender);
                break;
                case 1:
                $this->LevelUP($sender);
                break;
                case 2:
                $this->Points($sender);
                break;
                case 3:
                $this->Menu($sender);
                break;
                        

                }
            });
            $form->setTitle("XPILOW PET MENU §6[§r2§f/§r2§6]");
            $form->addButton("§8HEAL PET",0,"textures/ui/icon_winter");
            $form->addButton("§8LEVELUP PET",0,"textures/ui/jump_boost_effect");
            $form->addButton("§8POINTS PET",0,"textures/ui/icon_minecoin_9x9");
            $form->addButton("§8BACK MENU",0,"textures/ui/undoArrow");
            $form->sendToPlayer($sender);
            return $form;
    }
    
    public function HealPet($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$name = $player->getName();
			$result = $data[0];
			if($result === null){
                return true;
            }
            $command = "healpet $data[0] {$name} $data[1]";
            $this->getServer()->getCommandMap()->dispatch($player, $command);
        });
        $form->setTitle("HEAL PET");
        $form->addInput("Pet Name:", "Pet >\\\<");
        $form->addInput("Amount:", "0");
        $form->sendToPlayer($player);
    }
    
    public function LevelUP($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$name = $player->getName();
			$result = $data[0];
			if($result === null){
                return true;
            }
            $command = "leveluppet $data[0] {$name}";
            $this->getServer()->getCommandMap()->dispatch($player, $command);
        });
        $form->setTitle("LEVELUP PET");
        $form->addInput("Pet Name:", "Pet >\\\<");
        $form->addInput("Amount:", "0");
        $form->sendToPlayer($player);
    }

    public function Points($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$name = $player->getName();
			$result = $data[0];
			if($result === null){
                return true;
            }
            $command = "addpetpoints $data[0] $data[1] {$name}";
            $this->getServer()->getCommandMap()->dispatch($player, $command);
        });
        $form->setTitle("ADD POINTS PET");
        $form->addInput("Pet Name:", "Pet >\\\<");
        $form->addInput("Amount:", "0");
        $form->sendToPlayer($player);
    }

}

?>
