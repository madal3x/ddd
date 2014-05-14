<?php

namespace reporting\domain\model;

interface ReportRepository {
    public function save(Report $report);
}