<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Configuration;
use App\Repositories\Configuration\ConfigurationInterface;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    private $configurationRepository;

    public function __construct(ConfigurationInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }
    public function settings()
    {
        $configurations = Configuration::all()->pluck('value', 'key');
        return view('admin.configuration.index', compact('configurations'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string',
            'site_description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3500',
            'address_shop' => 'required|string',
            'phone_shop' => 'required|string',
            'email_shop' => 'required|string|email',
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url',
            'tiktok_link' => 'required|url',
            'services_firt' => 'required|string',
            'services_second' => 'required|string',
            'services_third' => 'required|string',
            'services_fourth' => 'required|string',
            'color_services_firt' => 'required|string',
            'color_services_second' => 'required|string',
            'color_services_third' => 'required|string',
            'color_services_fourth' => 'required|string',
            'icon_services_firt' => 'required|string',
            'icon_services_second' => 'required|string',
            'icon_services_third' => 'required|string',
            'icon_services_fourth' => 'required|string',
            'text_color' => 'required|string',
            'site_slogan' => 'required|string',
            'site_slogan_description' => 'required|string'
        ]);

        $this->configurationRepository->update($request);

        return redirect()->route('settings')->with('message', ['content' => 'Cập nhập cài đặt thành công!', 'type' => 'success']);
    }
}
