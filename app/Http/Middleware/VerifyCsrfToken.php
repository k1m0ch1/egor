<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [ 	'admin/grid:savePosition', 
    						'admin/dashboard[edit:save]', 
    						'admin/users[edit:save]',
    						'admin/preference:title[save]',
    						'admin/preference:preference[save]',
    						'admin/preference:logo[save]',
                            'admin/form:child[add:save]',
                            'admin/menu',
                            'admin/menu[edit:save]',
                            'admin/menu[add:save]',
                            'admin/menu:child[add:save]',
                            'admin/filesList/background',
                            'admin/filesList/logo',
                            'admin/preference:logo[save]',
                            'admin/preference:background[save]',
                            'admin/preference:title[save]',
                            'admin/preference:footer[save]',
                            'admin/roles[edit:save]'
    ];
}
