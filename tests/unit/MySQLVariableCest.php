<?php

class MySQLVariableCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function waitTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify wait_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'wait_timeout';\" | grep wait_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("600");
    }

    public function maxAllowedPacketTest(UnitTester $I)
    {
        $I->wantTo("Veify max_allowed_packet");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'max_allowed_packet';\" | grep max_allowed_packet | awk '{print $2}'"); 
        $I->seeInShellOutput("67108864");
    }

    public function eventSchedulerTest(UnitTester $I)
    {
        $I->wantTo("Veify event_scheduler");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'event_scheduler';\" | grep event_scheduler | awk '{print $2}'"); 
        $I->seeInShellOutput("ON");
    }

    public function connectTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify connect_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'connect_timeout';\" | grep connect_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("10");
    }

    public function innodbBufferPoolSizeTest(UnitTester $I)
    {
        $I->wantTo("Veify innodb_buffer_pool_size");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'innodb_buffer_pool_size';\" | grep innodb_buffer_pool_size | awk '{print $2}'"); 
        $I->seeInShellOutput("2147483648");
    }

    public function innodbLogBufferSizeTest(UnitTester $I)
    {
        $I->wantTo("Veify innodb_log_buffer_size");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'innodb_log_buffer_size';\" | grep innodb_log_buffer_size | awk '{print $2}'"); 
        $I->seeInShellOutput("8388608");
    }

    public function innodbLogFileSizeTest(UnitTester $I)
    {
        $I->wantTo("Veify innodb_log_file_size");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'innodb_log_file_size';\" | grep innodb_log_file_size | awk '{print $2}'"); 
        $I->seeInShellOutput("1073741824");
    }

    public function innodbLockWaitTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify innodb_lock_wait_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'innodb_lock_wait_timeout';\" | grep innodb_lock_wait_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("30");
    }

    public function delayedInsertTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify delayed_insert_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'delayed_insert_timeout';\" | grep delayed_insert_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("300");
    }

    public function netReadTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify net_read_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'net_read_timeout';\" | grep net_read_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("30");
    }

    public function netWriteTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify net_write_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'net_write_timeout';\" | grep net_write_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("60");
    }

    public function slaveNetTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify slave_net_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'slave_net_timeout';\" | grep slave_net_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("600");
    }

    public function interactiveTimeoutTest(UnitTester $I)
    {
        $I->wantTo("Veify interactive_timeout");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'interactive_timeout';\" | grep interactive_timeout | awk '{print $2}'"); 
        $I->seeInShellOutput("600");
    }

    public function skipNameResolveTest(UnitTester $I)
    {
        $I->wantTo("Veify skip_name_resolve");
        $I->runShellCommand("docker exec db_container mysql -uroot -p1234 --execute=\"show variables like 'skip_name_resolve';\" | grep skip_name_resolve | awk '{print $2}'"); 
        $I->seeInShellOutput("ON");
    }
}