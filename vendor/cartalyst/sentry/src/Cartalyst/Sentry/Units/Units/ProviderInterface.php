<?php namespace Cartalyst\Sentry\Units;
/**
 * Part of the Sentry package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Sentry
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

interface ProviderInterface {

	/**
	 * Find the unit by ID.
	 *
	 * @param  int  $id
	 * @return \Cartalyst\Sentry\Units\UnitInterface  $unit
	 * @throws \Cartalyst\Sentry\Units\UnitNotFoundException
	 */
	public function findById($id);

	/**
	 * Find the unit by name.
	 *
	 * @param  string  $name
	 * @return \Cartalyst\Sentry\Units\UnitInterface  $unit
	 * @throws \Cartalyst\Sentry\Units\UnitNotFoundException
	 */
	public function findByName($name);

	/**
	 * Returns all units.
	 *
	 * @return array  $units
	 */
	public function findAll();

	/**
	 * Creates a unit.
	 *
	 * @param  array  $attributes
	 * @return \Cartalyst\Sentry\Units\UnitInterface
	 */
	public function create(array $attributes);

}
