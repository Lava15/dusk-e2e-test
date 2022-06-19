<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChangeItemsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_product_has_price_brand_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/catalog/muzhskaya_odezhda/futbolki/')
                ->assertSee('МУЖСКИЕ ФУТБОЛКИ')
                ->assertSeeLink('Футболка мужская Termit')
                ->assertPresent('.sm-amount__value');
        });
    }

    public function test_user_can_increase_amount()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/catalog/muzhskaya_odezhda/futbolki/')
                ->assertSee('МУЖСКИЕ ФУТБОЛКИ')
                ->visit('/product/26150350299/')
                ->assertSee('ОПИСАНИЕ')
                ->visit('/product/26150350299/?skuId=187981610299')
                ->press('В КОРЗИНУ')
                ->visit('/cart')
                ->assertDontSee('В ВАШЕЙ КОРЗИНЕ ПУСТО');
        });
    }

    public function test_if_refresh_page_item_should_stay()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart')
                ->refresh()
                ->assertDontSee('В ВАШЕЙ КОРЗИНЕ ПУСТО');
        });
    }


    public function test_user_can_delete_items_from_cart()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart')
                ->assertDontSee('В ВАШЕЙ КОРЗИНЕ ПУСТО')
                ->press('Удалить');
        });
    }
}
