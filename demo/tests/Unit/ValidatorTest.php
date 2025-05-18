<?php

use Core\Validator;

it('validates a string', function () {

    // setup
    $result = Validator::string('foobar');

    // assert
    expect($result)->toBe(true);
});

it('validates an email', function () {
    expect(Validator::email('foobar')->toBeFalse());
    expect(Validator::email('test@test.com')->toBeTrue());
});

