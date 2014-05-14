<?php

namespace shop\domain\model;

class TokenValiditySpecification {
    private $minutesSinceLastUsed;

    public function __construct($minutesSinceLastUsed) {
        $this->minutesSinceLastUsed = $minutesSinceLastUsed;
    }

    public function isSatisfiedBy(Token $token) {
        $dateTime = new \DateTime();
        $minutesSinceLastUsed = $dateTime->diff($token->lastUsedOn())->m;
        if ($minutesSinceLastUsed < $this->minutesSinceLastUsed) {
            return true;
        }

        return false;
    }
}