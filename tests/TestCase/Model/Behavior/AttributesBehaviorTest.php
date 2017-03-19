<?php
namespace Eav\Test\TestCase\Model\Behavior;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DebugKit\Database\Log\DebugLog;
use Eav\Model\Behavior\AttributesBehavior;

/**
 * Eav\Model\Behavior\AttributesBehavior Test Case
 */
class AttributesBehaviorTest extends TestCase
{

    public $fixtures = [
        'plugin.eav.eav_test_entities',
        'plugin.eav.eav_attributes',
        'plugin.eav.eav_attribute_sets_attributes',
        'plugin.eav.eav_attribute_sets',
        'plugin.eav.eav_entity_attribute_values',
    ];

    /**
     * @var DebugLog
     */
    public $dbLogger;

    /**
     * @var Table Table instance with AttributesBehavior attached
     */
    public $table;

    public function setUp()
    {
        parent::setUp();
        $this->table = TableRegistry::get('Eav.EavTestEntities', [
            'entityClass' => 'Eav\Test\TestCase\Model\Entity\EavTestEntity'
        ]);
        $this->table->primaryKey(['id']);
        $this->table->addBehavior('Eav.Attributes', ['scope' => []]);

    }


    protected function _setupDbLogging()
    {
        $connection = ConnectionManager::get('test');

        $logger = $connection->logger();
        $this->dbLogger = new DebugLog($logger, 'test');

        $connection->logQueries(true);
        $connection->logger($this->dbLogger);
    }

    public function testTableGetAttributes()
    {
        $entity = $this->table->get(1);
        $this->assertInstanceOf('Eav\\Test\\TestCase\\Model\\Entity\\EavTestEntity', $entity);

        $result = $this->table->getAttributes($entity)->toArray();
        $expected = ['test_default' => 'Hello World'];
        $this->assertEquals($expected, $result);
    }


    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        TableRegistry::remove('Eav.Test');
        unset($this->table);
        unset($this->dbLogger);

        parent::tearDown();
    }
}
