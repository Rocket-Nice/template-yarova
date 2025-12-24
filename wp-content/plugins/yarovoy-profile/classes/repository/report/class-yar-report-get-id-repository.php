<?php

class YAR_Report_Get_Id_Repository extends YAR_Report_Repository
{
	private $report;

	private function get_format($data, $type = '')
	{
		$return = [
			'title' => $data['field_title'],
		];

		if (isset($data['value'])) {
			$return['value'] = $data['value'];

			if ($type === 'inspection') {
				$return['value_title'] = (int) $data['value'] === 1 ? 'Все хорошо' : 'Есть замечания';
				$return['value_class'] = (int) $data['value'] === 1 ? '_success' : '_error';
			}
		}

		if (isset($data['thickness'])) {
			$return['thickness'] = $data['thickness'];
		}

		if (isset($data['comment'])) {
			$return['comment'] = $data['comment'];
		}

		if (isset($data['field_order'])) {
			$return['order'] = $data['field_order'];
		}

		if (isset($data['field_slug'])) {
			$return['slug'] = $data['field_slug'];
		}

		if (isset($data['field_group'])) {
			$return['group'] = $data['field_group'] . '_' . $data['field_slug'];
		}

		if (! empty($data['values'])) {
			$find = array_search((int) $data['value'], array_column($data['values'], 'value'));
			if ($find !== false) {
				$return['value'] = $data['values'][$find];
			}
		}

		if (! empty($data['options'])) {
			$return['value'] = $data['options'][(int) $data['value']];
		}

		return $return;
	}

	private function filter_format($key)
	{
		if (! empty($this->report[$key])) {
			$new = [];

			foreach ($this->report[$key] as $data) {
				$new[] = $this->get_format($data);
			}

			$this->report[$key] = $new;
		}
	}

	private function filter_inspection($key, $status = '')
	{
		$errors = [];

		if (! empty($this->report[$key])) {
			foreach ($this->report[$key] as $item) {
				if ($status && (int) $item['value'] !== $status) {
					continue;
				}

				$errors[] = $this->get_format($item, 'inspection');
			}

			$this->report[$key] = $errors;
		}
	}

	// TODO: Зарефакторить это в будущем, переделать под YAR_REPORT_FIELDS->get_filled_steps()
	public function get_single($report_id = 0)
	{
		$this->report_id = $report_id;
		$report          = $this->get_report();

		if (is_wp_error($report)) {
			return $report;
		}

		$this->report = $report;

		if (! empty($this->report['gallery'])) {
			foreach ($this->report['gallery'] as $key => $item) {
				$this->report['gallery'][$key] = yar_get_file_url($item);
			}
		}

		$this->filter_format('features');
		$this->filter_format('vin');
		$this->filter_format('summary');

		$this->filter_inspection('body_inspection');
		$this->filter_inspection('dashboard');
		$this->filter_inspection('interior_inspection');
		$this->filter_format('interior_equipment');

		// if (isset($this->report['files'])) {
		// 	unset($this->report['files']);
		// }

		// тут
		$fields_repo = new YAR_Report_Fields_Repository();
		$steps = $fields_repo->get_steps_filled($this->report_id);
		if (isset($steps['documents'])) {
			$this->report['documents'] = $steps['documents'];
		}

		return $this->report;
	}

	public function get_title()
	{
		return parent::get_title();
	}
}
