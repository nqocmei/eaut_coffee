<?php

namespace App\Repositories\Configuration;

use App\Models\Configuration;

class ConfigurationRepository implements ConfigurationInterface
{
    public function update($request)
    {
        $data = $request->except('_token', '_method', 'logo');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if (!empty($user->avatar)) {
                $oldLogo = Configuration::where('key', 'logo')->first();
                if (file_exists($oldLogo->value)) {
                    unlink($oldLogo->value);
                }
            }

            $imageName = md5(rand() . time()) . '.' . $file->extension();
            $file->move(public_path('storage/images/logo'), $imageName);
            $logoPath = 'storage/images/logo/' . $imageName;

            Configuration::updateOrCreate(['key' => 'logo', 'value' => $logoPath]);
        }

        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                Configuration::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }
    }
}
