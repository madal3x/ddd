<?php

namespace shop\infrastructure\persistence;

use common\persistence\MySQLRepository;
use shop\domain\model\Token;
use shop\domain\model\TokenRepository;

class MySQLTokenRepository extends MySQLRepository implements TokenRepository {
    public function save(Token $token) {
        $s = $this->db->prepare(
            "INSERT INTO
               token
               (token, created_on, last_used_on)
             VALUES
               (?, ?, ?)
             ON DUPLICATE KEY UPDATE
               last_used_on = VALUE(last_used_on)
             "
        );

        $s->execute(array(
            $token->token(),
            $token->createdOn()->format("Y-m-d H:i:s"),
            $token->lastUsedOn()->format("Y-m-d H:i:s")
        ));
    }

    public function getByToken($token) {
        $s = $this->db->prepare(
            "SELECT
               *
             FROM
               token
             WHERE
               token = ?
             LIMIT 1"
        );

        $s->execute(array(
            $token
        ));

        $result = $s->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->map($result);
        }

        return null;
    }

    protected function map($result) {
        return new Token(
            $result['token'],
            \DateTime::createFromFormat("Y-m-d H:i:s", $result['created_on']),
            \DateTime::createFromFormat("Y-m-d H:i:s", $result['last_used_on'])
        );
    }
}