<?php
// Fix Manage_product.php - truncate after line 3545, append correct code
$file = __DIR__ . '/admin/application/models/Manage_product.php';
$lines = file($file);
// Keep first 3545 lines (index 0-3544)
$kept = array_slice($lines, 0, 3545);

$append = '
	function deleteCarPickupImage($id)
	{
		$this->db->where(\'id\', $id);
		$query = $this->db->get(\'tbl_car_pickup_images\');
		$result = $query->row();

		if ($result) {
			$image_path = FCPATH . \'images/vehicle_image/\' . $result->image;

			if (file_exists($image_path)) {
				unlink($image_path);
			}

			$this->db->where(\'id\', $id);
			if ($this->db->delete(\'tbl_car_pickup_images\')) {
				return 1;
			}
		}

		return 0;
	}

	function getCarPickupImages($driverId)
	{
		$this->db->where(\'driverId\', $driverId);
		$query = $this->db->get(\'tbl_car_pickup_images\');
		return $query->result_array();
	}

	function getCarDropImages($driverId)
	{
		$this->db->where(\'driverId\', $driverId);
		$query = $this->db->get(\'tbl_car_drop_images\');
		return $query->result_array();
	}

	// ========== TRANSPORT TRACKING METHODS ==========

	function insertTransitStatus($data)
	{
		if ($data) {
			$this->db->insert(\'tbl_transit_status\', $data);
			return 1;
		}
		return 0;
	}

	function getTransitStatusByBooking($bookingId)
	{
		$this->db->where(\'bookingId\', $bookingId);
		$this->db->order_by(\'date_time\', \'ASC\');
		$query = $this->db->get(\'tbl_transit_status\');
		return $query->result_array();
	}

	function deleteTransitStatus($id)
	{
		$this->db->where(\'id\', $id);
		if ($this->db->delete(\'tbl_transit_status\')) {
			return 1;
		}
		return 0;
	}

	function getCarImagesByBookingAndType($bookingId, $type = null)
	{
		$this->db->where(\'bookingId\', $bookingId);
		$carQuery = $this->db->get(\'tbl_car_booking\');
		$cars = $carQuery->result_array();
		
		if (empty($cars)) return [];
		
		$driverIds = [];
		foreach ($cars as $car) {
			if (!empty($car[\'assignDriverId\'])) $driverIds[] = $car[\'assignDriverId\'];
			if (!empty($car[\'assignSecondDriverId\'])) $driverIds[] = $car[\'assignSecondDriverId\'];
		}
		
		if (empty($driverIds)) return [];
		
		$this->db->where_in(\'driverId\', $driverIds);
		if ($type) {
			$this->db->where(\'type\', $type);
		}
		$query = $this->db->get(\'tbl_car_pickup_images\');
		return $query->result_array();
	}

	function getAllCarImagesByBooking($bookingId)
	{
		$this->db->where(\'bookingId\', $bookingId);
		$carQuery = $this->db->get(\'tbl_car_booking\');
		$cars = $carQuery->result_array();
		
		if (empty($cars)) return [];
		
		$driverIds = [];
		foreach ($cars as $car) {
			if (!empty($car[\'assignDriverId\'])) $driverIds[] = $car[\'assignDriverId\'];
			if (!empty($car[\'assignSecondDriverId\'])) $driverIds[] = $car[\'assignSecondDriverId\'];
		}
		
		if (empty($driverIds)) return [];
		
		$this->db->where_in(\'driverId\', $driverIds);
		$query = $this->db->get(\'tbl_car_pickup_images\');
		return $query->result_array();
	}
}
';

$content = implode('', $kept) . $append;
file_put_contents($file, $content);
echo "Done! File now has " . count(file($file)) . " lines\n";
