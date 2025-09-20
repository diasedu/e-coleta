<?php

namespace app\DTO;

class UserDTO {
    public string  $email;
    public string  $pass;
    public ?string $name;

    public function __construct(
        string $email, 
        string $pass,
        ?string $name
    ) {
        $this->email = $email;
        $this->pass  = $pass;
        $this->name  = $name;
    }
}