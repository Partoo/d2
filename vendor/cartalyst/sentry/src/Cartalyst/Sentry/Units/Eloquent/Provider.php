<?php namespace Cartalyst\Sentry\Units\Eloquent;
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

use Cartalyst\Sentry\Units\UnitInterface;
use Cartalyst\Sentry\Units\UnitNotFoundException;
use Cartalyst\Sentry\Units\ProviderInterface;

class Provider implements ProviderInterface {

	/**
	 * The Eloquent unit model.
	 *
	 * @var string
	 */
	protected $model = 'Cartalyst\Sentry\Units\Eloquent\Unit';

	/**
	 * Create a new Eloquent Unit provider.
	 *
	 * @param  string  $model
	 * @return void
	 */
	public function __construct($model = null)
	{
		if (isset($model))
		{
			$this->model = $model;
		}
	}

	/**
	 * Find the unit by ID.
	 *
	 * @param  int  $id
	 * @return \Cartalyst\Sentry\Units\UnitInterface  $unit
	 * @throws \Cartalyst\Sentry\Units\UnitNotFoundException
	 */
	public function findById($id)
	{
		$model = $this->createModel();

		if ( ! $unit = $model->newQuery()->find($id))
		{
			throw new UnitNotFoundException("没有ID为[$id]的部门.");
		}

		return $unit;
	}

	/**
	 * Find the unit by name.
	 *
	 * @param  string  $name
	 * @return \Cartalyst\Sentry\Units\UnitInterface  $unit
	 * @throws \Cartalyst\Sentry\Units\UnitNotFoundException
	 */
	public function findByName($name)
	{
		$model = $this->createModel();

		if ( ! $unit = $model->newQuery()->where('name', '=', $name)->first())
		{
			throw new UnitNotFoundException("找不到名为[$name]的部门.");
		}

		return $unit;
	}

	/**
	 * Returns all units.
	 *
	 * @return array  $units
	 */
	public function findAll()
	{
		$model = $this->createModel();

		return $model->newQuery()->get()->all();
	}

	/**
	 * Creates a unit.
	 *
	 * @param  array  $attributes
	 * @return \Cartalyst\Sentry\Units\UnitInterface
	 */
	public function create(array $attributes)
	{
		$unit = $this->createModel();
		$unit->fill($attributes);
		$unit->save();
		return $unit;
	}

	/**
	 * Create a new instance of the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function createModel()
	{
		$class = '\\'.ltrim($this->model, '\\');

		return new $class;
	}

	/**
	 * Sets a new model class name to be used at
	 * runtime.
	 *
	 * @param  string  $model
	 */
	public function setModel($model)
	{
		$this->model = $model;
	}

}
