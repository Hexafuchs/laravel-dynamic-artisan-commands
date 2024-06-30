<?php

it('can overwrite command', function () {
    $this->artisan('config:show app.test')->assertExitCode(2);
});
