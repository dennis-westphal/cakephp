<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PresentationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PresentationsTable Test Case
 */
class PresentationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PresentationsTable
     */
    public $Presentations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.presentations',
        'app.topics',
        'app.users',
        'app.presentations_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Presentations') ? [] : ['className' => 'App\Model\Table\PresentationsTable'];
        $this->Presentations = TableRegistry::get('Presentations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Presentations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
