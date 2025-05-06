<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        // validate email
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        // validate password
        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }
}