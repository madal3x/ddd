<?php

namespace reporting\domain\model;

class ReportService {
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository) {
        $this->reportRepository = $reportRepository;
    }

    public function submitAuthenticationReport($username, $status, $dateCreated) {
        $report = Report::authentication($username, $status, $dateCreated);

        $this->reportRepository->save($report);
    }

    public function submitAuthorizationReport($username, $roleName, $status, $dateCreated) {
        $report = Report::authorization($username, $roleName, $status, $dateCreated);

        $this->reportRepository->save($report);
    }
}