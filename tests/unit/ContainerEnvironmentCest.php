<?php

class ContainerEnvironmentCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function vefiryOSVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the container os version - RHEL 8.4");
        $I->runShellCommand("docker exec db_container cat /etc/os-release | grep PRETTY_NAME | cut -d'=' -f 2"); 
        $I->seeInShellOutput("Red Hat Enterprise Linux 8.4 (Ootpa)");
    }

    public function vefiryInstalledMariaDBVersionTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB version - 10.5");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"SELECT @@version;\""); 
        $I->seeInShellOutput("10.5.13");
    }

    public function vefiryInstalledMariaDBRepoTest (UnitTester $I)
    {
        $I->wantTo("Veify the MariaDB repository is MariaDB main");
        $I->runShellCommand("docker exec db_container yum list installed | grep MariaDB-server | awk '{print $3}'"); 
        $I->seeInShellOutput("@mariadb-main");
    }
}
