<?php

class ContainerEnvironmentCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function vefiryOSVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the container os version");
        $I->runShellCommand("docker exec db_container cat /etc/os-release | grep PRETTY_NAME | cut -d'=' -f 2"); 
        $I->seeInShellOutput("CentOS Linux 7");
    }

    public function vefiryInstalledMariaDBVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB version");
        $I->runShellCommand("docker exec db_container yum list installed MariaDB-Server | grep MariaDB-server | awk '{print $2}' | cut -d'-' -f 1"); 
        $I->seeInShellOutput("10.3");
    }

    public function vefiryInstalledMariaDBRepoTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB repository");
        $I->runShellCommand("docker exec db_container yum list installed | grep MariaDB-server | awk '{print $3}'"); 
        $I->seeInShellOutput("@mariadb");
    }
}
