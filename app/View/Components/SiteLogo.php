<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class SiteLogo extends Component
{
    public $url;
    public $alt;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct($class = '', $alt = null)
    {
        $this->class = $class;
        $this->alt = $alt ?? Setting::get('site_name', 'IEBC SARL');
        $this->url = $this->getLogoUrl();
    }

    /**
     * Get the logo URL from settings
     */
    protected function getLogoUrl()
    {
        $logoPath = Setting::get('company_logo');

        if (!$logoPath) {
            // Fallback sur favicon
            return asset('img/favicon.png');
        }

        // Si c'est un chemin storage (contient 'settings/' ou pas de slash au début)
        if (strpos($logoPath, 'settings/') !== false || (substr($logoPath, 0, 1) !== '/' && !str_starts_with($logoPath, 'http'))) {
            return asset('storage/' . $logoPath);
        }

        // Si c'est un chemin relatif comme /img/favicon.png
        if (str_starts_with($logoPath, '/')) {
            return asset(ltrim($logoPath, '/'));
        }

        // Si c'est déjà une URL complète
        return $logoPath;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.site-logo');
    }
}
