<?php
namespace Eav\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Eav\Model\Table\EavAttributesTable;

class EavEntityTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Eav\Model\Table\EavAttributesTable
     */
    public $EavAttributes;

    /**
     * @var \Cake\ORM\Table
     */
    public $EavTestEntities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.eav.eav_test_entities',
        'plugin.eav.eav_attributes',
        'plugin.eav.eav_attribute_sets_attributes',
        'plugin.eav.eav_entity_attribute_values',
        'plugin.eav.eav_attribute_sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();


        $config = TableRegistry::exists('EavAttributes') ? [] : ['className' => 'Eav\Model\Table\EavAttributesTable'];
        $this->EavAttributes = TableRegistry::get('EavAttributes', $config);


        $this->EavTestEntities = TableRegistry::get('Eav.EavTestEntities', [
            'entityClass' => 'Eav\Test\TestCase\Model\Entity\EavTestEntity'
        ]);
        $this->EavTestEntities->addBehavior('Eav.Attributes');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EavAttributes);

        parent::tearDown();
    }

    /**
     * Test entity getAttribute() method
     *
     * @return void
     */
    public function _testGetAttribute()
    {
        $entity = $this->EavTestEntities->get(1);
        $result = $entity->getAttribute('test_default');

        $this->assertEquals('Hello World', $result);
    }

    /**
     * Test entity get() accessor method
     *
     * @return void
     */
    public function testGetAccessor_Method()
    {
        $entity = $this->EavTestEntities->get(1);
        $result = $entity->get('test_default');

        $this->assertEquals('Hello World', $result);
    }

    /**
     * Test entity __get() accessor method
     *
     * @return void
     */
    public function testGetAccessor_Property()
    {
        $entity = $this->EavTestEntities->get(1);
        $result = $entity->test_default;

        $this->assertEquals('Hello World', $result);
    }

    /**
     * Test entity setAttribute() method
     *
     * @return void
     */
    public function testSetAttribute_NonPersistent()
    {
        $value = 'Awesome!';

        $entity = $this->EavTestEntities->get(1);
        $entity->set('test_default', $value);

        $this->assertTrue($entity->dirty('test_default'));

        $result = $entity->get('test_default');
        $this->assertEquals($value, $result);
    }

    /**
     * Test entity setAttribute() method
     *
     * @return void
     */
    public function testSetAttribute_Persistent()
    {
        $value = 'Awesome!';

        $entity = $this->EavTestEntities->get(1);
        $entity->set('test_default', $value);
        $this->EavTestEntities->save($entity);

        $entity = $this->EavTestEntities->get(1);
        $result = $entity->get('test_default');
        $this->assertEquals($value, $result);

        // check if the original EavEntityAttributeValues entry has been updated
        // rather than a new entry has been created
        /*
        $attrValues = $entity->getAttributesValues();
        $this->assertEquals(1, count($attrValues));
        $this->assertEquals('test_default', $attrValues[0]->eav_attribute->code);
        $this->assertEquals($value, $attrValues[0]->value);
        */


        $entity = $this->EavTestEntities->get(1);
        $this->assertEquals($value, $entity->get('test_default'));
    }

    public function _testSetAccessor_Method()
    {
        $entity = $this->EavTestEntities->get(1);
        $entity->set('test_default', 'Awesome!');

        $this->assertTrue($entity->dirty('attributes'));
        $this->assertFalse($entity->dirty('test_default'));

        $result = $entity->getAttribute('test_default');
        $this->assertEquals('Awesome!', $result);
    }

    public function _testSetAccessor_Property()
    {
        $entity = $this->EavTestEntities->get(1);
        $entity->test_default = 'Awesome!';

        $this->assertTrue($entity->dirty('attributes'));
        $this->assertFalse($entity->dirty('test_default'));

        $result = $entity->getAttribute('test_default');
        $this->assertEquals('Awesome!', $result);
    }

    public function _testSetAccessor_AttributesProperty()
    {
        $entity = $this->EavTestEntities->get(1);
        $entity->attributes = ['test_default' => 'Awesome!'];

        $this->assertTrue($entity->dirty('attributes'));
        $this->assertFalse($entity->dirty('test_default'));

        $result = $entity->getAttribute('test_default');
        $this->assertEquals('Awesome!', $result);
    }

    public function _testSetAccessor_AttributesProperty_Invalid()
    {
        $entity = $this->EavTestEntities->get(1);

        $this->setExpectedException('Eav\Exception\InvalidAttributeException');
        $entity->attributes = ['test_invalid' => 'This attribute does not exist, so invalid'];
    }

    /**
     * Test entity setAttribute() method when trying to set an attribute which conflicts
     * with an existing entity property field
     *
     * @return void
     */
    public function _testSetAttribute_Conflict()
    {
        $entity = $this->EavTestEntities->get(1);
        $this->assertEquals('Test 1', $entity->title);
        $entity->setAttribute('title', 'Override Entity Property with Attribute, muhahaa!');

        // expects that the attribute will not be set if there is a field conflict
        $this->assertEquals(null, $entity->getAttribute('title'));
        // expects that the entity property field remains also unchanged
        $this->assertEquals('Test 1', $entity->title);

    }

    /**
     * Test entity setAttribute() method when trying to set an attribute which conflicts
     * with an existing entity property field
     *
     * @return void
     */
    public function _testSetAccessor_Method_Conflict()
    {
        $entity = $this->EavTestEntities->get(1);
        $this->assertEquals('Test 1', $entity->title);
        $entity->set('title', 'Entity with attribute name conflict!');

        // expects that no attribute will not be set if there is a field conflict
        $this->assertEquals(null, $entity->getAttribute('title'));

        // expects that the entity property field is updated properly
        $this->assertEquals('Entity with attribute name conflict!', $entity->title);

    }

    /**
     * Test entity setAttribute() method when trying to set an attribute which conflicts
     * with an existing entity property field
     *
     * @return void
     */
    public function _testSetAccessor_Property_Conflict()
    {
        $entity = $this->EavTestEntities->get(1);
        $this->assertEquals('Test 1', $entity->title);
        $entity->title = 'Entity with attribute name conflict!';

        // expects that no attribute will not be set if there is a field conflict
        $this->assertEquals(null, $entity->getAttribute('title'));

        // expects that the entity property field is updated properly
        $this->assertEquals('Entity with attribute name conflict!', $entity->title);

    }
}
