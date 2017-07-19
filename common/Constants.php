<?php 
namespace common;
/**
* Common constants accross the app.
* @author Ejoo
*/
class Constants
{
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_PAUSED = 3;
	const STATUS_REJECTED = 4;
	const STATUS_HOLD = 5;
	const STATUS_DELETED = 0;


	const YES = 1;
	const NO = 0;


	const UNIT_LTRS = 1;
	const UNIT_KG = 2;
	const UNIT_QT = 3;

	public static function unitArr()
	{
		return [
			self::UNIT_QT => 'Qty',
			self::UNIT_KG => 'KGs',
			self::UNIT_LTRS => 'Ltrs',
		];
	}

	public static function statusArr()
	{
		return [
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'In Active',
			self::STATUS_REJECTED => 'Rejected',
			self::STATUS_PAUSED => 'Paused',
			self::STATUS_HOLD => 'On Hold',
		];
	}
	/**
	 * 
	 */

	public static function ifArr()
	{
		return [
			self::YES => 'Yes',
			self::NO => 'No',
		];
	}
	/**
	 * function status text
	 */

	public static function statusText($param)
	{
		$ar =  self::statusArr();

		return isset($ar[$param]) ? $ar[$param] : null;
	}

	/**
	 * Function if text
	 */

	public static function ifText($param)
	{
		$ar = self::ifArr();
		return isset($ar[$param]) ? $ar[$param] : null;
	}
	/**
	 * Function unit text
	 */

	public static function unitText($param)
	{
		$ar = self::unitArr();
		return isset($ar[$param]) ? $ar[$param] : null;
	}

	
}
?>