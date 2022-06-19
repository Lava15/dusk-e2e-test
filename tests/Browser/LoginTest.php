<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

        public function test_user_should_see_on_login_page() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('ВХОД ИЛИ РЕГИСТРАЦИЯ')
                ->assertSee('Номер телефона')
                ->assertSee('ПОЛУЧИТЬ КОД');
        });
    }


    public function test_user_cannot_login_with_empty_credentials()
    {
        $this->browse(function (Browser $browser)  {
            $browser->visit('/login')
                ->assertSee('ВХОД ИЛИ РЕГИСТРАЦИЯ')
                ->press('ПОЛУЧИТЬ КОД')
                ->assertSee('Пожалуйста, заполните обязательное поле');
        });
    }

    public function test_user_cannot_login_with_wrong_credentials()
    {
        $this->browse(function (Browser $browser)  {
            $browser->visit('/login')
                ->assertSee('ВХОД ИЛИ РЕГИСТРАЦИЯ')
                ->pause(2500)
                ->type('.sm-input', 123)
                ->press('ПОЛУЧИТЬ КОД')
                ->assertSee('Неверный формат телефона');
        });
    }

}
