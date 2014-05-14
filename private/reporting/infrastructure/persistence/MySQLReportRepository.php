<?php

namespace reporting\infrastructure\persistence;

use common\persistence\MySQLRepository;
use reporting\domain\model\Report;
use reporting\domain\model\ReportRepository;

class MySQLReportRepository extends MySQLRepository implements ReportRepository {
    public function save(Report $report) {
        $s = $this->db->prepare(
            "INSERT INTO
               report
               (id, type, username, role_name, status, date_created)
             VALUES
               (?, ?, ?, ?, ?, ?)
             "
        );

        $s->execute(array(
            $report->id(),
            $report->type(),
            $report->username(),
            $report->roleName(),
            $report->status(),
            $report->dateCreated()->format("Y-m-d H:i:s")
        ));
    }
}