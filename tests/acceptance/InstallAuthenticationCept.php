<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Generate a full authentication system');

$I->cleanDir('tests/tmp');
$I->runShellCommand('php ../../../artisan wd:auth:install --routeFile="tests/tmp/routes.php" --resource=session --controller-path=tests/tmp --signIn="sign/in" --signOut="sign/out"');

$I->seeInShellOutput('Successfully installed your authentication');

$I->openFile('tests/tmp/SessionsController.php');
$I->seeFileContentsEqual(file_get_contents('tests/acceptance/stubs/controller.stub'));
$I->openFile('tests/tmp/routes.php');
$I->seeFileContentsEqual(file_get_contents('tests/acceptance/stubs/routes.stub'));

