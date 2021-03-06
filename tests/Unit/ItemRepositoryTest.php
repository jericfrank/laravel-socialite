<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\Repositories\ItemRepository;

use App\Services\Models\Items;

use Mockery as m;

class ItemRepositoryTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    
        $this->items = m::mock( new Items );
    }

    public function tearDown() {
        m::close();
    }

    public function testList()
    {
    	$this->items->shouldReceive( 'all' )->once()->andReturn( [] );

    	$expect = new ItemRepository( $this->items );

    	$this->assertEquals( $expect->list(), [] );
    }

    public function testCreate()
    {
        $payload = [
            'name'        => 'test',
            'description' => 'test',
            'category_id' => 1,
            'created_by'  => 1
        ];

        $this->items->shouldReceive( 'create' )->once()->with( $payload )->andReturn( [] );

        $expect = new ItemRepository( $this->items );

        $this->assertEquals( $expect->create( $payload ), [] );
    }
}
