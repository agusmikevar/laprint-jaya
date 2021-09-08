<?php

namespace Bsb\Foundation\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Bsb\Foundation\Database\{
    BuildWhere,
    BuildExtent,
};
use Bsb\Foundation\{
    ManageService,
    TransmitTask,
    RevealWidget,
};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use BuildWhere, BuildExtent, ManageService, TransmitTask, RevealWidget;
}
