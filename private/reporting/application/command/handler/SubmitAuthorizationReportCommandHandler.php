<?php

namespace reporting\application\command\handler;

use reporting\application\command\SubmitAuthorizationReportCommand;
use reporting\domain\model\ReportService;

class SubmitAuthorizationReportCommandHandler {
    private $reportService;

    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    public function execute(SubmitAuthorizationReportCommand $command) {
        $this->reportService->submitAuthorizationReport($command->username(), $command->roleName(), $command->status(), $command->dateCreated());
    }
}