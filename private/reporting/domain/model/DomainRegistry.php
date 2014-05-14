<?php

namespace reporting\domain\model;

use reporting\infrastructure\persistence\ConnectionFactory;
use reporting\infrastructure\persistence\MySQLReportRepository;

class DomainRegistry {
    public function reportService() {
        return new ReportService(new MySQLReportRepository(ConnectionFactory::create()));
    }
}