<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\CartService;


class CartServiceTest extends \PHPUnit_Framework_TestCase
{

    private $cartService;

    public function setUp()
    {
        $app = new Application();
        $app->register(new DoctrineServiceProvider(), array(
            "db.options" => array(
                "driver" => "pdo_sqlite",
                "memory" => true
            ),
        ));
        $this->cartService = new CartService($app["db"]);

        $statement = $app["db"]->prepare("CREATE TABLE cart (
                                              id          INTEGER PRIMARY KEY AUTOINCREMENT,
                                              customer_id INTEGER NOT NULL,
                                              item_id     INTEGER NOT NULL
                                         )"

        );

        $statement->execute();
    }

    public function testSave()
    {
        $cart = array(
            "customer_id" => "1",
            "item_id"     => "2"
        );
        $data = $this->cartService->add($cart);
        $this->assertEquals(1, count($data));
    }

    public function testDelete()
    {
        $this->mockDataSave();

        $this->cartService->delete(1);
        $data = $this->cartService->getAll();

        $this->assertEquals(0, count($data));
    }

    private function mockDataSave()
    {
        $cart = array(
            "customer_id" => "1",
            "item_id"     => "2"
        );

        return $this->cartService->add($cart);
    }

}
