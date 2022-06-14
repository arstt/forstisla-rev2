<?php

namespace Limedeck\NovaCashierOverview;

use Laravel\Nova\ResourceTool;

class NovaCashierOverview extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Nova Cashier Overview';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-cashier-overview';
    }
}
