<?php

class ContainerEnvironmentCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function vefiryOSVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the container os version - Ubuntu 20.04");
        $I->runShellCommand("docker exec db_container cat /etc/os-release | grep PRETTY_NAME | cut -d'=' -f 2"); 
        $I->seeInShellOutput("Ubuntu 20.04.3 LTS");
    }

    public function vefiryInstalledMariaDBVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB version - 10.5");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"SELECT @@version;\""); 
        $I->seeInShellOutput("10.5.13");
    }

    public function vefiryInstalledMariaDBRepoTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB repository");
        $I->runShellCommand("docker exec db_container apt show mariadb-server | grep Maintainer"); 
        $I->seeInShellOutput("MariaDB Developers");
    }
}
