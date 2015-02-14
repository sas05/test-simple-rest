<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\ItemsService;


class ItemsServiceTest extends \PHPUnit_Framework_TestCase
{

    private $itemService;

    public function setUp()
    {
        $app = new Application();
        $app->register(new DoctrineServiceProvider(), array(
            "db.options" => array(
                "driver" => "pdo_sqlite",
                "memory" => true
            ),
        ));
        $this->itemService = new ItemsService($app["db"]);

        $statement = $app["db"]->prepare("CREATE TABLE items (
                                     id INTEGER PRIMARY KEY AUTOINCREMENT,
                                     name VARCHAR NOT NULL,
                                     description VARCHAR NOT NULL,
                                     price INTEGER NOT NULL
                                    )"
        );

        $statement->execute();
    }

    public function testGetAll()
    {
        $data = $this->itemService->getAll();
        $this->assertNotNull($data);
    }

    public function testSave()
    {
        $item = array(
            "name"          => "adidas",
            "description"   => "sports shoes",
            "price"         => 20
        );
        $data = $this->itemService->save($item);
        $data = $this->itemService->getAll();
        $this->assertEquals(1, count($data));
    }

    public function testUpdateName()
    {
        $this->mockDataSave();

        $item = array(
            "name"          => "boo",
            "description"   => "shoes",
            "price"         => 20
        );

        $this->itemService->update(1, $item);

        $data = $this->itemService->getAll();
        $this->assertEquals("boo", $data[0]["name"]);

    }

    public function testUpdateDescription()
    {
        $this->mockDataSave();

        $item = array(
            "name"          => "adidas",
            "description"   => "shoes",
            "price"         => 20
        );

        $this->itemService->update(1, $item);

        $data = $this->itemService->getAll();
        $this->assertEquals("shoes", $data[0]["description"]);

    }

    public function testUpdatePrice()
    {
        $this->mockDataSave();

        $item = array(
            "name"          => "adidas",
            "description"   => "shoes",
            "price"         => 30
        );

        $this->itemService->update(1, $item);

        $data = $this->itemService->getAll();
        $this->assertEquals(30, $data[0]["price"]);

    }

    public function testDelete()
    {
        $this->mockDataSave();

        $this->itemService->delete(1);
        $data = $this->itemService->getAll();

        $this->assertEquals(0, count($data));
    }

    private function mockDataSave()
    {
        $item = array("name" => "adidas", "description" => "sports shoes", "price" => 20);

        return $this->itemService->save($item);
    }

}
