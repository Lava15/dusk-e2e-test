<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VisitCartTest extends DuskTestCase
{

    public function test_user_visits_cart_goes_to_catalog()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart/')
                ->assertSee('В ВАШЕЙ КОРЗИНЕ ПУСТО')
                ->assertSee('КОРЗИНА')
                ->press('.cart-empty-info__back-button')
                ->assertPathIs('/catalog/')
                ->assertSee('Каталог');
        });
    }

}
