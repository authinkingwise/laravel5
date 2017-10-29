<?php
namespace App\Repositories;

use App\Models\TenantNotificationSetting;

class TenantNotificationSettingRepository
{
	public function create($input)
	{
		$input['ticket_update'] = isset($input['ticket_update']) ? 1 : 0;
		$input['project_update'] = isset($input['project_update']) ? 1 : 0;
		$input['role_update'] = isset($input['role_update']) ? 1 : 0;
		$input['news_update'] = isset($input['news_update']) ? 1 : 0;

		return TenantNotificationSetting::create($input);
	}

	public function update($input, $id)
	{
		$object = TenantNotificationSetting::findOrFail($id);

		$input['ticket_update'] = isset($input['ticket_update']) ? 1 : 0;
		$input['project_update'] = isset($input['project_update']) ? 1 : 0;
		$input['role_update'] = isset($input['role_update']) ? 1 : 0;
		$input['news_update'] = isset($input['news_update']) ? 1 : 0;
		
		if ($object->update($input)) {
			return true;
		} else {
			return false;
		}
	}
}
