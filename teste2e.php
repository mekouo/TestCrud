<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../vendor/autoload.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

/**
 * * @covers \index
 * @covers \contacts
 *
 * @internal
 */
final class e2eTest extends TestCase
{
    public function teste2e()
    {
        // we try to read Selenium URL from environment
        // will be used when testing in GitLab
        $selenium_url = getenv('SELENIUM_URL');

        if ($selenium_url === false) {
            $selenium_url = 'http://localhost:4444/wd/hub';
        }

        // récupération de l'ip locale à passer au serveur docker selenium pour effectuer les tests
        $localIP = gethostbyname(gethostname());
        //  echo 'ip : '.$localIP;
        $nomPC = gethostname();
        $isGitlab = mb_strrpos($nomPC, 'runner');

        if ($isGitlab !== false) {
            $isGitlab = true;
            // echo "gitlab : ".$nomPC;
        }

        $capabilities = DesiredCapabilities::chrome();
        $browser = RemoteWebDriver::create(
            $selenium_url,
            $capabilities
        );

        // $localIP = "172.16.250.135";

        // 172.17.0.1:9090
        // 172.16.250.135
        // $localIP
        $browser->get('http://'.$localIP.':9090/index.php');

        // clic sur le bouton ajouter
        $browser->findElement(WebDriverBy::className('mb-1'))->click();

        // creation de l'utilisateur
        $browser->findElement(WebDriverBy::id('nom'))->sendKeys('ninet');
        $browser->findElement(WebDriverBy::id('prenom'))->sendKeys('pierre');
        $browser->findElement(WebDriverBy::id('prenom'))->submit();

        // nécessaire car les redirections ne sont pas suivies lors de la l'éxecution par gitlab
        $browser->get('http://'.$localIP.':9090/index.php');
        // recherche de l'utilisateur dans la liste
        $browser->findElement(WebDriverBy::id('search'))->sendKeys('pierre');
        $browser->findElement(WebDriverBy::id('search'))->submit();

        // modification de l'utilisateur
        $browser->findElement(WebDriverBy::id('edit'))->click();
        $browser->findElement(WebDriverBy::id('nom'))->clear();
        $browser->findElement(WebDriverBy::id('nom'))->sendKeys('nougaro');
        $browser->findElement(WebDriverBy::id('prenom'))->clear();
        $browser->findElement(WebDriverBy::id('prenom'))->sendKeys('jacques');
        $browser->findElement(WebDriverBy::id('prenom'))->submit();

        $browser->get('http://'.$localIP.':9090/index.php');
        // verification de la présence de l'utilisateur crée dans la liste
        $tab = $browser->findElement(WebDriverBy::className('table-hover'));
        $dataTab = $tab->getText();
        // echo "\n".$dataTab;
        $pos = mb_strrpos($dataTab, 'nougaro jacques');

        if ($pos !== false) {
            //  echo "\n contact crée détecté ! \n";
        }
        static::assertGreaterThan(0, $pos);

        // suppression du contact crée
        $browser->findElement(WebDriverBy::id('delete'))->click();
        $deleteconfirmbutton = $browser->findElement(WebDriverBy::id('deleteConfirm'));
        // exécution de javascript pour cliquer sur le bouton car bug (element not interactable) empechant
        // de le faire avec la méthode clic de selenium
        $browser->executeScript('arguments[0].click();', [$deleteconfirmbutton]);

        $browser->get('http://'.$localIP.':9090/index.php');
        // verication de la suppression du contact
        $tab = $browser->findElement(WebDriverBy::className('table-hover'));
        $dataTab = $tab->getText();
        //  echo $dataTab;
        $pos = mb_strrpos($dataTab, 'nougaro jacques');

        if ($pos === false) {
            // echo "\n Succès suppression contact crée ! ";
        }
        static::assertFalse($pos);

        $browser->quit();
    }
}
